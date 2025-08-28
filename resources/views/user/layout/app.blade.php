<!DOCTYPE html>
<html lang="en">

<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
     <link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="../../../assets/vendors/jsgrid/jsgrid.min.css">
    <link rel="stylesheet" href="../../../assets/vendors/jsgrid/jsgrid-theme.min.css">
    <link rel="stylesheet" href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vertical-light/style.css')}}">
    <link rel="shortcut icon" href="{{get_setting('mini_logo')}}" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/jsgrid/dist/jsgrid.min.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/jsgrid/dist/jsgrid.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

<style>
    /* Centered Scan Icon */
.fixed-bottom .nav-link {
    padding: 0.25rem 0.5rem !important;
}
    @media (max-width: 768px) {
  .navbar-nav .nav-item {
    margin-left: 10px;
    margin-right: 10px;
  }

  .navbar-brand img {
    height: 30px;
  }
}
@media (max-width: 768px) {
  #sidebar {
    position: fixed;
    bottom: 0;
    width: 100%;
    height: auto;
    top: auto;
    left: 0;
    right: 0;
    z-index: 1030;
    background: #fff;
    border-top: 1px solid #eee;
  }

  #sidebar .nav {
    flex-direction: row;
    justify-content: space-around;
  }

  #sidebar .nav-item {
    text-align: center;
  }

  #sidebar .menu-icon {
    font-size: 20px;
  }
}

.scan-trigger {
    position: fixed;
    top: 90%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 10000;
    /* background: #ffffff; */
    border-radius: 10%;
padding: 8px 11px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    cursor: pointer;
    transition: transform 0.2s ease;
}

.scan-trigger i {
    font-size: 50px;
    color: #333;
    padding: 0% !important;
}

/* Overlay Background */
.scan-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    padding: 20px;
    box-sizing: border-box;
}

/* Scanner Modal */
.scanner-container {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    max-width: 90%;
    width: 400px;
    box-sizing: border-box;
}

/* Scan result text */
.scan-result {
    margin-top: 10px;
    text-align: center;
    font-weight: bold;
}

/* Responsive */
@media (max-width: 600px) {

    .scanner-container {
        width: 100%;
        padding: 15px;


    }
.scan-trigger{
 padding: 2px 0px !important;
        top: 94% !important;
}
    .scan-trigger i {
        font-size: 36px;

    }
}

    .jsgrid-scroll-wrapper {
  width: 100%;
  overflow-x: auto;
  overflow-y: hidden;
  padding-bottom: 8px;
  border: 1px solid #ddd;
}

#js-grid ,#js-user{
  min-width: 1400px;
}


#profileDropdown::after,
#mobileMenuDropdown::after {
    content: none !important;
}




</style>
  </head>
  <body>
    <div class="container-scroller">
        @include('user.layout.header')
@include('user.layout.sidebar')
 <div class="main-panel">
@yield('content')
    @include('user.layout.footer')
<!-- jQuery (must be first) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />

<script>
    $(document).ready(function () {
        $('#qrTable').DataTable({
            pageLength: 10,
            lengthChange: false,
            columnDefs: [
                { orderable: false, targets: [1, 7] }
            ]
        });
    });
</script>


@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            html: `<img src="{{ asset('assets/images/icons/coin.png') }}" width="40" style="margin-bottom:10px;"><br>{{ session('success') }}`,
            confirmButtonColor: '#28a745',
            timer: 3000,
            timerProgressBar: true
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#dc3545',
            timer: 3000,
            timerProgressBar: true
        });
    </script>
@endif

