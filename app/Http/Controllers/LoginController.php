<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;

class LoginController extends Controller
{
    public function login(Request $request) {

        if(Auth::check()) {
            return redirect(route('user.selectpixel'));
        }

        $formFields = $request->only(['email', 'password']);

        if(Auth::attempt($formFields)) {
            return redirect()->intended(route('user.selectpixel'));
        }

        return redirect(route('user.login'))->withErrors([
            'error' => 'Не удалось авторизироваться'
        ]);

    }
}