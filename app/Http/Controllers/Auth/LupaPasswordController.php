<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class LupaPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Controller Reset Password
    |--------------------------------------------------------------------------
    |
    | Controller ini bertanggung jawab untuk mengirim email reset password dan
    | menggunakan sebuah trait yang membantu dalam mengirimkan notifikasi ini
    | dari aplikasi Anda ke pengguna. Silakan menjelajahi trait ini.
    |
    */

    use SendsPasswordResetEmails;
}
