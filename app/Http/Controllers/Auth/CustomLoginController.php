<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomLoginController extends \Laravel\Fortify\Http\Controllers\AuthenticatedSessionController
{
    public function store(Request $request)
    {
        $request->validate([
            'cpf' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt(['cpf' => $request->cpf, 'password' => $request->password])) {
            return redirect()->back()->withErrors(['cpf' => 'CPF ou senha incorretos.']);
        }

        $request->session()->regenerate();

        return redirect()->intended(config('fortify.home'));
    }
}
