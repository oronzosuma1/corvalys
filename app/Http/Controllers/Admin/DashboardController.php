<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Invoice;
use App\Models\Lead;
use App\Models\NewsletterSubscriber;
use App\Models\PartnerRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'leads_new' => Lead::new()->count(),
            'leads_active' => Lead::active()->count(),
            'leads_total' => Lead::count(),
            'articles' => Article::count(),
            'articles_published' => Article::published()->count(),
            'subscribers' => NewsletterSubscriber::count(),
            'partners' => PartnerRequest::where('status', 'new')->count(),
            'revenue_month' => Invoice::emesse()->pagate()->whereMonth('paid_date', now()->month)->whereYear('paid_date', now()->year)->sum('total'),
            'expenses_month' => Invoice::ricevute()->pagate()->whereMonth('paid_date', now()->month)->whereYear('paid_date', now()->year)->sum('total'),
            'invoices_overdue' => Invoice::scadute()->count(),
            'invoices_pending' => Invoice::where('status', 'inviata')->count(),
        ];

        $recentLeads = Lead::latest()->take(5)->get();
        $recentArticles = Article::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentLeads', 'recentArticles'));
    }
}
