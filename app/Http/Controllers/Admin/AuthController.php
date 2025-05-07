<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();

            if ($admin->hasAnyRole(['user_consultation', 'user_repairs', 'user_coaching'])) {
                return redirect()->intended(route('admins.admins-dashboard'));
            }

            if ($admin->hasRole('admin')) {
                return redirect()->intended(route('admin.dashboard'));
            }

            Auth::guard('admin')->logout();
            return back()->withErrors(['email' => 'You are not authorized to access the admin dashboard.']);
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        $admin = Auth::guard('admin')->user();
        if ($admin->hasAnyRole(['user_consultation', 'user_repairs', 'user_coaching'])) {
            return redirect()->intended(route('admin.login'));
        }

        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
