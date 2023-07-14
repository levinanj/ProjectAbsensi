<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini menangani proses otentikasi pengguna untuk aplikasi dan
    | mengarahkannya ke halaman utama. Controller ini menggunakan sebuah trait
    | untuk memberikan fungsionalitasnya dengan mudah pada aplikasi Anda.
    |
    */

    use AuthenticatesUsers;


//    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Arahkan pengguna ke lokasi yang tepat setelah login.
     *
     * @return string
     */
    protected function redirectTo(): string
    {
        if (Auth::user()->role == 'Admin') {
            return '/manage/dashboard';
        } else {
            return RouteServiceProvider::HOME;
        }
    }

    /**
     * Membuat instance dari controller baru.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
