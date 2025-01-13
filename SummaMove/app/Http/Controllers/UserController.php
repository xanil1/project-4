<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\User_Role;

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

            return view('users.index', ['users' => $users]);
        } else {
            return view('dashboard');
        }
    }

    public function edit(User $user)
    {
        $auth = auth()->user();

        if ($auth->hasRole('admin')) {
            $roles = Role::all();
            return view('users.edit', ['user' => $user, 'roles' => $roles]);
        } else {
            return view('dashboard');
        }
    }

    public function update(Request $request, User $user)
    {
        $auth = auth()->user();

        if ($auth->hasRole('admin')) {
            $user->roles()->sync($request->role_id);
            return redirect()->route('users.index')->with('success', 'Rol van gebruiker succesvol bijgewerkt.');
        } else {
            return view('dashboard');
        }
    }

    public function destroy(string $id)
    {
        $auth = auth()->user();

        if ($auth->hasRole('admin')) {
            User_Role::where('user_id', $id)->delete();
            User::destroy($id);
            return redirect()->route('users.index')->with('success', 'Gebruiker succesvol verwijderd.');
        } else {
            return view('dashboard');
        }
    }


public function add()
{
    $auth = auth()->user();

    if ($auth->hasRole('admin')) {
        $studentRoleId = Role::where('name', 'student')->first()->id;
        $users = User::whereHas('roles', function ($query) use ($studentRoleId) {
            $query->where('role_id', $studentRoleId);
        })->get();

        return view('users.add', ['users' => $users]);
    } else {
        return view('dashboard');
    }
}

public function promote(Request $request, User $user)
{
    $auth = auth()->user();

    if ($auth->hasRole('admin')) {
        $studentRoleId = Role::where('name', 'student')->first()->id;
        $adminRoleId = Role::where('name', 'admin')->first()->id;

        $user->roles()->detach($studentRoleId);
        $user->roles()->attach($adminRoleId);

        return redirect()->route('users.add')->with('success', 'Gebruiker succesvol gepromoveerd tot admin.');
    } else {
        return view('dashboard');
    }
}
}
