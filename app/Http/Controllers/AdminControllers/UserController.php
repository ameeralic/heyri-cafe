<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Services\FileManagement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('AdminDashboard/Users/Index', [
            'users' => User::filter(
                request(['search', 'dateStart', 'dateEnd', 'sortBy', 'roles'])
            )
                ->with(['roles'])->paginate(3)->withQueryString(),
            'filters' => Request::only(['search', 'sortBy', 'dateStart', 'dateEnd', 'roles']),
            'roles' => Role::all(),
        ]);
    }

    public function create()
    {
        return Inertia::render('AdminDashboard/Users/Create', [
            'roles' => Role::where('value', '!=', 'USER_ROLE')->get(),
        ]);
    }

    public function store(FileManagement $fileManagement)
    {
        // dd('ss');
        $attributes = $this->validateUser();
        if ($attributes['avatar'] ?? false) {
            $attributes['avatar'] = $fileManagement->uploadFile(
                file:$attributes['avatar'],
                path:'images/users/' . $attributes['email'] . '/avatar'
            );
        }

        if (isset($attributes['roles'])) {
            $roles = $attributes['roles'];
            unset($attributes['roles']);
        }

        $user = User::create($attributes);

        if (isset($roles)) {
            $user->roles()->sync($roles);
        }

        $user->roles()->attach([1]);

        if (Auth::guard('web')->check()) {
            if (Auth::user()->can('admin')) {
                return redirect('/admin-dashboard')->with('success', 'User has been created.');
            }
            return;
        }
        return;

    }

    public function edit(User $user)
    {
        return Inertia::render('AdminDashboard/Users/Edit', [
            'user' => $user,
            'user_roles' => $user->roles()->pluck('role_id'),
            'roles' => Role::where('value', '!=', 'USER_ROLE')->get(['id', 'name', 'value']),
        ]);

    }

    public function update(User $user)
    {

        $attributes = $this->validateUser($user);
        $fileManagement = new FileManagement();

        if ($attributes['avatar']) {
            $attributes['avatar'] =
            $fileManagement->uploadFile(
                file:$attributes['avatar'] ?? false,
                deleteOldFile:$user->avatar ?? false,
                oldFile:$user->avatar,
                path:'images/users/' . ($user['email'] !== $attributes['email'] ? $attributes['email'] : $user['email']) . '/avatar',
            );
        } else if ($user->avatar) {
            $fileManagement->deleteFile(
                fileUrl:$user->avatar
            );
        }

        if ($user['email'] !== $attributes['email']) {
            $fileManagement->moveFiles(
                oldPath:'images/users/' . $user['email'] . '/avatar',
                newPath:'images/users/' . $attributes['email'] . '/avatar',
                deleteDirectory:'images/users/' . $user['email']
            );
            $attributes['avatar'] = str_replace($user['email'], $attributes['email'], $attributes['avatar']);
        }
        if (isset($attributes['roles'])) {
            $roles = $attributes['roles'];
            unset($attributes['roles']);
        }
        if (isset($roles)) {
            // dd($roles);
            //dd($roles === [1, 2]);
            $user->roles()->sync($roles);
        }
        // $user->roles()->sync([1]);
        $user->update($attributes);

        return back()->with('success', 'User Profile Updated!');
    }

    protected function validateUser( ? User $user = null) : array
    {
        $user ??= new User();

        return request()->validate(
            [
                'first_name' => 'required|min:3|max:50',
                'last_name' => 'required|max:50',
                'avatar' => $user->exists ? 'nullable' : 'nullable|mimes:jpeg,png |max:2096',
                'dob' => 'required|max:50',
                'roles' => [Auth::guard('web')->user()->can('admin') ? 'nullable' : 'exclude'],
                'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user)],
                'password' => (request()->input('password') ?? false || !$user->exists) ? 'required|confirmed|min:6' : 'exclude',
                'tac' => 'required|accepted',
            ],
            [
                'dob' => 'Date of birth required',
                'roles' => 'Please select roles',
                'phone_number' => 'Enter a valid Phone number with country code',
                'avatar' => 'Upload Profile image as jpg/png format with size less than 2MB',
                'tac' => 'Please agree to the Terms and Conditions!',
            ]
        );
    }
}
