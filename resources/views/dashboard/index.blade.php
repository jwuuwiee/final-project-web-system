@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1>Dashboard</h1>
    <p class="dashboard-welcome">
    Welcome to the Point-of-Sale System.
</p>

    <div class="cards">
        <div class="card">
            <h3>Total Products</h3>
            <p>{{ $productCount }}</p>
        </div>

        <div class="card">
            <h3>Total Customers</h3>
            <p>{{ $customerCount }}</p>
        </div>

        <div class="card">
            <h3>Total Sales</h3>
            <p>{{ $saleCount }}</p>
        </div>

        <div class="card">
            <h3>Total Staff</h3>
            <p>{{ $staffCount }}</p>
        </div>
    </div>
@endsection