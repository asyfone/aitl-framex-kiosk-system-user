<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BillingInfo;
use Illuminate\Http\Request;


class BillingInfoController extends Controller
{
    // Store a newly created Billing in storage
    public function store(Request $request)
    {
        $request->validate([
            'total'   => 'required|numeric',
            'name'    => 'required|string',
            'email'   => 'required|email',
            'phone'   => 'required|string',
            'address' => 'required|string',
        ]);
      
        BillingInfo::create([
            'bill_date'          => now(), 
            'bill_total_amount'  => $request->input('total'),
            'customer_name'      => $request->input('name'),
            'customer_email'     => $request->input('email'),
            'customer_phone_no'  => $request->input('phone'),
            'customer_address'   => $request->input('address'),
        ]);
      
        return response()->json(['message' => 'Billing info saved successfully']);
    }

    // Store a newly created Billing from user in storage
    public function storeFromUser(Request $request)
    {
        $request->validate([
            'total'   => 'required|numeric',
            'name'    => 'required|string',
            'email'   => 'required|email',
            'phone'   => 'required|string',
            'address' => 'nullable|string',
            'mapping' => 'nullable|array',
        ]);

        \App\Models\BillingInfo::create([
            'bill_date'         => now(),
            'bill_total_amount' => $request->input('total'),
            'customer_name'     => $request->input('name'),
            'customer_email'    => $request->input('email'),
            'customer_phone_no' => $request->input('phone'),
            'customer_address'  => $request->input('address'),
            'frame_mapping'     => $request->has('mapping') ? json_encode($request->input('mapping')) : null,
        ]);

        return response()->json(['message' => 'Billing saved'], 200);
    }

    // Display a listing of the resource.
    public function index()
    {
        $billingInfos = BillingInfo::orderBy('bill_date', 'desc')->paginate(20);
        return view('admin.billing.index', compact('billingInfos'));
    }
}
