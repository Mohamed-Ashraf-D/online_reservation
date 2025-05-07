<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::with('roles')->get();
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::where('name', '!=', 'super_admin')->get(); // منع إعطاء نفس الصلاحية
        return view('admin.admins.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $admin->assignRole($request->role);

        return redirect()->route('admin.admins.index')->with('success', 'Admin added successfully!');
    }
}
