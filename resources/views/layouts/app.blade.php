<!DOCTYPE html>


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.header')

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('img/sidebar-1.jpg') }}">
      <div class="sidebar-wrapper">
        @include('layouts.navigation')
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        @include('layouts.navbar')
      </nav>
      <!-- End Navbar -->
      <div class="content">
        @include('layouts.dashboard')
      </div>
      @yield('layouts.footer')
    </div>
  </div>
  @include('layouts.scripts')
</body>

</html>