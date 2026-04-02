@extends('layouts.admin')

@section('title', 'Impostazioni')

@section('content')
<div class="space-y-8 max-w-4xl">

    {{-- Section 1: Change Password --}}
    <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-base font-heading font-semibold text-primary-dark">Cambia Password</h2>
            <p class="text-xs text-gray-400 mt-1">Aggiorna la password del tuo account</p>
        </div>
        <form method="POST" action="{{ route('admin.settings.password') }}" class="px-6 py-5 space-y-4">
            @csrf
            <div>
                <label for="current_password" class="block text-xs font-medium text-gray-500 mb-1.5">Password attuale</label>
                <input type="password" name="current_password" id="current_password" required
                    class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary @error('current_password') border-red-300 @enderror">
                @error('current_password')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-xs font-medium text-gray-500 mb-1.5">Nuova password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary @error('password') border-red-300 @enderror">
                    @error('password')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-xs font-medium text-gray-500 mb-1.5">Conferma password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                </div>
            </div>
            <div class="pt-2">
                <button type="submit" class="px-5 py-2.5 bg-primary-dark text-white text-sm font-medium rounded-lg hover:bg-primary-dark/90 transition-colors">
                    Aggiorna Password
                </button>
            </div>
        </form>
    </div>

    {{-- Section 2: User Management --}}
    <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-base font-heading font-semibold text-primary-dark">Gestione Utenti</h2>
            <p class="text-xs text-gray-400 mt-1">Gestisci gli utenti amministratori</p>
        </div>
        <div class="px-6 py-5">
            {{-- Users table --}}
            <div class="overflow-x-auto mb-6">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="text-left py-2.5 px-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                            <th class="text-left py-2.5 px-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="text-left py-2.5 px-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Ruolo</th>
                            <th class="text-right py-2.5 px-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Azioni</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50/50">
                                <td class="py-3 px-3 text-sm text-gray-700">{{ $user->name }}</td>
                                <td class="py-3 px-3 text-sm text-gray-500">{{ $user->email }}</td>
                                <td class="py-3 px-3">
                                    @if ($user->is_admin)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-primary-light text-primary-dark">Admin</span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">Utente</span>
                                    @endif
                                </td>
                                <td class="py-3 px-3 text-right">
                                    @if ($user->id !== auth()->id())
                                        <form method="POST" action="{{ route('admin.settings.users.destroy', $user) }}" class="inline"
                                              onsubmit="return confirm('Sei sicuro di voler eliminare questo utente?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-medium transition-colors">
                                                Elimina
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-gray-300">Tu</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Add new user form --}}
            <div class="border-t border-gray-100 pt-5">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Aggiungi nuovo utente</h3>
                <form method="POST" action="{{ route('admin.settings.users.store') }}" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="user_name" class="block text-xs font-medium text-gray-500 mb-1.5">Nome</label>
                            <input type="text" name="name" id="user_name" required value="{{ old('name') }}"
                                class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary @error('name') border-red-300 @enderror">
                            @error('name')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="user_email" class="block text-xs font-medium text-gray-500 mb-1.5">Email</label>
                            <input type="email" name="email" id="user_email" required value="{{ old('email') }}"
                                class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary @error('email') border-red-300 @enderror">
                            @error('email')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="user_password" class="block text-xs font-medium text-gray-500 mb-1.5">Password</label>
                            <input type="password" name="password" id="user_password" required
                                class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                        </div>
                        <div>
                            <label for="user_password_confirmation" class="block text-xs font-medium text-gray-500 mb-1.5">Conferma password</label>
                            <input type="password" name="password_confirmation" id="user_password_confirmation" required
                                class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="hidden" name="is_admin" value="0">
                        <input type="checkbox" name="is_admin" id="user_is_admin" value="1" checked
                            class="rounded border-gray-300 text-primary focus:ring-primary">
                        <label for="user_is_admin" class="text-sm text-gray-600">Amministratore</label>
                    </div>
                    <div class="pt-2">
                        <button type="submit" class="px-5 py-2.5 bg-primary-dark text-white text-sm font-medium rounded-lg hover:bg-primary-dark/90 transition-colors">
                            Crea Utente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Section 3: Two-Factor Authentication --}}
    <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-base font-heading font-semibold text-primary-dark">Autenticazione a Due Fattori</h2>
            <p class="text-xs text-gray-400 mt-1">Proteggi il tuo account con Google Authenticator</p>
        </div>
        <div class="px-6 py-5">
            @php
                $user = auth()->user();
                $has2fa = !empty($user->two_factor_secret);
                $confirmed2fa = !empty($user->two_factor_confirmed_at);
            @endphp

            @if (!$has2fa)
                {{-- 2FA not enabled --}}
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">La 2FA non e' attiva sul tuo account.</p>
                        <p class="text-xs text-gray-400 mt-1">Abilita l'autenticazione a due fattori per maggiore sicurezza.</p>
                    </div>
                    <form method="POST" action="{{ route('admin.settings.2fa.toggle') }}">
                        @csrf
                        <button type="submit" class="px-5 py-2.5 bg-primary-dark text-white text-sm font-medium rounded-lg hover:bg-primary-dark/90 transition-colors">
                            Attiva 2FA
                        </button>
                    </form>
                </div>
            @elseif ($has2fa && !$confirmed2fa)
                {{-- 2FA enabled but not confirmed --}}
                <div class="space-y-4">
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <p class="text-sm text-yellow-800 font-medium">2FA attivato - Conferma richiesta</p>
                        <p class="text-xs text-yellow-600 mt-1">Scansiona il codice con Google Authenticator e inserisci il codice di verifica.</p>
                    </div>

                    @if (session('twofa_secret'))
                        <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1.5">Chiave segreta (inserisci manualmente)</label>
                                <div class="flex items-center gap-2">
                                    <code class="flex-1 block px-3 py-2 bg-white rounded-lg border border-gray-200 text-sm font-mono text-gray-700 select-all">{{ session('twofa_secret') }}</code>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1.5">URI per QR Code</label>
                                <code class="block px-3 py-2 bg-white rounded-lg border border-gray-200 text-xs font-mono text-gray-500 break-all select-all">{{ session('twofa_qr') }}</code>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.settings.2fa.confirm') }}" class="flex items-end gap-3">
                        @csrf
                        <div class="flex-1 max-w-xs">
                            <label for="2fa_code" class="block text-xs font-medium text-gray-500 mb-1.5">Codice di verifica</label>
                            <input type="text" name="code" id="2fa_code" required maxlength="6" pattern="[0-9]{6}"
                                placeholder="000000"
                                class="w-full rounded-lg border-gray-300 text-sm font-mono tracking-widest text-center focus:border-primary focus:ring-primary @error('code') border-red-300 @enderror">
                            @error('code')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="px-5 py-2.5 bg-primary-dark text-white text-sm font-medium rounded-lg hover:bg-primary-dark/90 transition-colors">
                            Conferma
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.settings.2fa.toggle') }}">
                        @csrf
                        <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-medium transition-colors">
                            Annulla e disattiva 2FA
                        </button>
                    </form>
                </div>
            @else
                {{-- 2FA confirmed and active --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            2FA Attivo
                        </span>
                        <p class="text-sm text-gray-600">L'autenticazione a due fattori e' attiva.</p>
                    </div>
                    <form method="POST" action="{{ route('admin.settings.2fa.toggle') }}"
                          onsubmit="return confirm('Sei sicuro di voler disattivare la 2FA?')">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                            Disattiva 2FA
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    {{-- Section 4: Email & API Configuration --}}
    <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-base font-heading font-semibold text-primary-dark">Configurazione Email & API</h2>
            <p class="text-xs text-gray-400 mt-1">Impostazioni SMTP e chiavi API</p>
        </div>
        <form method="POST" action="{{ route('admin.settings.config') }}" class="px-6 py-5 space-y-5">
            @csrf

            {{-- SMTP Settings --}}
            <div>
                <h3 class="text-sm font-semibold text-gray-700 mb-3">Impostazioni SMTP</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="mail_host" class="block text-xs font-medium text-gray-500 mb-1.5">MAIL_HOST</label>
                        <input type="text" name="mail_host" id="mail_host" value="{{ config('mail.mailers.smtp.host') }}"
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="mail_port" class="block text-xs font-medium text-gray-500 mb-1.5">MAIL_PORT</label>
                        <input type="number" name="mail_port" id="mail_port" value="{{ config('mail.mailers.smtp.port') }}"
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="mail_username" class="block text-xs font-medium text-gray-500 mb-1.5">MAIL_USERNAME</label>
                        <input type="text" name="mail_username" id="mail_username" value="{{ config('mail.mailers.smtp.username') }}"
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="mail_password" class="block text-xs font-medium text-gray-500 mb-1.5">MAIL_PASSWORD</label>
                        <input type="password" name="mail_password" id="mail_password" placeholder="••••••••"
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="mail_from_address" class="block text-xs font-medium text-gray-500 mb-1.5">MAIL_FROM_ADDRESS</label>
                        <input type="email" name="mail_from_address" id="mail_from_address" value="{{ config('mail.from.address') }}"
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    </div>
                    <div>
                        <label for="mail_from_name" class="block text-xs font-medium text-gray-500 mb-1.5">MAIL_FROM_NAME</label>
                        <input type="text" name="mail_from_name" id="mail_from_name" value="{{ config('mail.from.name') }}"
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    </div>
                </div>
            </div>

            {{-- API Keys --}}
            <div class="border-t border-gray-100 pt-5">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">Chiavi API</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="anthropic_api_key" class="block text-xs font-medium text-gray-500 mb-1.5">ANTHROPIC_API_KEY</label>
                        <input type="password" name="anthropic_api_key" id="anthropic_api_key" placeholder="sk-ant-••••••••"
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                        <p class="text-xs text-gray-400 mt-1">Lascia vuoto per mantenere il valore attuale.</p>
                    </div>
                    <div>
                        <label for="tinymce_key" class="block text-xs font-medium text-gray-500 mb-1.5">TINYMCE_KEY</label>
                        <input type="text" name="tinymce_key" id="tinymce_key" value="{{ config('corvalys.tinymce_key') }}"
                            placeholder="la-tua-chiave-tinymce"
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                        <p class="text-xs text-gray-400 mt-1">Chiave API per l'editor di testo TinyMCE. <a href="https://www.tiny.cloud/auth/signup/" target="_blank" class="text-primary hover:underline">Ottieni una chiave gratuita</a></p>
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="px-5 py-2.5 bg-primary-dark text-white text-sm font-medium rounded-lg hover:bg-primary-dark/90 transition-colors">
                    Salva Configurazione
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
