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

        if ($auth->hasRole('manager')) {
            $klantRoleId = Role::where('name', 'klant')->first()->id;
            $users = User::whereDoesntHave('roles', function ($query) use ($klantRoleId) {
                $query->where('role_id', $klantRoleId);
            })->get();

            return view('users.index', ['users' => $users]);
        } else {
            return view('homepage');
        }
    }

    public function edit(User $user)
    {
        $auth = auth()->user();

        if ($auth->hasRole('manager')) {
            $roles = Role::all();
            return view('users.edit', ['user' => $user, 'roles' => $roles]);
        } else {
            return view('homepage');
        }
    }

    public function update(Request $request, User $user)
    {
        $auth = auth()->user();

        if ($auth->hasRole('manager')) {
            $user->roles()->sync($request->role_id);
            return redirect()->route('users.index')->with('success', 'Rol van gebruiker succesvol bijgewerkt.');
        } else {
            return view('homepage');
        }
    }

    public function destroy(string $id)
    {
        $auth = auth()->user();

        if ($auth->hasRole('manager')) {
            User_Role::where('user_id', $id)->delete();
            User::destroy($id);
            return redirect()->route('users.index')->with('success', 'Gebruiker succesvol verwijderd.');
        } else {
            return view('homepage');
        }
    }

    public function add()
{
    $auth = auth()->user();

    if ($auth->hasRole('manager')) {
        // Fetch users with 'klant' role
        $klantRoleId = Role::where('name', 'klant')->first()->id;
        $users = User::whereHas('roles', function ($query) use ($klantRoleId) {
            $query->where('role_id', $klantRoleId);
        })->get();

        return view('users.add', ['users' => $users]);
    } else {
        return view('homepage');
    }
}

public function promote(Request $request, User $user)
{
    $auth = auth()->user();

    if ($auth->hasRole('manager')) {
        $klantRoleId = Role::where('name', 'klant')->first()->id;
        $medewerkerRoleId = Role::where('name', 'medewerker')->first()->id;

        $user->roles()->detach($klantRoleId);
        $user->roles()->attach($medewerkerRoleId);

        return redirect()->route('users.add')->with('success', 'Gebruiker succesvol gepromoveerd tot medewerker.');
    } else {
        return view('homepage');
    }
}
}