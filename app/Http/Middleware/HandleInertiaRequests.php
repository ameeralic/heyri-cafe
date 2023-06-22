<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request):  ? string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request) : array
    {
        return array_merge(parent::share($request), [
            'csrf_token' => csrf_token(),
            'app_url' => asset('/'),
            'flash' => [
                'success' => fn() => $request->session()->get('success'),
                'error' => fn() => $request->session()->get('error'),
            ],
            'siteLogo' => config('app.logo'),
            'siteName' => config('app.name'),
            'is_user_logged' => Auth::guard('web')->check() ?? false,
            'is_admin_logged' => Auth::guard('web')->check() ? Auth::guard('web')->user()->can('admin') : false,
            'logged_user' => [
                'id' => Auth::guard('web')->check() ? Auth::guard('web')->user()->id : false,
                'email' => Auth::guard('web')->check() ? Auth::guard('web')->user()->email : false,
                'full_name' => Auth::guard('web')->check() ? Auth::guard('web')->user()->full_name : false,
                'avatar' => Auth::guard('web')->check() ? Auth::guard('web')->user()->avatar_url : false,
            ],
        ]);
    }
}
