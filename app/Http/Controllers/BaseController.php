<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BaseController extends Controller
{
    /**
     * Set judul Halaman dan subjudul sesuai dengan halaman yang diminta
     * Jadikan mereka dinamis untuk SEO
     * @param $judul
     * @param $subJudul
     */
    protected function setJudulHalaman($judul, $subJudul)
    {
        view()->share(['judulHalaman' => $judul, 'subJudul' => $subJudul]);
    }

    /**
     * @param $rute
     * @param $judul
     * @param $pesan
     * @param string $jenis
     * @param bool $error
     * @param bool $denganInputLamaJikaError
     * @return RedirectResponse
     */
    protected function responsRedirect($rute, $judul, $pesan, string $jenis = 'info', bool $error = false, bool $denganInputLamaJikaError = false): RedirectResponse
    {
        // Tampilkan Pemberitahuan Sweet Alert
        alert($judul, $pesan, $jenis);

        // Jika terjadi error, kembali ke halaman yang sama dan tampilkan error
        if ($error && $denganInputLamaJikaError) {
            return redirect()->back()->withInput();
        }
        // Jika tidak, alihkan ke rute lain
        return redirect()->route($rute);
    }

    /**
     * @param $judul
     * @param $pesan
     * @param string $jenis
     * @param bool $error
     * @param bool $denganInputLamaJikaError
     * @return RedirectResponse
     */
    protected function responsRedirectKembali($judul, $pesan, string $jenis = 'info', bool $error = false, bool $denganInputLamaJikaError = false): RedirectResponse
    {
        // Tampilkan Pemberitahuan Sweet Alert
        alert($judul, $pesan, $jenis);

        // Alihkan Kembali
        return redirect()->back();
    }
}
