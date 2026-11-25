@extends('layouts.app')

@section('title', 'Record Sale')

@section('content')
    <h1>Record Sale</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($products->isEmpty())
        <p style="color: red;">
            No products with available stock were found.
        </p>
    @endif

    @if ($staff->isEmpty())
        <p style="color: red;">
            No staff accounts were found. A staff account is required to record a sale.
        </p>
    @endif

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf

        <div>
            <label for="product_id">Product</label><br>

            <select name="product_id" id="product_id" required>
                <option value="">Select Product</option>

                @foreach ($products as $product)
                    <option value="{{ $product->id }}"
                        {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                        - ₱{{ number_format($product->price, 2) }}
                        - Stock: {{ $product->stock_quantity }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label for="customer_id">Customer</label><br>

            <select name="customer_id" id="customer_id">
                <option value="">Walk-in Customer</option>

                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}"
                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->full_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label for="sold_by">Staff</label><br>

            <select name="sold_by" id="sold_by" required>
                <option value="">Select Staff</option>

                @foreach ($staff as $member)
                    <option value="{{ $member->id }}"
                        {{ old('sold_by') == $member->id ? 'selected' : '' }}>
                        {{ $member->full_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label for="quantity">Quantity</label><br>

            <input type="number"
                   name="quantity"
                   id="quantity"
                   value="{{ old('quantity', 1) }}"
                   min="1"
                   required>
        </div>

        <br>

        <button type="submit">Record Sale</button>
        <a href="{{ route('sales.index') }}">Cancel</a>
    </form>
@endsection