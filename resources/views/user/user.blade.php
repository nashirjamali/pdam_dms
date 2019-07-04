@extends('template')
@push('sidebar')
<li class="nav-divider">
    Menu
</li>
<li class="nav-item ">
    <a class="nav-link {{ request()->is('karyawan/catat-meter/create*') ? 'active' : '' }}" href="/karyawan/catat-meter/create"><i class="fa fa-fw fa-upload"></i>&nbsp;&nbsp;&nbsp;&nbsp;Upload Data</a>
</li>
<li class="nav-item ">
    <a class="nav-link {{ request()->is('karyawan/pelanggan*') ? 'active' : '' }}" href="/karyawan/pelanggan"><i class="fa fa-fw fa-file-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;Pelanggan</a>
</li>
@endpush

@section('content')
<!-- ============================================================== -->
<!-- wrapper  -->
<!-- ============================================================== -->
<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        @yield('user')
    </div>
</div>
<!-- ============================================================== -->
<!-- end main wrapper -->
<!-- ============================================================== -->
@stop