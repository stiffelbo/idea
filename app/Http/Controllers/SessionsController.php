<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class SessionsController
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // walidacja danych z formularza
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', Password::default()],
        ]);

        // próba logowania
        if (! Auth::attempt($credentials)) {
            return back()
                ->withErrors(['password' => 'Wrong password'])
                ->withInput($request->only('email'));
        }

        // ochrona przed session fixation
        $request->session()->regenerate();

        return redirect()->intended('/')->with('success', 'You are now logged in!');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        // pełne wyczyszczenie sesji
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
