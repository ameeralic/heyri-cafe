<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\FileManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('AdminDashboard/Users/Index', [
            'users' => User::filter(
                request(['search', 'dateStart', 'dateEnd', 'sortBy'])
            )
            ->paginate(3)->withQueryString(),
            'filters' => Request::only(['search', 'sortBy', 'dateStart', 'dateEnd']),
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

        User::create($attributes);
        if (Auth::guard('web')->check()) {
            if(Auth::user()->can('admin')) {
                return redirect('/admin-dashboard/users')->with('success', 'User has been created.');
            }
            return;
        }
        return;

    }

    public function update(User $user)
    {

        // $student = $student->id ? $student : Auth::guard('student')->user();
        // dd($student);

        $attributes = $this->validateUser($user);
        $fileManagement = new FileManagement();
        // dd($user->avatar_url);

        if ($attributes['avatar']) {
            $attributes['avatar'] =
            $fileManagement->uploadFile(
                file:$attributes['avatar'] ?? false,
                deleteOldFile:$user->avatar ?? false,
                oldFile:$user->avatar,
                path:'images/users/' . ($user['email'] !== $attributes['email'] ? $attributes['email'] : $user['email']) . '/avatar',
            );
        } 
        else if($user->avatar) {
            $fileManagement->deleteFile(
                fileUrl:$user->avatar
            );
        }
        // dd($attributes['avatar']);

        if ($user['email'] !== $attributes['email']) {
            $fileManagement->moveFiles(
                oldPath:'images/users/' . $user['email'] . '/avatar',
                newPath:'images/users/' . $attributes['email'] . '/avatar',
                deleteDirectory:'images/users/' . $user['email']
            );
            $attributes['avatar'] = str_replace($user['email'], $attributes['email'], $user['avatar']);
            // if($user->can('admin')){
            //     config('admin.email') = $attributes['email'];
            // }
        }

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
                'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user)],
                'password' => (request()->input('password') ?? false || !$user->exists) ? 'required|confirmed|min:6' : 'exclude',
                'tac' => 'required|accepted',
            ],
            [
                'dob' => 'Date of birth required',
                'phone_number' => 'Enter a valid Phone number with country code',
                'avatar' => 'Upload Profile image as jpg/png format with size less than 2MB',
                'tac' => 'Please agree to the Terms and Conditions!',
            ]
        );
    }
}
