@extends('layouts.app')

@section('title', 'Edit Staff')

@section('content')
    @include('users._styles')

    <div class="page-header">
        <h1>Edit Staff</h1>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('users._form')

            <div class="actions">
                <button type="submit" class="btn">Update</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
