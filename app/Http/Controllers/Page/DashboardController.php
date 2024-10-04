<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\Schedule;
use App\Models\ScheduleEntri;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah dosen
        $jumlahLecturer = Lecturer::count();

        // Menghitung jumlah jadwal
        $jumlahSchedule = Schedule::count();

        // Menghitung jumlah entri jadwal
        $jumlahScheduleEntri = ScheduleEntri::count();

        // Mengirim data ke view
        return view('pages.dashboard', compact('jumlahLecturer', 'jumlahSchedule', 'jumlahScheduleEntri'));
    }
}
