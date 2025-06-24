@extends('layouts.admin')

@section('content')
<h1>All Billing</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Total</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($billings as $billing)
        <tr>
            <td>{{ $billing->id }}</td>
            <td>{{ $billing->bill_date }}</td>
            <td>{{ $billing->bill_total_amount }}</td>
            <td>{{ $billing->customer_name }}</td>
            <td>{{ $billing->customer_email }}</td>
            <td>{{ $billing->customer_phone_no }}</td>
            <td>{{ $billing->customer_address }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
