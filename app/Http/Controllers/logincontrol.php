<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginControl extends Controller
{
    public function showLoginForm(): View
    {
        return view('login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            return redirect()->intended('/')
                ->with('status', 'Login success');
        }

        return back()->withInput()->with('status', 'Invalid');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect('/')->with('status', 'logout success');
    }

    public function destroy(Request $request)
    {
        $user = $request->user();
        Auth::logout();
        $user->delete();

        return redirect('/')->with('status', 'account deleted.');
    }
}
