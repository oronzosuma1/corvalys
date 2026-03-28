<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashFlowEntry;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CashFlowController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        // Monthly breakdown for last 12 months
        $monthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = $now->copy()->subMonths($i);
            $month = $date->format('Y-m');
            $label = $date->translatedFormat('M Y');

            $entrate = CashFlowEntry::entrate()
                ->whereYear('date', $date->year)
                ->whereMonth('date', $date->month)
                ->sum('amount');

            $uscite = CashFlowEntry::uscite()
                ->whereYear('date', $date->year)
                ->whereMonth('date', $date->month)
                ->sum('amount');

            $monthlyData[] = [
                'month' => $month,
                'label' => $label,
                'entrate' => (float) $entrate,
                'uscite' => (float) $uscite,
                'saldo' => (float) ($entrate - $uscite),
            ];
        }

        // Current month stats
        $entrateCurrentMonth = CashFlowEntry::entrate()
            ->whereYear('date', $now->year)
            ->whereMonth('date', $now->month)
            ->sum('amount');

        $usciteCurrentMonth = CashFlowEntry::uscite()
            ->whereYear('date', $now->year)
            ->whereMonth('date', $now->month)
            ->sum('amount');

        // Total balance (all time)
        $totalEntrate = CashFlowEntry::entrate()->sum('amount');
        $totalUscite = CashFlowEntry::uscite()->sum('amount');
        $saldoAttuale = $totalEntrate - $totalUscite;

        // Forecast next month: average of last 3 months
        $lastThreeMonths = array_slice($monthlyData, -3);
        $avgEntrate = collect($lastThreeMonths)->avg('entrate');
        $avgUscite = collect($lastThreeMonths)->avg('uscite');
        $previsioneProssimoMese = $avgEntrate - $avgUscite;

        // Upcoming payments (invoices due in next 30 days)
        $upcomingPayments = Invoice::where('status', '!=', 'pagata')
            ->where('status', '!=', 'annullata')
            ->whereBetween('due_date', [now(), now()->addDays(30)])
            ->orderBy('due_date')
            ->take(10)
            ->get();

        // Recent entries
        $recentEntries = CashFlowEntry::latest('date')->take(5)->get();

        // Max value for chart scaling
        $maxValue = max(
            collect($monthlyData)->max('entrate'),
            collect($monthlyData)->max('uscite'),
            1
        );

        return view('admin.cashflow.index', compact(
            'monthlyData', 'entrateCurrentMonth', 'usciteCurrentMonth',
            'saldoAttuale', 'previsioneProssimoMese', 'upcomingPayments',
            'recentEntries', 'maxValue'
        ));
    }

    public function detail(Request $request)
    {
        $query = CashFlowEntry::query();

        if ($request->filled('from')) {
            $query->where('date', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->where('date', '<=', $request->to);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('type') && $request->type !== 'tutti') {
            $query->where('type', $request->type);
        }

        $totaleEntrate = (clone $query)->where('type', 'entrata')->sum('amount');
        $totaleUscite = (clone $query)->where('type', 'uscita')->sum('amount');

        $entries = $query->latest('date')->paginate(20)->withQueryString();

        $categories = CashFlowEntry::select('category')->distinct()->orderBy('category')->pluck('category');

        return view('admin.cashflow.detail', compact('entries', 'totaleEntrate', 'totaleUscite', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:entrata,uscita',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'date' => 'required|date',
            'is_recurring' => 'boolean',
            'recurring_frequency' => 'nullable|in:monthly,quarterly,yearly',
            'invoice_id' => 'nullable|exists:invoices,id',
            'notes' => 'nullable|string',
        ]);

        $validated['is_recurring'] = $request->boolean('is_recurring');

        CashFlowEntry::create($validated);

        $redirect = $request->input('redirect', 'index');

        if ($redirect === 'detail') {
            return redirect()->route('admin.cashflow.detail')
                ->with('success', 'Voce aggiunta con successo.');
        }

        return redirect()->route('admin.cashflow.index')
            ->with('success', 'Voce aggiunta con successo.');
    }

    public function destroy(CashFlowEntry $entry)
    {
        $entry->delete();

        return redirect()->back()->with('success', 'Voce eliminata.');
    }
}
