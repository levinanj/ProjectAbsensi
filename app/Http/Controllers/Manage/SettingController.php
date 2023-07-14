<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\BaseController;
use App\Models\Pengaturan;
use App\Traits\UploadFilesTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class SettingController extends BaseController
{
    use UploadFilesTrait;

    /**
     * @return Application|Factory|View
     */
    public function indeks()
    {
        $this->setPageTitle('Pengaturan', 'Kelola Pengaturan');
        return view('Manage.pages.Pengaturan.indeks');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function perbarui(Request $request): RedirectResponse
    {
        if ($request->has('logo_situs') && ($request->file('logo_situs') instanceof UploadedFile)) {

            if (config('pengaturan.logo_situs') != null) {
                $this->hapusSatu((config('pengaturan.logo_situs')));
            }

            Pengaturan::set('logo_situs', $this->unggahSatu($request, 'logo_situs', 'uploads/pengaturan/'));
        } elseif ($request->has('favicon_situs') && ($request->file('favicon_situs') instanceof UploadedFile)) {

            if (config('pengaturan.favicon_situs') != null) {
                $this->hapusSatu((config('pengaturan.favicon_situs')));
            }

            Pengaturan::set('favicon_situs', $this->unggahSatu($request, 'favicon_situs', 'uploads/pengaturan/'));
        } else {

            $kunci = $request->except('_token');
            foreach ($kunci as $kunci => $nilai) {
                Pengaturan::set($kunci, $nilai);
            }
        }
        return $this->responAlihkanKembali('Pengaturan','Pengaturan berhasil diperbarui.', 'success');
    }
}
