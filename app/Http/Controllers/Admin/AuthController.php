<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function index() {
        return view('admin.login');
    }

    public function login(Request $request) 
    {
        $data = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if(auth('admin')->attempt($data)) {
            return redirect(route('admin.orders'));
        }

        return redirect(route('admin.login'))->withErrors(['error' => 'Якась фігня']);
    }
}
