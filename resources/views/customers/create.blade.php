@extends('layouts.app')

@section('title', 'Add Customer')

@section('content')
    <h1>Add Customer</h1>

    <form action="{{ route('customers.store') }}" method="POST">
        @include('customers._form')
    </form>
@endsection