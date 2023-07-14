<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Mahasiswa\SimpanSiswaRequest;
use App\Http\Requests\Mahasiswa\PerbaruiSiswaRequest;
use App\Models\Siswa;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SiswaController extends BaseController
{
    /**
     * Akses halaman indeks untuk melihat semua mahasiswa
     * @return Application|Factory|View
     */
    public function indeks(){
        $this->setPageTitle('Mahasiswa', 'Semua Mahasiswa');
        $mahasiswa = Mahasiswa::all();
        return view('Manage.pages.Mahasiswa.indeks', compact('mahasiswa'));
    }

    /**
     * @param Siswa $siswa
     * @return Application|Factory|View
     */
    public function tampilkan(Siswa $siswa){
        $this->setPageTitle($siswa->nama, 'Tampilkan siswa');
        $siswa->load('kehadiran');
        return view('Manage.pages.Siswa.tampilkan', compact('siswa'));
    }

     /**
     * @param Siswa $siswa
     * @return Application|Factory|View
     */
    public function kehadiran(Siswa $siswa){
        $this->setPageTitle($siswa->nama, 'Tampilkan siswa');
        return view('Manage.pages.Siswa.kehadiran', compact('siswa'));
    }

    /**
     * @param Siswa $siswa
     * @return Application|Factory|View
     */
    public function absensi(Siswa $mahasiswa){
        $this->setPageTitle($siswa->nama, 'Tampilkan siswa');
        return view('Manage.pages.Siswa.absensi', compact('siswa'));
    }

    /**
     * @param SimpanSiswaRequest $request
     * @return RedirectResponse
     */
    public function simpan(SimpanSiswaRequest $request): RedirectResponse
    {
        try {
            Siswa::create($request->validated());
        }
        catch (\Exception $exception){
            alert('Oops', 'Silakan coba lagi', 'error');
        }
        // Tampilkan Pemberitahuan Sweet Alert
        alert('Selamat!', 'Mahasiswa berhasil dibuat', 'success');
        // Alihkan Kembali
        return redirect()->back();
    }

    /**
     * @param PerbaruiSiswaRequest $request
     * @param Siswa $siswa
     * @return RedirectResponse
     */
    public function perbarui(PerbaruiSiswaRequest $request, Siswa $siswa): RedirectResponse
    {
        try {
            $siswa->update($request->validated());
        }
        catch (\Exception $exception){
            alert('Oops', 'Silakan coba lagi', 'error');
        }
        // Tampilkan Pemberitahuan Sweet Alert
        alert('Selamat!', 'Mahasiswa berhasil diperbarui', 'success');
        // Alihkan Kembali
        return redirect()->back();
    }

    /**
     * @param Siswa $siswa
     * @return RedirectResponse
     */
    public function hapus(Siswa $siswa): RedirectResponse
    {
        try {
            $siswa->delete();
        }
        catch (\Exception $exception){
            alert('Oops', 'Silakan coba lagi', 'error');
        }
        // Tampilkan Pemberitahuan Sweet Alert
        alert('Selamat!', 'Mahasiswa berhasil dihapus', 'success');
        // Alihkan Kembali
        return redirect()->back();
    }
}
