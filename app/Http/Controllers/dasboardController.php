<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dasboardController extends Controller
{
    //
    public function showDasboard(){
        return view('admin.index');
    }

    public function login(){
        return view('admin.login');
    }

    public function authentication(Request $request){
        $validateData = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (Auth::attempt($validateData)) {
            if (Auth::user()->role === 'admin') {
                return redirect('/dashboard');
            } elseif (Auth::user()->role === 'staff') {
                return redirect('/dashboardStaff');
            } elseif (Auth::user()->role === 'student') {  // Role tambahan
                return redirect('/home');
            }
        }
        
    }

    public function showDb(){
        return view('admin.dashboard');
    }
}
