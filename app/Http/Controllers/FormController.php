<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{


    public function login(Request $request)
    {
        $data = $request->input();
        $request->session()->put('username', $data['username']);
        return redirect('/profile');
    }

    // public function resendOtp(Request $request)
    // {

    // }

}
