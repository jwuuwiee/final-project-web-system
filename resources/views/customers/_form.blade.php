@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@csrf

<div>
    <label for="full_name">Full Name</label><br>
    <input type="text"
           id="full_name"
           name="full_name"
           value="{{ old('full_name', $customer->full_name ?? '') }}"
           maxlength="100"
           required>
</div>

<br>

<div>
    <label for="email">Email</label><br>
    <input type="email"
           id="email"
           name="email"
           value="{{ old('email', $customer->email ?? '') }}"
           maxlength="100"
           required>
</div>

<br>

<div>
    <label for="phone">Phone</label><br>
    <input type="text"
           id="phone"
           name="phone"
           value="{{ old('phone', $customer->phone ?? '') }}"
           maxlength="20">
</div>

<br>

<button type="submit">Save Customer</button>
<a href="{{ route('customers.index') }}">Cancel</a>