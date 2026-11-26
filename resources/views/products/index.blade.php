@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <h1>Products</h1>

    <a href="{{ route('products.create') }}" class="btn btn-add">
        + Add Product
    </a>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>
                        @if($product->image)
                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                width="70"
                                height="70"
                                style="object-fit: cover; border-radius: 6px;"
                            >
                        @else
                            No Image
                        @endif
                    </td>

                    <td>{{ $product->name }}</td>

                    <td>
                        ₱{{ number_format($product->price, 2) }}
                    </td>

                    <td>{{ $product->stock_quantity }}</td>

                    <td>
                        <a
                            href="{{ route('products.edit', $product->id) }}"
                            class="btn btn-edit"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route('products.destroy', $product->id) }}"
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-delete"
                                onclick="return confirm('Are you sure you want to delete this product?')"
                            >
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection