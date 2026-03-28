@extends('layouts.admin')

@section('title', 'Partner')

@section('content')
    <div class="mb-6">
        <p class="text-sm text-gray-500">Gestisci le richieste di partnership</p>
    </div>

    {{-- Partners Table --}}
    <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50/80">
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Nome</th>
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Email</th>
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Studio</th>
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Clienti</th>
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Stato</th>
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Data</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($partners ?? [] as $partner)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-5 py-3 font-medium text-gray-900">{{ $partner->name }}</td>
                            <td class="px-5 py-3 text-gray-600">
                                <a href="mailto:{{ $partner->email }}" class="text-primary hover:text-primary-dark">{{ $partner->email }}</a>
                            </td>
                            <td class="px-5 py-3 text-gray-600">{{ $partner->studio_name ?? '-' }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $partner->clients_count ?? '-' }}</td>
                            <td class="px-5 py-3">
                                <form method="POST" action="{{ route('admin.partners.update', $partner) }}" class="inline-flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    @php
                                        $partnerStatusColors = [
                                            'pending' => 'bg-amber-100 text-amber-700',
                                            'approved' => 'bg-green-100 text-green-700',
                                            'rejected' => 'bg-red-100 text-red-700',
                                            'active' => 'bg-blue-100 text-blue-700',
                                        ];
                                        $pColor = $partnerStatusColors[$partner->status] ?? 'bg-gray-100 text-gray-600';
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $pColor }}">{{ ucfirst($partner->status) }}</span>
                                    <select name="status" onchange="this.form.submit()" class="rounded-lg border-gray-300 text-xs py-1 focus:border-primary focus:ring-primary">
                                        <option value="pending" {{ $partner->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ $partner->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ $partner->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        <option value="active" {{ $partner->status === 'active' ? 'selected' : '' }}>Active</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-5 py-3 text-xs text-gray-400">{{ $partner->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-8 text-center text-gray-400 text-sm">Nessuna richiesta partner</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(isset($partners) && $partners->hasPages())
            <div class="px-5 py-3 border-t border-gray-100">
                {{ $partners->links() }}
            </div>
        @endif
    </div>
@endsection
