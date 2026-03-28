<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashFlowEntry;
use App\Models\Invoice;
use App\Models\Lead;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::query();

        if ($request->filled('type') && $request->type !== 'tutte') {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                  ->orWhere('client_name', 'like', "%{$search}%")
                  ->orWhere('client_email', 'like', "%{$search}%");
            });
        }

        // Summary stats (on filtered set, excluding status filter for overview)
        $baseQuery = Invoice::query();
        if ($request->filled('type') && $request->type !== 'tutte') {
            $baseQuery->where('type', $request->type);
        }

        $totals = [
            'emesse_non_pagate' => Invoice::emesse()->whereNotIn('status', ['pagata', 'annullata'])->sum('total'),
            'ricevute_non_pagate' => Invoice::ricevute()->whereNotIn('status', ['pagata', 'annullata'])->sum('total'),
            'scadute' => Invoice::scadute()->count(),
            'pagate_mese' => Invoice::pagate()
                ->whereMonth('paid_date', now()->month)
                ->whereYear('paid_date', now()->year)
                ->sum('total'),
        ];

        $invoices = $query->latest('issue_date')->paginate(15)->withQueryString();

        return view('admin.invoices.index', compact('invoices', 'totals'));
    }

    public function create()
    {
        $leads = Lead::orderBy('name')->get();

        // Generate next invoice number
        $year = now()->year;
        $lastInvoice = Invoice::where('invoice_number', 'like', "CRV-{$year}-%")
            ->orderByDesc('invoice_number')
            ->first();

        if ($lastInvoice) {
            $lastNum = (int) substr($lastInvoice->invoice_number, -3);
            $nextNum = str_pad($lastNum + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $nextNum = '001';
        }

        $suggestedNumber = "CRV-{$year}-{$nextNum}";

        return view('admin.invoices.create', compact('leads', 'suggestedNumber'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|unique:invoices,invoice_number',
            'type' => 'required|in:emessa,ricevuta',
            'client_name' => 'required|string|max:255',
            'client_email' => 'nullable|email|max:255',
            'client_vat' => 'nullable|string|max:50',
            'amount' => 'required|numeric|min:0',
            'vat_amount' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'status' => 'required|in:bozza,inviata,pagata,scaduta,annullata',
            'issue_date' => 'required|date',
            'due_date' => 'required|date',
            'paid_date' => 'nullable|date',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
            'lead_id' => 'nullable|exists:leads,id',
        ]);

        $invoice = Invoice::create($validated);

        // Auto-create cash flow entry if paid
        if ($invoice->status === 'pagata') {
            $this->createCashFlowEntry($invoice);
        }

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Fattura creata con successo.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('lead', 'cashFlowEntry');
        return view('admin.invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $leads = Lead::orderBy('name')->get();
        return view('admin.invoices.edit', compact('invoice', 'leads'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|unique:invoices,invoice_number,' . $invoice->id,
            'type' => 'required|in:emessa,ricevuta',
            'client_name' => 'required|string|max:255',
            'client_email' => 'nullable|email|max:255',
            'client_vat' => 'nullable|string|max:50',
            'amount' => 'required|numeric|min:0',
            'vat_amount' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'status' => 'required|in:bozza,inviata,pagata,scaduta,annullata',
            'issue_date' => 'required|date',
            'due_date' => 'required|date',
            'paid_date' => 'nullable|date',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
            'lead_id' => 'nullable|exists:leads,id',
        ]);

        $oldStatus = $invoice->status;
        $invoice->update($validated);

        // If status changed to pagata, create cash flow entry
        if ($oldStatus !== 'pagata' && $invoice->status === 'pagata' && !$invoice->cashFlowEntry) {
            $this->createCashFlowEntry($invoice);
        }

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Fattura aggiornata con successo.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Fattura eliminata.');
    }

    private function createCashFlowEntry(Invoice $invoice): void
    {
        CashFlowEntry::create([
            'type' => $invoice->type === 'emessa' ? 'entrata' : 'uscita',
            'category' => 'consulenza',
            'description' => "Fattura {$invoice->invoice_number} - {$invoice->client_name}",
            'amount' => $invoice->total,
            'date' => $invoice->paid_date ?? now(),
            'invoice_id' => $invoice->id,
        ]);
    }
}
