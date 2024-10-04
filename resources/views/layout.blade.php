<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
            @yield('title')
  </title>

    @include('include.style')   

</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>


  <!-- @include('include.navbar') -->



  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->

    @include('include.nav')


    <!-- End Navbar -->
    <div class="container-fluid py-4">


    @include('include.header')


    @yield('content')


      
    </div>
  </main>
  @include('include.script')
</body>

</html>