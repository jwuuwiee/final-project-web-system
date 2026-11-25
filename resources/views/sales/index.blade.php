@extends('layouts.app')

@section('title', 'Sales History')

@section('content')
    <h1>Sales History</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <p>
        <a href="{{ route('sales.create') }}">Record Sale</a>
    </p>

    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Product</th>
                <th>Customer</th>
                <th>Staff</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($sales as $sale)
                <tr>
                    <td>{{ $sale->created_at->format('M d, Y h:i A') }}</td>
                    <td>{{ $sale->product->name }}</td>
                    <td>{{ $sale->customer->full_name ?? 'Walk-in Customer' }}</td>
                    <td>{{ $sale->staff->full_name ?? 'N/A' }}</td>
                    <td>{{ $sale->quantity }}</td>
                    <td>₱{{ number_format($sale->total_price, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No sales recorded yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    {{ $sales->links() }}
@endsection