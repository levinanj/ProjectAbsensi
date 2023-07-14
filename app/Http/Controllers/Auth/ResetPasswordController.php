<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Reset Password Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini bertanggung jawab untuk menangani permintaan reset password
    | dan menggunakan sebuah trait sederhana untuk menyertakan perilaku ini.
    | Anda bebas untuk menjelajahi trait ini dan mengganti metode apa pun yang ingin Anda ubah.
    |
    */

    use ResetsPasswords;

    /**
     * Tempat untuk mengarahkan pengguna setelah mengatur ulang password mereka.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
