@extends('admin.admin')
@section('admin')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Dashboard Admin</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- end pageheader -->
<!-- ============================================================== -->
<div class="row">
    <!-- ============================================================== -->
    <!-- Total Pelanggan -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-inline-block">
                    <h5 class="text-muted">Total Pelanggan</h5>
                    <h2 class="mb-0">{{ $countPelanggan }} Orang</h2>
                </div>
                <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
                    <i class="fa fa-users fa-fw fa-sm text-info"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Total Pelanggan -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Belum Bulan Ini -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-inline-block">
                    <h5 class="text-muted">Belum Bulan {{ $monthNow }}</h5>
                    <h2 class="mb-0">{{ $x }} Orang</h2>
                </div>
                <div class="float-right icon-circle-medium  icon-box-lg  bg-danger-light mt-1">
                    <i class="fa fa-calendar-times fa-fw fa-sm text-danger"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Belum Bulan Ini -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Jumlah Wilayah -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-inline-block">
                    <h5 class="text-muted">Jumlah Kelurahan</h5>
                    <h2 class="mb-0">{{ $countKelurahan }} Kelurahan</h2>
                </div>
                <div class="float-right icon-circle-medium  icon-box-lg  bg-warning-light mt-1">
                    <i class="fa fa-map-marked-alt fa-fw fa-sm text-warning"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Jumlah Wilayah -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Jumlah Tenaga Lapangan -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-inline-block">
                    <h5 class="text-muted">Jumlah Karyawan</h5>
                    <h2 class="mb-0">{{ $countKaryawan }} Orang</h2>
                </div>
                <div class="float-right icon-circle-medium  icon-box-lg  bg-success-light mt-1">
                    <i class="fa fa-hard-hat fa-fw fa-sm text-success"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Jumlah Tenaga Lapangan -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Persebaran Pelanggan -->
    <!-- ============================================================== -->
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Pie Charts</h5>
            <div class="card-body">
                <canvas id="chartPelanggan"></canvas>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Persebaran Pelanggan -->
    <!-- ============================================================== -->
</div>
@stop

@push('custom-script')
<script>
    var url = "{{ url('admin/persebaranPelanggan') }}"
    var kecamatans = new Array()
    var jmlhPelanggan = new Array()
    var arrayan = [7, 6, 3, 232, 324, 565, 12, 34, 454, 231, 2342, 22, 43]

    var charts = document.getElementById('chartPelanggan')

    $(document).ready(function() {
        $.get(url, function(response) {

            console.log(response)

            response['kecamatans'].forEach(function(data) {
                kecamatans.push(data.nama_kecamatan)
            })

            response['countPelanggan'].forEach(function(data) {
                jmlhPelanggan.push(data)
            })

        })

        console.log(jmlhPelanggan)
        var data = {
            labels: kecamatans,
            datasets: [{
                label: kecamatans,
                data: jmlhPelanggan,
                backgroundColor: ['#3c40c6', '#ffdd59', '#00d8d6', '#d2dae2', '#f53b57', '#485460', '#0be881', '#ffa801', '#00d8d6', '#ff3f34', '#ffc048', '#0be881', '#ef5777']
            }],
            
        }

        var pieChart = new Chart(charts, {
            type: 'pie',
            data: data
        })

    })
</script>
@endpush