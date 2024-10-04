<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
            Jadwal LAB Teknik Komputer - UNCP
  </title>

    @include('include.style')   

</head>

<body class="g-sidenav-show bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <main class="main-content position-relative border-radius-lg ">
    <div class="container-fluid py-4">

    <h1 class="text-center text-white">JADWAL LABORATORIUM TEKNIK KOMPUTER</h1>
    <h1 class="text-center text-white mb-4">UNIVERSITAS COKROAMINOTO PALOPO</h1>

    @livewire('public-schedules')

    </div>
  </main>
  @include('include.script')
</body>

</html>