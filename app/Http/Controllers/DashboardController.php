<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClients = Client::count();

        $totalInvoices = Invoice::count();

        $totalUnpaidAmount = Invoice::where('status', 'impayée')->sum('amount');

        return view('dashboard.index', compact('totalClients', 'totalInvoices', 'totalUnpaidAmount'));
    }
}
