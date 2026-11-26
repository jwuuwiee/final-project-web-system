<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AvatarService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(private AvatarService $avatars)
    {
    }

    public function index(): View
    {
        return view('users.index', [
            'users' => User::orderBy('full_name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules());

        $data['avatar'] = $request->hasFile('avatar')
            ? $this->avatars->store($request->file('avatar'))
            : null;

        User::create($data);

        return redirect()->route('users.index')->with('success', 'Staff member added.');
    }

    public function edit(User $user): View
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate($this->rules($user));

        if ($request->hasFile('avatar')) {
            $this->avatars->delete($user->avatar);
            $data['avatar'] = $this->avatars->store($request->file('avatar'));
        } else {
            unset($data['avatar']);
        }

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Staff member updated.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->is(Auth::user())) {
            return back()->with('error', 'You cannot delete the account you are logged in with.');
        }


        if ($user->sales()->exists()) {
            return back()->with('error', 'This staff member has recorded sales and cannot be deleted.');
        }

        $this->avatars->delete($user->avatar);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Staff member deleted.');
    }

    
    private function rules(?User $user = null): array
    {
        return [
            'username' => [
                'required', 'string', 'max:50', 'alpha_dash',
                Rule::unique('users', 'username')->ignore($user?->id),
            ],
            'full_name' => ['required', 'string', 'max:100'],
            'password' => $user
                ? ['nullable', 'string', 'min:8', 'confirmed']
                : ['required', 'string', 'min:8', 'confirmed'],
            'avatar' => [
                'nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048',
                'dimensions:max_width=3000,max_height=3000',
            ],
        ];
    }
}
