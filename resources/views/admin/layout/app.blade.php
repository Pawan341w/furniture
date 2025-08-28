<!DOCTYPE html>
<html lang="en">

<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
     <link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">
<!-- Required for modal functionality -->
<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="../../../assets/vendors/jsgrid/jsgrid.min.css">
    <link rel="stylesheet" href="../../../assets/vendors/jsgrid/jsgrid-theme.min.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="../assets/css/vertical-light/style.css">
    <link rel="shortcut icon" href="{{ get_setting('favicon_icon') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/jsgrid/dist/jsgrid.min.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/jsgrid/dist/jsgrid.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>


<style>
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
</style>
  </head>
  <body>
    <div class="container-scroller">
        @include('admin.layout.header')
@include('admin.layout.sidebar')
 <div class="main-panel">
@yield('content')

    @include('admin.layout.footer')
<!-- jQuery (must be first) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

 <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> 

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />

<script>
    $(document).ready(function () {
        $('#qrTable').DataTable({
            pageLength: 10,
            columnDefs: [
                { orderable: false, targets: [1, 7] }
            ]
        });
    });
$(document).ready(function () {
    $('#general_settings_table').DataTable({
        pageLength: 10,
        columnDefs: [
            { orderable: false, targets: [1, 4] }
        ]
    });
});

</script>
