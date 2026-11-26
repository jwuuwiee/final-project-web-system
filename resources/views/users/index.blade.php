@extends('layouts.app')

@section('title', 'Staff')

@section('content')
    @include('users._styles')

    <div class="page-header">
        <h1>Staff</h1>
        <a href="{{ route('users.create') }}" class="btn">Add Staff</a>
    </div>

    @include('users._alerts')

    <table class="table">
        <thead>
            <tr>
                <th>Avatar</th>
                <th>Full name</th>
                <th>Username</th>
                <th>Added</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>
                        @if ($user->avatar_url)
                            <img src="{{ $user->avatar_url }}" alt="Avatar of {{ $user->full_name }}" class="avatar">
                        @else
                            <div class="avatar-placeholder">{{ mb_strtoupper(mb_substr($user->full_name, 0, 1)) }}</div>
                        @endif
                    </td>
                    <td>
                        {{ $user->full_name }}
                        @if ($user->id === auth()->id())
                            <span class="badge">You</span>
                        @endif
                    </td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->created_at?->format('M d, Y') }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-secondary">Edit</a>

                            @if ($user->id !== auth()->id())
                                <form method="POST" action="{{ route('users.destroy', $user) }}"
                                      onsubmit="return confirm('Delete this staff member?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No staff members yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
