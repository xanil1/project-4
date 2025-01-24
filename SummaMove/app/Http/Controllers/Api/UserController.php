<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $auth = auth()->user();

        if ($auth->hasRole('admin')) {
            $studentRoleId = Role::where('name', 'student')->first()->id;
            $users = User::whereDoesntHave('roles', function ($query) use ($studentRoleId) {
                $query->where('role_id', $studentRoleId);
            })->get();

            return response()->json($users, 200);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function store(Request $request)
    {
        $auth = auth()->user();

        if ($auth->hasRole('admin')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $studentRole = Role::where('name', 'student')->first();
            if ($studentRole) {
                $user->roles()->attach($studentRole->id);
            }

            return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    public function update(Request $request, User $user)
    {
        $auth = auth()->user();

        if ($auth->hasRole('admin')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8|confirmed',
            ]);

            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            if ($request->has('role_id')) {
                $user->roles()->sync($request->role_id);
            }

            return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function destroy(User $user)
    {
        $auth = auth()->user();

        if ($auth->hasRole('admin')) {
            $user->roles()->detach();
            $user->delete();

            return response()->json(['message' => 'User deleted successfully'], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}