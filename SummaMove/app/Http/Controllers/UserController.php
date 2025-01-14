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
            // Validate inputs
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8|confirmed', // Wachtwoord alleen als het is ingevuld
            ]);
    
            // Update user data
            $user->name = $request->name;
            $user->email = $request->email;
    
            // Check if password is filled and update if so
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
    
            $user->save();
    
            // Update roles
            $user->roles()->sync($request->role_id);
    
            return redirect()->route('users.index')->with('success', 'Gebruiker succesvol bijgewerkt.');
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

public function create()
{
    $auth = auth()->user();

    if ($auth->hasRole('admin')) {
        return view('users.create');
    } else {
        return view('dashboard');
    }
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

        return redirect()->route('users.index')->with('success', 'Gebruiker succesvol aangemaakt en automatisch als student toegewezen.');
    } else {
        return view('dashboard');
    }
}
}

