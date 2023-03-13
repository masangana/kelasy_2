<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body>

  <!-- ======= Header ======= -->
    @include('layouts.header')
  <!-- End Header -->
  
  <!-- ======= Sidebar ======= -->    
  @if (Auth::user()->role == 'prof')
    @include('prof.menu')
  @elseif (Auth::user()->role == 'eleve')
    @include('eleve.menu')
  @elseif (Auth::user()->role == 'admin')
    @include('admin.menu')
  @elseif (Auth::user()->role == 'finance')
    @include('finance.menu')
  @elseif (Auth::user()->role == 'parent')
    @include('parent.menu')
  @endif

  <!-- End Sidebar-->

  <main id="main" class="main">

    @yield('content')

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('layouts.footer')
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  @include('layouts.scripts')

</body>

</html>