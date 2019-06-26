@extends('template')
@push('sidebar')
<li class="nav-divider">
    Menu
</li>
<li class="nav-item ">
    <a class="nav-link {{ request()->is('karyawan/dashboard*') ? 'active' : '' }}" href="/karyawan/dashboard"><i class="fa fa-fw fa-chart-pie"></i>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard User<span class="badge badge-success">6</span></a>
</li>
<li class="nav-item ">
    <a class="nav-link {{ request()->is('karyawan/catat-meter*') ? 'active' : '' }}" href="/karyawan/catat-meter"><i class="fa fa-fw fa-file-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;Catat Meter<span class="badge badge-success">6</span></a>
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