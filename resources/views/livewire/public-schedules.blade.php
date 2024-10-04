<div class="col-lg-12 mb-lg-0 mb-4 mt-4">
  <div class="card ">
    <div class="card-header pb-0 p-3">
      <div class="d-flex justify-content-between align-items-center">
      <h6 class="mb-2">Jadwal LAB Teknik Komputer</h6>
      <div class="ml-auto">

      <div class="col-md-12 px-0 px-2"> <!-- Fungsi search -->
            <div class="form-group">
                <input type="text" class="form-control bg-gray-200" id="search" placeholder="Cari Lab" wire:model.defer.live="search"> <!-- Menggunakan wire:model untuk binding input -->
                @error('course') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

      </div>
    </div>
    

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
            <thead class="bg-primary text-white" style="border: none;">
                <tr>
                    <th colspan="9" class="text-center font-weight-bold rounded-2">{{ $schedule->name }}</th>
                </tr>
                <tr>
                    <th class="text-center font-weight-bold">Hari</th>
                    <th class="text-center font-weight-bold">Jam Ke-</th>
                    <th class="text-center font-weight-bold">Jam</th>
                    <th class="text-center font-weight-bold">Kelas</th>
                    <th class="text-center font-weight-bold">Mata Kuliah</th>
                    <th class="text-center font-weight-bold">Dosen</th>
                    <th class="text-center font-weight-bold">Ruang</th>
                    <th class="text-center font-weight-bold">SKS</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($schedule->scheduleEntries as $entry)
                    <tr>
                        <td class="text-center">{{ $entry->day }}</td>
                        <td class="text-center">{{ $entry->session }}</td>
                        <td class="text-center">{{ $entry->start_time }} - {{ $entry->end_time }}</td>
                        <td class="text-center">{{ $entry->grub }}</td>
                        <td class="text-center">{{ $entry->course }}</td>
                        <td class="text-center">{{ $entry->lecturers->name }}</td>
                        <td class="text-center">{{ $entry->room }}</td>
                        <td class="text-center">{{ $entry->credits }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @endforeach

    </div>
  </div>
</div>