<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Schedule;
use App\Models\ScheduleEntri;
use App\Models\Lecturer;

class PublicSchedules extends Component
{
    public $schedules = []; // Properti untuk menyimpan daftar jadwal
    public $lecturers = []; // Properti untuk menyimpan daftar dosen
    public $scheduleEntries = [];
    public $search = ''; // Properti untuk menyimpan query pencarian

    public function mount()
    {
        $this->schedules = Schedule::with('scheduleEntries.lecturers')->get();
        $this->lecturers = Lecturer::all(); 
    }


    public function updatedSearch()
    {
        // Mengambil jadwal yang memiliki entri sesuai dengan pencarian
        $this->schedules = Schedule::with(['scheduleEntries.lecturers'])
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('scheduleEntries', function ($query) {
                        $query->where('course', 'like', '%' . $this->search . '%')
                            ->orWhere('session', 'like', '%' . $this->search . '%')
                            ->orWhere('grub', 'like', '%' . $this->search . '%')
                            ->orWhere('room', 'like', '%' . $this->search . '%')
                            ->orWhere('credits', 'like', '%' . $this->search . '%')
                            ->orWhereHas('lecturers', function ($query) {
                                $query->where('name', 'like', '%' . $this->search . '%');
                            });
                    });
            })->get();
    
        // Menghapus jadwal yang tidak memiliki entri yang relevan
        foreach ($this->schedules as $schedule) {
            $schedule->scheduleEntries = $schedule->scheduleEntries->filter(function ($entry) {
                return stripos($entry->course, $this->search) !== false ||
                       stripos($entry->session, $this->search) !== false ||
                       stripos($entry->grub, $this->search) !== false ||
                       stripos($entry->room, $this->search) !== false ||
                       stripos($entry->credits, $this->search) !== false ||
                       stripos($entry->lecturers->name, $this->search) !== false;
            });
        }
    
        // Menghapus jadwal yang tidak memiliki entri yang relevan
        $this->schedules = $this->schedules->filter(function ($schedule) {
            return $schedule->scheduleEntries->isNotEmpty();
        });
    }
    
    
    
    

    public function render()
    {
        return view('livewire.public-schedules');
    }
}
