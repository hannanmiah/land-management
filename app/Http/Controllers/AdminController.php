<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function once()
    {
        return view('admin.create_once', ['users' => User::with(['role' => fn($query) => $query->where('slug', 'admin')])->get()]);
    }

    public function create_once(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $allUsers = User::with(['role' => fn($query) => $query->where('slug', 'admin')])->get();

        if ($allUsers->isEmpty()) {
            $role = Role::create([
                'name' => 'Admin',
                'slug' => 'admin'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $role->id
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect(route('admin.dashboard'));
        }

        return redirect(route('login'));
    }
}
