<?php

namespace App\Http\Controllers;

use App\Http\Middleware\SetLocale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LanguageController extends Controller
{
    /**
     * POST /language/{locale}
     *
     * Persists the locale in a cookie (1 year) and redirects back to the
     * originating page. Accepts {en, it, fr}.
     */
    public function switch(Request $request, string $locale): RedirectResponse
    {
        if (!in_array($locale, SetLocale::SUPPORTED, true)) {
            abort(404);
        }

        app()->setLocale($locale);

        // 1 year, same-site lax, not httponly (so JS can read to sync localStorage)
        $cookie = Cookie::make(
            name: SetLocale::COOKIE,
            value: $locale,
            minutes: 60 * 24 * 365,
            path: '/',
            domain: null,
            secure: $request->isSecure(),
            httpOnly: false,
            sameSite: 'lax'
        );

        $target = $request->input('redirect') ?: url()->previous() ?: url('/');

        return redirect($target)->withCookie($cookie);
    }
}
