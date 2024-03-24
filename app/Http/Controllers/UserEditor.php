<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserEditor extends Controller
{
    public function show(string $id): \Illuminate\Contracts\View\View
    {
        return view('users.edit', [
            'user' => User::findOrFail($id)
        ]);
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Añadir validaciones para otros campos según sea necesario
        ]);
    
        $user->update($validatedData);
    
        return redirect()->route('users')->with('success', 'User updated successfully');
    }

}
