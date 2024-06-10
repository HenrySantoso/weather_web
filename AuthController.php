<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginCheck(Request $request)
    {
        //membuat session
        if(Auth::attempt([
            'email' => $request -> email, 
            'password' => $request -> password]))
            {
                return redirect('/news');
            } else{
                return redirect('/');
            }
    }

    public function logoutCheck()
    {
        //menghapus session
        Auth::logout();
        return redirect('/');
    }
}
