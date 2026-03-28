@extends('layouts.admin')

@section('title', 'Team')

@section('content')
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-gray-500">Gestisci i membri del team</p>
        <a href="{{ route('admin.team-members.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-dark text-white text-sm font-medium rounded-lg hover:bg-primary transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Nuovo membro
        </a>
    </div>

    {{-- Team Members Table --}}
    <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50/80">
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Foto</th>
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Nome</th>
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Ruolo</th>
                        <th class="text-center px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Ordine</th>
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Stato</th>
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Azioni</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($members ?? [] as $member)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-5 py-3">
                                @if($member->photo)
                                    <img src="{{ asset($member->photo) }}" alt="{{ $member->name }}" class="w-10 h-10 rounded-full object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <p class="font-medium text-gray-900">{{ $member->name }}</p>
                            </td>
                            <td class="px-5 py-3 text-gray-600">{{ $member->role }}</td>
                            <td class="px-5 py-3 text-center text-gray-500">{{ $member->sort_order }}</td>
                            <td class="px-5 py-3">
                                @if($member->is_active)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        <span class="w-1.5 h-1.5 rounded-full mr-1.5 bg-green-500"></span>
                                        Attivo
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                        <span class="w-1.5 h-1.5 rounded-full mr-1.5 bg-gray-400"></span>
                                        Inattivo
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.team-members.edit', $member) }}" class="inline-flex items-center text-primary hover:text-primary-dark text-xs font-medium">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        Modifica
                                    </a>
                                    <form method="POST" action="{{ route('admin.team-members.destroy', $member) }}" class="inline" onsubmit="return confirm('Sei sicuro di voler eliminare questo membro?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center text-red-500 hover:text-red-700 text-xs font-medium">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            Elimina
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-8 text-center text-gray-400 text-sm">Nessun membro del team presente</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(isset($members) && $members->hasPages())
            <div class="px-5 py-3 border-t border-gray-100">
                {{ $members->links() }}
            </div>
        @endif
    </div>
@endsection
