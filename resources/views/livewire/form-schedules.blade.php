<div class="col-lg-12 mb-lg-0 mb-4">
  <div class="card ">
    <div class="card-header pb-0 p-3">
      <div class="d-flex justify-content-between align-items-center">
      <!-- Teks Schedule tetap di kiri -->
      <h6 class="mb-2">Schedule</h6>
      
      <!-- Tombol di sebelah kanan -->
      <div class="ml-auto">
        @if (!$showForm && !$showScheduleForm)
          <!-- Jika tabel yang ditampilkan -->
          <button wire:click="toggleForm" type="button" class="btn btn-primary btn-sm">Tambah Schedule</button>
          <button wire:click="toggleScheduleForm" type="button" class="btn btn-primary btn-sm">Tambah Data Schedule</button>
        @else
          <!-- Jika salah satu form ditampilkan -->
          <button wire:click="cancel" type="button" class="btn btn-danger btn-sm">Batal</button>
        @endif
      </div>
    </div>
    


      @if (!$showForm && !$showScheduleForm)
        <div class="table-responsive">
        @if (session('message'))
            <div class="text-white px-2 py-2 border-0 rounded relative mb-4 {{ session('message') === 'success' ? 'bg-primary' : 'bg-warning' }}">
                <span class="text-xl inline-block mr-5 align-middle">
                    <i class="fas fa-bell"></i>
                </span>
                <span class="inline-block align-middle mr-8">
                    <b class="capitalize">{{ session('message') === 'success' ? 'Success!' : 'Error!' }}</b> {{ session('message_text') }}
                </span>
            </div>
        @endif

        @foreach ($schedules as $schedule)
    <table class="table align-items-center mb-4">
        <thead>
            <tr>
                <th colspan="9" class="text-center bg-light font-weight-bold rounded">{{ $schedule->name }}</th>
            </tr>
            <tr>
                <th class="text-center bg-light font-weight-bold rounded">Hari</th>
                <th class="text-center bg-light font-weight-bold">Jam Ke-</th>
                <th class="text-center bg-light font-weight-bold">Jam</th>
                <th class="text-center bg-light font-weight-bold">Kelas</th>
                <th class="text-center bg-light font-weight-bold">Mata Kuliah</th>
                <th class="text-center bg-light font-weight-bold">Dosen</th>
                <th class="text-center bg-light font-weight-bold">Ruang</th>
                <th class="text-center bg-light font-weight-bold">SKS</th>
                <th class="text-center bg-light font-weight-bold rounded">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedule->scheduleEntries as $entry) <!-- Mengakses entri jadwal dari relasi -->
                <tr>
                    <td class="text-center">{{ $entry->day }}</td>
                    <td class="text-center">{{ $entry->session }}</td>
                    <td class="text-center">{{ $entry->start_time }} - {{ $entry->end_time }}</td>
                    <td class="text-center">{{ $entry->grub }}</td>
                    <td class="text-center">{{ $entry->course }}</td>
                    <td class="text-center">{{ $entry->lecturers->name }}</td>
                    <td class="text-center">{{ $entry->room }}</td>
                    <td class="text-center">{{ $entry->credits }}</td>
                    <td class="text-center">
                        <button wire:click="hapus({{ $entry->id }})" type="button" class="btn btn-danger btn-sm">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach

        </div>
      @endif  


    @if ($showForm)
    <form wire:submit.prevent="saveSchedule"> 
    <div class="card">
        <div class="row px-4 ml-2">
            <div class="col-md-12 px-0">
                <div class="form-group">
                    <label for="schedule">Nama Jadwal</label>
                    <input type="text" wire:model="scheduleName" class="form-control bg-gray-200" id="schedule">
                    @error('scheduleName') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-md-12 px-0">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" wire:click="cancel">Batal</button>
            </div>
        </div>
    </div>
</form>


    @endif  

    @if ($showScheduleForm)
<form wire:submit.prevent="saveScheduleEntry"> 
    <div class="card">
        <div class="row px-4 ml-2">

            <!-- Schedule Selection -->
            <div class="col-md-6 px-0 px-2">
                <div class="form-group">
                    <label for="schedule_id">Pilih Jadwal</label>
                    <select wire:model="selectedScheduleId" class="form-control bg-gray-200" id="schedule_id">
                        <option value="">-- Pilih Jadwal --</option>
                        @foreach($schedules as $schedule)
                            <option value="{{ $schedule->id }}">{{ $schedule->name }}</option>
                        @endforeach
                    </select>
                    @error('selectedScheduleId') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Day Selection -->
            <div class="col-md-6 px-0 px-2">
                <div class="form-group">
                    <label for="day">Pilih Hari</label>
                    <select class="form-control bg-gray-200" id="day" wire:model="selectedDay">
                        <option value="">-- Pilih Hari --</option>
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $day)
                            <option value="{{ $day }}">{{ $day }}</option>
                        @endforeach
                    </select>
                    @error('selectedDay') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Session -->
            <div class="col-md-6 px-0 px-2">
                <div class="form-group">
                    <label for="session">Sesi</label>
                    <input type="text" class="form-control bg-gray-200" id="session" wire:model="session">
                    @error('session') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Lecturer Selection -->
            <div class="col-md-6 px-0 px-2">
                <div class="form-group">
                    <label for="lecturer_id">Pilih Dosen</label>
                    <select wire:model="selectedLecturerId" class="form-control bg-gray-200" id="lecturer_id">
                        <option value="">-- Pilih Dosen --</option>
                        @foreach($lecturers as $lecturer)
                            <option value="{{ $lecturer->id }}">{{ $lecturer->name }}</option>
                        @endforeach
                    </select>
                    @error('selectedLecturerId') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Other Inputs -->
            <div class="col-md-6 px-0 px-2">
                <div class="form-group">
                    <label for="grub">Kelas</label>
                    <input type="text" class="form-control bg-gray-200" id="grub" wire:model="grub" required>
                    @error('grub') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-md-6 px-0 px-2">
                <div class="form-group">
                    <label for="course">Mata Kuliah</label>
                    <input type="text" class="form-control bg-gray-200" id="course" wire:model="course">
                    @error('course') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-md-6 px-0 px-2">
                <div class="form-group">
                    <label for="room">Ruangan</label>
                    <input type="text" class="form-control bg-gray-200" id="room" wire:model="room">
                    @error('room') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-md-6 px-0 px-2">
                <div class="form-group">
                    <label for="credits">SKS</label>
                    <input type="number" class="form-control bg-gray-200" id="credits" wire:model="credits">
                    @error('credits') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-md-6 px-0 px-2">
                <div class="form-group">
                    <label for="start_time">Mulai</label>
                    <input type="time" class="form-control bg-gray-200" id="start_time" wire:model="startTime">
                    @error('startTime') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-md-6 px-0 px-2">
                <div class="form-group">
                    <label for="end_time">Selesai</label>
                    <input type="time" class="form-control bg-gray-200" id="end_time" wire:model="endTime">
                    @error('endTime') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</form>
@endif



  </div>
</div>