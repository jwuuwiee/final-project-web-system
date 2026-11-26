<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AvatarService;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Throwable;

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

        $newPath = $request->hasFile('avatar')
            ? $this->avatars->store($request->file('avatar'))
            : null;

        $data['avatar'] = $newPath;

        try {
            User::create($data);
        } catch (Throwable $exception) {
            $this->avatars->delete($newPath);

            throw $exception;
        }

        return redirect()
            ->route('users.index')
            ->with('success', 'Staff member added.');
    }

    public function edit(User $user): View
    {
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function update(
        Request $request,
        User $user
    ): RedirectResponse {
        $data = $request->validate($this->rules($user));

        $oldPath = $user->avatar;
        $newPath = null;

        unset($data['avatar']);

        if ($request->hasFile('avatar')) {
            $newPath = $this->avatars->store(
                $request->file('avatar')
            );

            $data['avatar'] = $newPath;
        }

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        try {
            $user->update($data);
        } catch (Throwable $exception) {
            $this->avatars->delete($newPath);

            throw $exception;
        }

        if ($newPath !== null) {
            $this->avatars->delete($oldPath);
        }

        return redirect()
            ->route('users.index')
            ->with('success', 'Staff member updated.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->is(Auth::user())) {
            return back()->with(
                'error',
                'You cannot delete the account you are logged in with.'
            );
        }

        if ($user->sales()->exists()) {
            return back()->with(
                'error',
                'This staff member has recorded sales and cannot be deleted.'
            );
        }

        $oldPath = $user->avatar;

        try {
            $user->delete();
        } catch (QueryException $exception) {
            if (! in_array(
                $exception->errorInfo[0] ?? '',
                ['23000', '23503'],
                true
            )) {
                throw $exception;
            }

            return back()->with(
                'error',
                'This staff member is referenced by another record.'
            );
        }

        $this->avatars->delete($oldPath);

        return redirect()
            ->route('users.index')
            ->with('success', 'Staff member deleted.');
    }

    private function rules(?User $user = null): array
    {
        return [
            'username' => [
                'required',
                'string',
                'max:50',
                'alpha_dash',
                Rule::unique('users', 'username')->ignore($user),
            ],

            'full_name' => [
                'required',
                'string',
                'max:100',
            ],

            'password' => [
                'bail',
                $user ? 'nullable' : 'required',
                'string',
                'min:8',
                'max:72',
                'confirmed',

                function ($attribute, $value, $fail) {
                    if (strlen($value) > 72) {
                        $fail('The password must not exceed 72 bytes.');
                    }
                },
            ],

            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
                'dimensions:max_width=3000,max_height=3000',
            ],
        ];
    }
}
