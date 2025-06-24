<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BillingInfo;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function store(Request $request)
    {
        // Validate first
        $request->validate([
            'total' => 'required|integer',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        BillingInfo::create([
            'bill_date' => now(), 
            'bill_total_amount' => $request->input('total'),
            'customer_name' => $request->input('name'),
            'customer_email' => $request->input('email'),
            'customer_phone_no' => $request->input('phone'),
            'customer_address' => $request->input('address'),
        ]);

        return response()->json(['message' => 'Billing info saved successfully.']);
    }
}
