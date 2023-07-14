<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MapelController extends BaseController
{
    /**
     * Akses halaman indeks untuk melihat semua mata pelajaran
     * @return Application|Factory|View
     */
    public function indeks(){
        $this->setPageTitle('Mata Pelajaran', 'Semua Mata Pelajaran');
        $pengguna = Pengguna::all();
        $mataPelajaran = MataPelajaran::withCount('siswa')->with('guru')->get();
        return view('Manage.pages.MataPelajaran.indeks', compact('mataPelajaran', 'pengguna'));
    }

    /**
     * @param MataPelajaran $mataPelajaran
     * @return Application|Factory|View
     */
    public function tampilkan(MataPelajaran $mataPelajaran){
        $this->setPageTitle($mataPelajaran->nama, 'Tampilkan Mata Pelajaran');
        return view('Manage.pages.MataPelajaran.tampilkan', compact('mataPelajaran'));
    }

    /**
     * @param MataPelajaran $mataPelajaran
     * @return Application|Factory|View
     */
    public function tambahkanSiswa(MataPelajaran $mataPelajaran){
        $this->setPageTitle($mataPelajaran->nama, 'Tambahkan Siswa');
        $siswa = Siswa::whereNotIn('id', $mataPelajaran->siswa->pluck('id'))->get();
        return view('Manage.pages.MataPelajaran.tambahkan-siswa', compact('siswa', 'mataPelajaran'));
    }

    /**
     * Simpan siswa
     * @param MataPelajaran $mataPelajaran
     * @param Request $request
     * @return RedirectResponse
     */
    public function lampirkanSiswa(MataPelajaran $mataPelajaran, Request $request): RedirectResponse
    {
        $mataPelajaran->siswa()->attach($request->get('siswa'));
        alert('Selamat!', 'Siswa berhasil ditambahkan', 'success');
        // Alihkan Kembali
        return redirect()->route('mata_pelajaran.indeks');
    }

    /**
     * Lepas siswa dari mata pelajaran
     * @param MataPelajaran $mataPelajaran
     * @param Siswa $siswa
     * @return RedirectResponse
     */
    public function lepasSiswa(MataPelajaran $mataPelajaran, Siswa $siswa): RedirectResponse
    {
        $mataPelajaran->siswa()->detach($siswa);
        alert('Selamat!', $siswa->nama . ' berhasil dihapus', 'success');
        // Alihkan Kembali
        return redirect()->back();
    }

    /**
     * @param SimpanMataPelajaranRequest $request
     * @return RedirectResponse
     */
    public function simpan(SimpanMataPelajaranRequest $request): RedirectResponse
    {
        try {
            MataPelajaran::create($request->validated());
        }
        catch (\Exception $exception){
            alert('Oops', 'Silakan coba lagi', 'error');
        }
        // Tampilkan Pemberitahuan Sweet Alert
        alert('Selamat!', 'Mata Pelajaran berhasil dibuat', 'success');
        // Alihkan Kembali
        return redirect()->back();
    }

    /**
     * @param PerbaruiMataPelajaranRequest $request
     * @param MataPelajaran $mataPelajaran
     * @return RedirectResponse
     */
    public function perbarui(PerbaruiMataPelajaranRequest $)
}
