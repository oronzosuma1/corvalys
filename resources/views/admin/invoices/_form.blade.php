{{-- Shared invoice form partial --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Invoice Number --}}
    <div>
        <label for="invoice_number" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Numero Fattura *</label>
        <input type="text" name="invoice_number" id="invoice_number"
            value="{{ old('invoice_number', $invoice->invoice_number ?? $suggestedNumber ?? '') }}"
            class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary @error('invoice_number') border-red-400 @enderror" required>
        @error('invoice_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Type --}}
    <div>
        <label for="type" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Tipo *</label>
        <select name="type" id="type" class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary" required>
            <option value="emessa" {{ old('type', $invoice->type ?? '') == 'emessa' ? 'selected' : '' }}>Emessa</option>
            <option value="ricevuta" {{ old('type', $invoice->type ?? '') == 'ricevuta' ? 'selected' : '' }}>Ricevuta</option>
        </select>
        @error('type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Client Name --}}
    <div>
        <label for="client_name" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Nome Cliente *</label>
        <input type="text" name="client_name" id="client_name"
            value="{{ old('client_name', $invoice->client_name ?? '') }}"
            class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary @error('client_name') border-red-400 @enderror" required>
        @error('client_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Client Email --}}
    <div>
        <label for="client_email" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Email Cliente</label>
        <input type="email" name="client_email" id="client_email"
            value="{{ old('client_email', $invoice->client_email ?? '') }}"
            class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary @error('client_email') border-red-400 @enderror">
        @error('client_email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Client VAT --}}
    <div>
        <label for="client_vat" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Partita IVA</label>
        <input type="text" name="client_vat" id="client_vat"
            value="{{ old('client_vat', $invoice->client_vat ?? '') }}"
            class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary @error('client_vat') border-red-400 @enderror">
        @error('client_vat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Currency --}}
    <div>
        <label for="currency" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Valuta</label>
        <select name="currency" id="currency" class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
            <option value="EUR" {{ old('currency', $invoice->currency ?? 'EUR') == 'EUR' ? 'selected' : '' }}>EUR</option>
            <option value="USD" {{ old('currency', $invoice->currency ?? '') == 'USD' ? 'selected' : '' }}>USD</option>
            <option value="GBP" {{ old('currency', $invoice->currency ?? '') == 'GBP' ? 'selected' : '' }}>GBP</option>
        </select>
    </div>

    {{-- Amount --}}
    <div>
        <label for="amount" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Imponibile *</label>
        <input type="number" name="amount" id="amount" step="0.01" min="0"
            value="{{ old('amount', $invoice->amount ?? '') }}"
            class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary @error('amount') border-red-400 @enderror" required>
        @error('amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- VAT Amount --}}
    <div>
        <label for="vat_amount" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">IVA (22%)</label>
        <input type="number" name="vat_amount" id="vat_amount" step="0.01" min="0"
            value="{{ old('vat_amount', $invoice->vat_amount ?? '') }}"
            class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary @error('vat_amount') border-red-400 @enderror" required>
        @error('vat_amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Total --}}
    <div>
        <label for="total" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Totale *</label>
        <input type="number" name="total" id="total" step="0.01" min="0"
            value="{{ old('total', $invoice->total ?? '') }}"
            class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary bg-gray-50 @error('total') border-red-400 @enderror" required readonly>
        @error('total') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Status --}}
    <div>
        <label for="status" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Stato *</label>
        <select name="status" id="status" class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary" required>
            <option value="bozza" {{ old('status', $invoice->status ?? 'bozza') == 'bozza' ? 'selected' : '' }}>Bozza</option>
            <option value="inviata" {{ old('status', $invoice->status ?? '') == 'inviata' ? 'selected' : '' }}>Inviata</option>
            <option value="pagata" {{ old('status', $invoice->status ?? '') == 'pagata' ? 'selected' : '' }}>Pagata</option>
            <option value="scaduta" {{ old('status', $invoice->status ?? '') == 'scaduta' ? 'selected' : '' }}>Scaduta</option>
            <option value="annullata" {{ old('status', $invoice->status ?? '') == 'annullata' ? 'selected' : '' }}>Annullata</option>
        </select>
    </div>

    {{-- Issue Date --}}
    <div>
        <label for="issue_date" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Data Emissione *</label>
        <input type="date" name="issue_date" id="issue_date"
            value="{{ old('issue_date', isset($invoice) && $invoice->issue_date ? $invoice->issue_date->format('Y-m-d') : now()->format('Y-m-d')) }}"
            class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary" required>
        @error('issue_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Due Date --}}
    <div>
        <label for="due_date" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Data Scadenza *</label>
        <input type="date" name="due_date" id="due_date"
            value="{{ old('due_date', isset($invoice) && $invoice->due_date ? $invoice->due_date->format('Y-m-d') : now()->addDays(30)->format('Y-m-d')) }}"
            class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary" required>
        @error('due_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Paid Date (shown if pagata) --}}
    <div id="paid_date_container" class="{{ old('status', $invoice->status ?? '') !== 'pagata' ? 'hidden' : '' }}">
        <label for="paid_date" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Data Pagamento</label>
        <input type="date" name="paid_date" id="paid_date"
            value="{{ old('paid_date', isset($invoice) && $invoice->paid_date ? $invoice->paid_date->format('Y-m-d') : '') }}"
            class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
    </div>

    {{-- Lead --}}
    <div>
        <label for="lead_id" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Lead collegato</label>
        <select name="lead_id" id="lead_id" class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
            <option value="">-- Nessuno --</option>
            @foreach($leads as $lead)
                <option value="{{ $lead->id }}" {{ old('lead_id', $invoice->lead_id ?? '') == $lead->id ? 'selected' : '' }}>
                    {{ $lead->name }} {{ $lead->company ? '('.$lead->company.')' : '' }}
                </option>
            @endforeach
        </select>
    </div>
</div>

{{-- Description --}}
<div class="mt-6">
    <label for="description" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Descrizione</label>
    <textarea name="description" id="description" rows="3"
        class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">{{ old('description', $invoice->description ?? '') }}</textarea>
</div>

{{-- Notes --}}
<div class="mt-4">
    <label for="notes" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Note interne</label>
    <textarea name="notes" id="notes" rows="2"
        class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">{{ old('notes', $invoice->notes ?? '') }}</textarea>
</div>

@push('scripts')
<script @cspNonce>
    // Auto-calculate IVA and total
    const amountInput = document.getElementById('amount');
    const vatInput = document.getElementById('vat_amount');
    const totalInput = document.getElementById('total');
    const statusSelect = document.getElementById('status');
    const paidDateContainer = document.getElementById('paid_date_container');

    function calculateTotal() {
        const amount = parseFloat(amountInput.value) || 0;
        const vat = parseFloat(vatInput.value) || 0;
        totalInput.value = (amount + vat).toFixed(2);
    }

    amountInput.addEventListener('input', function() {
        const amount = parseFloat(this.value) || 0;
        vatInput.value = (amount * 0.22).toFixed(2);
        calculateTotal();
    });

    vatInput.addEventListener('input', calculateTotal);

    // Show/hide paid_date based on status
    statusSelect.addEventListener('change', function() {
        if (this.value === 'pagata') {
            paidDateContainer.classList.remove('hidden');
            if (!document.getElementById('paid_date').value) {
                document.getElementById('paid_date').value = new Date().toISOString().split('T')[0];
            }
        } else {
            paidDateContainer.classList.add('hidden');
        }
    });

    // Calculate on page load if amount already set
    if (amountInput.value) {
        calculateTotal();
    }
</script>
@endpush
