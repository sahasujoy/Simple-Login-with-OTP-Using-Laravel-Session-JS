<?php

use App\Http\Controllers\FormController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/timecount', function() {
    $check = Carbon::now()->addSeconds(10);
    if($check)
    {
        return "able";
    }
    return "disable";
});

Route::get('/', function () {
    if(session()->has('username'))
    {
        return redirect('/profile');
    }
    return view('form');
});

Route::post('/session-login', [FormController::class, 'login'])->name('form.login');

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/logout', function () {
    if(session()->has('username'))
    {
        session()->pull('username');
    }
    return redirect('/');
});

//----------------------------------------- SESSION TIMEOUT ----------------------------------------
Route::get('/login', function(Request $request) {
    if($request->session()->exists('email') && session('reqotp')!=session('otp'))
    {
        return redirect('/home');
    }
    else if($request->session()->exists('email') && session('reqotp')==session('otp'))
    {
        return view('loginsuccess');
    }
    return view('login');
});

Route::post('/login', function(Request $request) {
    $request->session()->put('email', $request->email);
    $request->session()->put('otp', rand(100000,999999));
    $request->session()->put('otp_expires_time', Carbon::now()->addSeconds(10));
    return redirect('/home');
});

Route::get('/home', function(Request $request) {

    if($request->session()->exists('email'))
    {
        return view('home');
    }
    return redirect('/login');
});

Route::post('/home', function(Request $request){
    if(session('otp_expires_time') > Carbon::now())
    {
        $request->session()->put('reqotp', $request->otp);
        if(session('reqotp')==session('otp'))
        {
            return view('loginsuccess');
        }
        elseif(session('reqotp')!=session('otp'))
        {
            return view('otpmismatch');
        }
        // return view('home');
    }

    else if(session('otp_expires_time') < Carbon::now())
    {
        session()->pull('otp');
        session()->pull('otp_expires_time');
        return view('timeout');
    }
    // session()->pull('email');
    // session()->pull('otp');
    // session()->pull('otp_expires_time');
    // return view('homero');
});

Route::get('/homero', function(Request $request){
    if($request->session()->exists('email'))
    {
        return view('homero');
    }
    return redirect('/login');
});

Route::post('/homero', function(Request $request){
    if(session('otp_expires_time') > Carbon::now())
    {
        $request->session()->put('reqotp', $request->otp);
        if(session('reqotp')==session('otp'))
        {
            return view('loginsuccess');
        }
        elseif(session('reqotp')!=session('otp'))
        {
            session()->pull('email');
            session()->pull('otp');
            session()->pull('otp_expires_time');
            return view('otpmismatchro');
        }
        // return view('home');
    }

    else if(session('otp_expires_time') < Carbon::now())
    {
        session()->pull('email');
        session()->pull('otp');
        session()->pull('otp_expires_time');
        return view('timeoutro');
    }

    // return redirect('/login');
});



Route::get('/resend-otp', function(Request $request) {
    $request->session()->put('otp', rand(100000,999999));
    $request->session()->put('otp_expires_time', Carbon::now()->addSeconds(10));
    return redirect('/homero');
});

Route::get('/login-again', function(){
    return view('login');
});

Route::get('/user-logout', function () {
    if(session()->has('email') && session()->has('otp'))
    {
        session()->pull('email');
        session()->pull('otp');
    }
    return redirect('/login');
});


