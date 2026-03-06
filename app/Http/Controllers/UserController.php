<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('department')->paginate(5);
        return view('users.index', compact('users'));
        
    }

    public function create()
    {
        $departments = \App\Models\Department::all();
        return view('users.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'cell_number' => 'required',
            'department_id' => 'required|exists:departments,id',
            'role' => 'required|in:admin,manager,staff',
        ]);

        User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'cell_number' => $request->cell_number,
            'password' => Hash::make('villa@2026'),
            'role' => $request->role,
            'department_id' => $request->department_id,
            'must_change_password' => 1
        ]);

        return redirect('/users')->with('success', 'User created successfully');
    }
    // edit form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'cell_number' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'cell_number' => $request->cell_number,
        ]);

        return redirect('/users')->with('success', 'User updated successfully');
    }

// delete user
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect('/users');
    }
}