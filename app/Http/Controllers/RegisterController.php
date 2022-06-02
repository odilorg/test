<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
     public function save(Request $request) {
        if(Auth::check()) {
             return redirect(route('user.selectpixel'));
        }

         $validateFileds = $request->validate([
             'name' => 'required',
             'email' => 'required|email',
             'phone' => 'required',
             'password' => 'required'
         ]);

         if(User::where('email', $validateFileds['email'])->exists()) {
            return redirect(route('user.registration'))->withErrors([
                'email' => 'Ошибка регистрации'
            ]);
         }

         $user = User::create($validateFileds);
         if($user) {
            event(new Registered($user));
            Auth::login($user);
            //return redirect(route('user.fselectpixel'));
            return redirect(route('verification.notice'));
         }

        return redirect(route('user.login'))->withErrors([
            'formError' => 'Ошибка авторизации'
        ]);
     }


     public function resetPassword(Request $request) {

        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if($status == 'passwords.sent') {
            return view('forgot-password', ['status' => '1']);
        }

        return redirect(route('password.request'))->withErrors(['errors' => 'privet']);

     }


     public function newPassword(Request $request) {

        
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('user.login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
        
     }
}
