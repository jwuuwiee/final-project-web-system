
<div class="form-group">
    <label for="full_name">Full name</label>
    <input type="text" id="full_name" name="full_name" maxlength="100" required
           value="{{ old('full_name', $user->full_name ?? '') }}">
    @error('full_name')
        <div class="field-error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" maxlength="50" required autocomplete="off"
           value="{{ old('username', $user->username ?? '') }}">
    <div class="hint">Letters, numbers, dashes, and underscores only.</div>
    @error('username')
        <div class="field-error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" autocomplete="new-password"
           @if (! isset($user)) required @endif>
    <div class="hint">
        At least 8 characters.
        @isset($user) Leave blank to keep the current password. @endisset
    </div>
    @error('password')
        <div class="field-error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="password_confirmation">Confirm password</label>
    <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password"
           @if (! isset($user)) required @endif>
</div>

<div class="form-group">
    <label for="avatar">Avatar</label>

    @if (isset($user) && $user->avatar_url)
        <img src="{{ $user->avatar_url }}" alt="Current avatar" class="avatar" style="margin-bottom: 8px;">
    @endif

    <input type="file" id="avatar" name="avatar" accept="image/png,image/jpeg">
    <div class="hint">JPG or PNG, up to 2 MB. It is cropped to a square automatically.</div>
    @error('avatar')
        <div class="field-error">{{ $message }}</div>
    @enderror
</div>
