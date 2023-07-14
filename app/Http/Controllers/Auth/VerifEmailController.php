<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerifEmailController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini bertanggung jawab untuk menangani verifikasi email bagi
    | pengguna yang baru saja mendaftar dengan aplikasi. Email juga dapat
    | dikirim ulang jika pengguna tidak menerima pesan email asli.
    |
    */

    use VerifiesEmails;

    /**
     * Tempat untuk mengarahkan pengguna setelah verifikasi.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Membuat instance dari controller baru.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
