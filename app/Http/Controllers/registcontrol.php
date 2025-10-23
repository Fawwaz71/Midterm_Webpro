<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Hash;

class registcontrol extends Controller
{
    public function showForm(): View
    {
        return view('register');
    }

    public function processForm(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:100|email|unique:users',
            'password' => 'required|string|min:2|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login') ->with('status','regist succses, now login');
    }
}