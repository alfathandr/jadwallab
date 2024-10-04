<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\ScheduleEntri;
use App\Models\Lecturer;

class FormSchedules extends Component
{
    public $showForm = false;
    public $showScheduleForm = false;

    public $selectedScheduleId = '';
    public $selectedLecturerId = '';
    public $selectedDay = '';
    public $session = '';
    public $grub = '';
    public $course = '';
    public $room = '';
    public $credits = '';
    public $startTime = '';
    public $endTime = '';
    public $scheduleName = '';

    public $schedules = []; // Properti untuk menyimpan daftar jadwal
    public $lecturers = []; // Properti untuk menyimpan daftar dosen
    public $scheduleEntries = [];

    public function mount()
    {
        // Ambil semua data schedule dan lecturer saat komponen di-mount
        $this->schedules = Schedule::all();
        $this->lecturers = Lecturer::all();
    }

    public function updatedSelectedScheduleId($scheduleId)
    {
        // Ambil entri jadwal berdasarkan schedule yang dipilih
        $this->scheduleEntries = ScheduleEntri::where('schedule_id', $scheduleId)->with('lecturers')->get();
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
        $this->showScheduleForm = false; // Tutup form schedule jika form ini terbuka
    }

    public function toggleScheduleForm()
    {
        $this->showScheduleForm = !$this->showScheduleForm;
        $this->showForm = false; // Tutup form utama jika form schedule terbuka
    }

    private function resetForm()
    {
        $this->selectedScheduleId = '';
        $this->selectedLecturerId = '';
        $this->selectedDay = '';
        $this->session = '';
        $this->course = '';
        $this->startTime = '';
        $this->endTime = '';
        $this->credits = '';
        $this->room = '';
        $this->grub = '';
    }

    public function cancel()
    {
        $this->showForm = false;
        $this->showScheduleForm = false; // Tutup semua form
        $this->resetForm(); // Reset input
    }

    public function hapus($id)
    {
        try {
            // Temukan entri berdasarkan ID dan hapus
            $entry = ScheduleEntri::findOrFail($id);
            // Dapatkan schedule terkait
            $schedule = $entry->schedule; // Memanggil relasi dengan Schedule

            // Hapus entri jadwal
            $entry->delete();

            // Cek apakah schedule tidak memiliki entri lain
            if ($schedule->scheduleEntries->isEmpty()) {
                // Hapus schedule jika tidak ada entri tersisa
                $schedule->delete();
                session()->flash('message', 'success');
                session()->flash('message_text', 'Jadwal dan entri jadwal berhasil dihapus!');
            } else {
                // Jika masih ada entri, hanya kirim pesan sukses untuk entri
                session()->flash('message', 'success');
                session()->flash('message_text', 'Entri jadwal berhasil dihapus!');
            }

            // Segarkan daftar scheduleEntries jika diperlukan
            $this->scheduleEntries = ScheduleEntri::all(); // Atau cara lain sesuai kebutuhan
        } catch (\Exception $e) {
            // Jika terjadi error, kirim pesan error
            session()->flash('message', 'error');
            session()->flash('message_text', 'Terjadi kesalahan saat menghapus entri jadwal!');
        }
    }

    public function saveSchedule()
    {
        // Validasi input
        $this->validate([
            'scheduleName' => 'required|string|max:255',
        ]);

        try {
            // Simpan data jadwal
            Schedule::create([
                'name' => $this->scheduleName,
            ]);

            // Jika berhasil, refresh daftar schedule
            $this->schedules = Schedule::all();

            // Jika berhasil, kirim pesan sukses
            session()->flash('message', 'success');
            session()->flash('message_text', 'Jadwal berhasil disimpan!');

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            // Jika terjadi error, kirim pesan error
            session()->flash('message', 'error');
            session()->flash('message_text', 'Terjadi kesalahan saat menyimpan jadwal!');
        }
    }

    public function saveScheduleEntry()
    {
        // Validate input
        $this->validate([
            'selectedScheduleId' => 'required|exists:schedules,id', // Ensure the schedule exists
            'selectedLecturerId' => 'required|exists:lecturers,id', // Ensure the lecturer exists
            'selectedDay' => 'required|string',
            'session' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'room' => 'required|string|max:255',
            'credits' => 'required|integer|min:1', // Add minimum value for credits
            'grub' => 'required|string|min:1', // Add minimum value for grub
            'startTime' => 'required|date_format:H:i',
            'endTime' => 'required|date_format:H:i|after:startTime', // Ensure end time is after start time
        ]);
    
        try {
            // Save schedule entry
            ScheduleEntri::create([
                'schedule_id' => $this->selectedScheduleId,
                'lecturer_id' => $this->selectedLecturerId,
                'day' => $this->selectedDay,
                'session' => $this->session,
                'course' => $this->course,
                'room' => $this->room,
                'grub' => $this->grub,
                'credits' => $this->credits,
                'start_time' => $this->startTime,
                'end_time' => $this->endTime,
            ]);
    
            session()->flash('message', 'success');
            session()->flash('message_text', 'Entri Jadwal berhasil disimpan!');
            
            // Optional: Reset form fields
            $this->reset(['selectedScheduleId', 'selectedLecturerId', 'selectedDay', 'session', 'course', 'room', 'grub', 'credits', 'startTime', 'endTime']);
    
            return redirect()->route('dashboard');
    
        } catch (\Exception $e) {
            // If an error occurs, send error message
            session()->flash('message', 'error');
            session()->flash('message_text', 'Terjadi kesalahan saat menyimpan entri jadwal! ' . $e->getMessage());
        }
    }
    

    public function render()
    {
        return view('livewire.form-schedules');
    }
}
