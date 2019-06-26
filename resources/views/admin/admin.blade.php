@extends('template')
@push('sidebar')
<li class="nav-divider">
    Menu
</li>
<li class="nav-item ">
    <a class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}" href="/admin/dashboard"><i class="fas fa-chart-pie fa-fw"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dashboard Admin</a>
</li>
<li class="nav-item ">
    <a class="nav-link {{ request()->is('admin/wilayah*') ? 'active' : '' }}" href="/admin/wilayah"><i class="fas fa-fw fa-map"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Wilayah</a>
</li>
<li class="nav-item ">
    <a class="nav-link {{ request()->is('admin/karyawan*') ? 'active' : '' }}" href="/admin/karyawan"><i class="fas fa-fw fa-user-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Karyawan</a>
</li>
<li class="nav-item ">
    <a class="nav-link {{ request()->is('admin/pelanggan*') ? 'active' : '' }}" href="/admin/pelanggan"><i class="fas fa-fw fa-users"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pelanggan</a>
</li>
@endpush

@section('content')
<!-- ============================================================== -->
<!-- wrapper  -->
<!-- ============================================================== -->
<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        @yield('admin')
    </div>
</div>
<!-- ============================================================== -->
<!-- end main wrapper -->
<!-- ============================================================== -->
@stop