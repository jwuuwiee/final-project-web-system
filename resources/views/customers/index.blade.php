@extends('layouts.app')

@section('title', 'Customers')

@section('content')
    <h1>Customers</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <p>
        <a href="{{ route('customers.create') }}" class="btn btn-add">
    + Add Customer
</a>    

    </p>

    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($customers as $customer)
                <tr>
                    <td>{{ $customer->full_name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('customers.edit', $customer) }}"
   class="btn btn-edit">
    Edit
</a>    

                        <form action="{{ route('customers.destroy', $customer) }}"
                              method="POST"
                              style="display: inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
        class="btn btn-delete"
        onclick="return confirm('Delete this customer?')">
    Delete
</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No customers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    {{ $customers->links() }}
@endsection