<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MainController extends BaseController
{
    /**
     * Access the dashboard page
     * @return Application|Factory|View
     */
    public function index(){
        $this->setPageTitle('Dashboard', 'dashboard');
        $subjects = Subject::all();
        $students_count = Student::count();
        return view('Manage.pages.Singles.dashboard', compact('subjects', 'students_count'));
    }
}
