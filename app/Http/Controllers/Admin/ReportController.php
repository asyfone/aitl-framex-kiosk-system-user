<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BillingInfo;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function salesSummary(Request $request)
    {
        // Apply optional date filter
        $query = BillingInfo::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('bill_date', [$request->start_date, $request->end_date]);
        }

        $sales = $query->orderByDesc('bill_date')->get();

        // Summary values
        $totalSales = $sales->sum('bill_total_amount');
        $totalTransactions = $sales->count();

        return view('admin.reports.sales_summary', compact('sales', 'totalSales', 'totalTransactions'));
    }
}