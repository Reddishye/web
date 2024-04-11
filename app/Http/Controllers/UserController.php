<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create($validatedData);

        $permissions = json_decode($request->input('permissions', '[]'), true);
        $user->permissions = $permissions;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        $user->update($validatedData);

        $permissions = json_decode($request->input('permissions', '[]'), true);
        $user->permissions = $permissions;

        if ($request->has('unlink_discord')) {
            $user->discord_id = null;
            $user->discord_username = null;
            $user->discord_displayname = null;
            $user->discord_avatar_url = null;
        }

        $user->save();

        return redirect()->route('users.edit', $user->id)->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    /**
     * Unlink the user's discord from its account.
     */
    public function unlinkDiscord(User $user)
    {
        $user->discord_id = null;
        $user->discord_username = null;
        $user->discord_avatar_url = null;
        $user->save();

        return redirect()->route('users.edit', $user->id)->with('success', 'Discord account unlinked successfully');
    }
}
