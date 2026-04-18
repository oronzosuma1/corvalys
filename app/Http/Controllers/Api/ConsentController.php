<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ConsentLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ConsentController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'categories' => 'required|array',
            'categories.necessary' => 'required|boolean',
            'categories.functional' => 'required|boolean',
            'categories.analytics' => 'required|boolean',
            'categories.marketing' => 'required|boolean',
            'action' => 'required|in:accept,reject,custom,update',
            'policy_version' => 'required|string|max:20',
        ]);

        $sessionIdHash = hash('sha256', $request->session()->getId());
        $ipHash = hash('sha256', $request->ip() . config('app.key'));
        $dnt = $request->header('DNT') === '1';
        $gpc = $request->header('Sec-GPC') === '1';
        $locale = $request->input('locale') ?? app()->getLocale();

        ConsentLog::create([
            'session_id' => $sessionIdHash,
            'ip_hash' => $ipHash,
            'user_agent' => $request->userAgent(),
            'categories_accepted' => $validated['categories'],
            'policy_version' => $validated['policy_version'],
            'locale' => $locale ? substr($locale, 0, 5) : null,
            'action' => $validated['action'],
            'dnt' => $dnt,
            'gpc' => $gpc,
        ]);

        return response()->json(['ok' => true]);
    }
}
