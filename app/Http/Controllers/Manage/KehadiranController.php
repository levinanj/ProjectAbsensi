<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Attendance\StoreAttendanceRequest;
use App\Models\Presensi;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KehadiranController extends BaseController
{
    /**
     * @return Application|Factory|View
     */
    public function indeks(){
        $this->setPageTitle("Presensi Kehadiran" , 'Semua Presensi Kehadiran');
        $presensi = Presensi::with(['mataPelajaran', 'guru'])->whereMataPelajaran(request()->get('filter_mata_pelajaran'))->whereDate(request()->get('filter_tanggal'))->withCount('siswa')->get();
        $mataPelajaran = MataPelajaran::all();
        return view('Manage.pages.Presensi.indeks', compact('presensi', 'mataPelajaran'));
    }

    /**
     * @param SimpanPresensiRequest $request
     * @return Application|Factory|View
     */
    public function simpan(SimpanPresensiRequest $request){
        $presensi = Presensi::create($request->validated() + [
            'id_pengguna' => Auth::id(),
            ]);
        $mataPelajaran = MataPelajaran::findOrFail($request->get('id_mata_pelajaran'));
        $mataPelajaran->load('siswa');
        $this->setPageTitle($presensi->id , 'Presensi');
        alert('Selamat!', 'Anda dapat memulai presensi sekarang!', 'success');
        return view('Manage.pages.Presensi.lakukan-presensi', compact('presensi', 'mataPelajaran'));
    }

    /**
     * @param Presensi $presensi
     * @return Application|Factory|View
     */
    public function ubah(Presensi $presensi){
        $this->setPageTitle($presensi->id , 'Presensi');
        $presensi->load('siswa', 'mataPelajaran');
        return view('Manage.pages.Presensi.ubah', compact('presensi'));
    }

    /**
     * @param Presensi $presensi
     * @param Request $request
     * @return RedirectResponse
     */
    public function lampirkanSiswa(Presensi $presensi, Request $request): RedirectResponse
    {
        if ($request->get('status') == null) {
            $presensi->delete();
            alert('Oops', "Anda tidak melakukan presensi apapun. Silakan coba lagi dan isi semua entri dengan benar", 'error');
        }
        else{
            foreach ($request->get('status') as $id_siswa => $status) {
                $siswa = Siswa::findOrFail($id_siswa);
                if ($status == "hadir") {
                    $value = 1;
                } elseif($status == "tidak_hadir") {
                    $value = 0;
                }
                else{
                    $value = null;
                }
                $presensi->siswa()->attach($siswa->id, ['status' => $value]);
            }
            alert('Selamat!', 'Presensi berhasil diambil', 'success');
        }
        return  back();
    }

    /**
     * @param Presensi $presensi
     * @param Request $request
     * @return RedirectResponse
     */
    public function perbaruiDataPresensi(Presensi $presensi, Request $request): RedirectResponse
    {
        $presensi->siswa()->detach();
        $this->lampirkanSiswa($presensi, $request);
        alert('Selamat!', 'Data Presensi berhasil diperbarui', 'success');
        return  back();
    }

    /**
     * @param Presensi $presensi
     * @return RedirectResponse
     */
    public function hapus(Presensi $presensi): RedirectResponse
    {
        try {
            $presensi->delete();
        }
        catch (\Exception $exception){
            alert('Oops', 'Silakan coba lagi', 'error');
        }
        alert('Selamat!', 'Presensi berhasil dihapus', 'success');
        return  back();
    }
}
