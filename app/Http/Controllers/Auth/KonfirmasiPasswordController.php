<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\KonfirmasiPasswords;

class KonfirmasiPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Konfirmasi Password Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini bertanggung jawab untuk menangani konfirmasi password dan
    | menggunakan sebuah trait sederhana untuk menyertakan perilaku tersebut. Anda bebas untuk menjelajahi
    | trait ini dan mengganti fungsi-fungsi yang membutuhkan kustomisasi.
    |
    */

    use KonfirmasiPasswords;

    /**
     * Tempat untuk mengarahkan pengguna ketika URL yang dituju gagal.
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
    }
}
