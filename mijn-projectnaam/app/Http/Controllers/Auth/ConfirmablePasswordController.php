<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ConfirmPasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Providers\RouteServiceProvider;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     * 
     * //gemaakt door mohammed abbas
     */
    public function show(): View
    {
        return view('auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     * 
     * //gemaakt door mohammed abbas
     */
    public function store(ConfirmPasswordRequest $request): RedirectResponse
    {
        if (! Hash::check($request->password, $request->user()->password)) {
            throw ValidationException::withMessages([
                'password' => ['Het opgegeven wachtwoord is onjuist.'],
            ]);
        }

        $request->session()->passwordConfirmed();

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
