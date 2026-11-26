@extends('layouts.app')

@section('title', 'Add Staff')

@section('content')
    @include('users._styles')

    <div class="page-header">
        <h1>Add Staff</h1>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
            @csrf

            @include('users._form')

            <div class="actions">
                <button type="submit" class="btn">Save</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
