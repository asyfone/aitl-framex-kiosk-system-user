{{-- Sales Summary Report --}}
@extends('layouts.admin')

@section('title', 'Sales Summary')

@section('content')
    @php
        // Ensure $sales is always defined as a collection
        $sales = $sales ?? collect();
        $totalSales = $totalSales ?? $sales->sum('bill_total_amount');
        $totalTransactions = $totalTransactions ?? $sales->count();
    @endphp
    <div class="mb-6">
        <h2 class="text-2xl font-semibold mb-2">Sales Summary Report</h2>

        {{-- Filter Form --}}
        <form method="GET" class="mb-4 flex gap-4 items-center">
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="border p-2 rounded" />
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="border p-2 rounded" />
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
        </form>

        {{-- Summary Cards --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
            <div class="p-4 bg-white rounded shadow">
                <p class="text-gray-600">Total Sales</p>
                <p class="text-lg font-bold text-green-600">৳{{ number_format($totalSales, 2) }}</p>
            </div>
            <div class="p-4 bg-white rounded shadow">
                <p class="text-gray-600">Total Transactions</p>
                <p class="text-lg font-bold">{{ $totalTransactions }}</p>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-2 border">#</th>
                        <th class="p-2 border">Date</th>
                        <th class="p-2 border">Customer</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">Phone</th>
                        <th class="p-2 border">Address</th>
                        <th class="p-2 border">Amount (৳)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $index => $sale)
                        <tr class="border-t">
                            <td class="p-2 border">{{ $index + 1 }}</td>
                            <td class="p-2 border">{{ \Carbon\Carbon::parse($sale->bill_date)->format('d M Y') }}</td>
                            <td class="p-2 border">{{ $sale->customer_name }}</td>
                            <td class="p-2 border">{{ $sale->customer_email }}</td>
                            <td class="p-2 border">{{ $sale->customer_phone_no }}</td>
                            <td class="p-2 border">{{ $sale->customer_address }}</td>
                            <td class="p-2 border text-right font-semibold">৳{{ number_format($sale->bill_total_amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-4 text-center text-gray-500">No data found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
