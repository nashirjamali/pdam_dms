@extends('user.user')
@section('user')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Detail Pelanggan</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="{{url('karyawan/pelanggan')}}"> Pelanggan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Pelanggan</li>
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
    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h3>{{ $pelanggan->nama }}</h3>
                <p><i class="fas fa-fw fa-map-marker-alt text-primary mr-2"></i>{{ $pelanggan->alamat }}</p>
                <h5><i class="fas fa-fw fa-map text-secondary mr-2"></i>{{ $pelanggan->nama_kelurahan }}, {{ $pelanggan->nama_kecamatan }} </h5>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4>Bulan yang belum di audit</h4>
                @foreach($belumAudit as $key)
                <p>{{ $key }}</p>
                @endforeach
            </div>
        </div>

    </div>

    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h4>Grafik angka meter tahun </h4>
                <canvas id="lineAngkaMeter"></canvas>
            </div>
        </div>
    </div>
</div>
@stop

@push('custom-script')
<script>
    var url = "{{ url('karyawan/pelanggan/grafikAngkaMeter/' . $pelanggan->id) }}";
    var bulan = []
    var angkaMeter = []
    var charts = document.getElementById('lineAngkaMeter')

    $(document).ready(function() {
        $('#btn').click(function () {
            alert('diklik')
        })

        $.get(url, function(res) {
            res.forEach(function(data) {
                bulan.push(data.bulan)
            })

            res.forEach(function(data) {
                angkaMeter.push(data.angka_meter)
            })

            var pieChart = new Chart(charts, {
                type: 'bar',
                data: {
                    labels: bulan,
                    datasets: [{
                        label: bulan,
                        data: angkaMeter,
                        backgroundColor: '#FF91B4',
                        borderColor: '#FF548A'
                    }],
                }
            })

        })
    })
</script>
@endpush