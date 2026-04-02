<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('admin.settings.index', compact('users'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password aggiornata con successo.');
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'is_admin' => 'boolean',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => $validated['is_admin'] ?? true,
        ]);

        return back()->with('success', 'Utente creato con successo.');
    }

    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Non puoi eliminare il tuo account.');
        }
        $user->delete();
        return back()->with('success', 'Utente eliminato.');
    }

    public function toggle2fa(Request $request)
    {
        $user = $request->user();

        if ($user->two_factor_secret) {
            // Disable 2FA
            $user->update([
                'two_factor_secret' => null,
                'two_factor_confirmed_at' => null,
            ]);
            return back()->with('success', '2FA disattivato.');
        }

        // Generate new secret
        $secret = $this->generateTotpSecret();
        $user->update(['two_factor_secret' => encrypt($secret)]);

        return back()->with('success', '2FA attivato. Scansiona il QR code con Google Authenticator.')
                     ->with('twofa_secret', $secret)
                     ->with('twofa_qr', $this->getTotpUri($user->email, $secret));
    }

    public function confirm2fa(Request $request)
    {
        $request->validate(['code' => 'required|string|size:6']);

        $user = $request->user();
        if (!$user->two_factor_secret) {
            return back()->with('error', '2FA non attivato.');
        }

        $secret = decrypt($user->two_factor_secret);
        if ($this->verifyTotp($secret, $request->code)) {
            $user->update(['two_factor_confirmed_at' => now()]);
            return back()->with('success', '2FA confermato e attivo.');
        }

        return back()->with('error', 'Codice non valido. Riprova.');
    }

    public function updateConfig(Request $request)
    {
        $validated = $request->validate([
            'mail_host' => 'nullable|string|max:255',
            'mail_port' => 'nullable|integer',
            'mail_username' => 'nullable|string|max:255',
            'mail_password' => 'nullable|string|max:255',
            'mail_from_address' => 'nullable|email|max:255',
            'mail_from_name' => 'nullable|string|max:255',
            'anthropic_api_key' => 'nullable|string|max:255',
            'tinymce_key' => 'nullable|string|max:255',
        ]);

        // Update .env file
        $envPath = base_path('.env');
        $envContent = file_get_contents($envPath);

        $mappings = [
            'mail_host' => 'MAIL_HOST',
            'mail_port' => 'MAIL_PORT',
            'mail_username' => 'MAIL_USERNAME',
            'mail_password' => 'MAIL_PASSWORD',
            'mail_from_address' => 'MAIL_FROM_ADDRESS',
            'mail_from_name' => 'MAIL_FROM_NAME',
            'anthropic_api_key' => 'ANTHROPIC_API_KEY',
            'tinymce_key' => 'TINYMCE_KEY',
        ];

        foreach ($mappings as $field => $envKey) {
            if ($request->filled($field)) {
                $value = $validated[$field];
                if (preg_match("/^{$envKey}=.*/m", $envContent)) {
                    $envContent = preg_replace("/^{$envKey}=.*/m", "{$envKey}={$value}", $envContent);
                } else {
                    $envContent .= "\n{$envKey}={$value}";
                }
            }
        }

        file_put_contents($envPath, $envContent);

        return back()->with('success', 'Configurazione aggiornata. Riavvia l\'app per applicare le modifiche.');
    }

    private function generateTotpSecret(): string
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $secret = '';
        for ($i = 0; $i < 32; $i++) {
            $secret .= $chars[random_int(0, strlen($chars) - 1)];
        }
        return $secret;
    }

    private function getTotpUri(string $email, string $secret): string
    {
        return 'otpauth://totp/Corvalys:' . urlencode($email) . '?secret=' . $secret . '&issuer=Corvalys&digits=6&period=30';
    }

    private function verifyTotp(string $secret, string $code): bool
    {
        $timeSlice = floor(time() / 30);

        for ($i = -1; $i <= 1; $i++) {
            $calculatedCode = $this->calculateTotp($secret, $timeSlice + $i);
            if (hash_equals($calculatedCode, $code)) {
                return true;
            }
        }
        return false;
    }

    private function calculateTotp(string $secret, int $timeSlice): string
    {
        // Base32 decode
        $base32Chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
        $binary = '';
        $secret = strtoupper($secret);

        for ($i = 0; $i < strlen($secret); $i++) {
            $binary .= str_pad(decbin(strpos($base32Chars, $secret[$i])), 5, '0', STR_PAD_LEFT);
        }

        $binarySecret = '';
        for ($i = 0; $i + 8 <= strlen($binary); $i += 8) {
            $binarySecret .= chr(bindec(substr($binary, $i, 8)));
        }

        $time = pack('N*', 0) . pack('N*', $timeSlice);
        $hash = hash_hmac('sha1', $time, $binarySecret, true);
        $offset = ord($hash[strlen($hash) - 1]) & 0x0F;
        $value = (
            ((ord($hash[$offset]) & 0x7F) << 24) |
            ((ord($hash[$offset + 1]) & 0xFF) << 16) |
            ((ord($hash[$offset + 2]) & 0xFF) << 8) |
            (ord($hash[$offset + 3]) & 0xFF)
        );

        return str_pad($value % 1000000, 6, '0', STR_PAD_LEFT);
    }
}
