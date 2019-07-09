@extends('admin.admin')
@section('admin')
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
                        <li class="breadcrumb-item" aria-current="page"><a href="{{url('admin/pelanggan')}}"> Pelanggan</a></li>
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
                <h4>Grafik angka meter tahun {{ $thisYear }}</h4>
                <canvas id="lineAngkaMeter"></canvas>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <h5 class="card-header">Daftar Sudah Di Audit</h5>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="data-tables table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th>No Meter</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sudahAudit as $key)
                            <tr>
                                <td>{{ $key->tanggal }}</td>
                                <td>{{ $key->no_meter }}</td>
                                <td>{{ $key->nama }}</td>
                                <td>{{ $key->angka_meter }}</td>
                                <td>
                                    <img id="myImg" src="{{ asset('catat_meter/'.$key->gambar) }}" width="50">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">
    <!-- The Close Button -->
    <span class="close">&times;</span>
    <!-- Modal Content (The Image) -->
    <img class="modal-content" id="img01">
    <!-- Modal Caption (Image Text) -->
    <div id="caption"></div>
</div>
@endforeach
@stop

@push('custom-script')
<script>
    var url = "{{ url('admin/pelanggan/grafikAngkaMeter/' . $pelanggan->id) }}";
    var bulan = []
    var angkaMeter = []
    var charts = document.getElementById('lineAngkaMeter')

    $(document).ready(function() {
        $('#btn').click(function() {
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

    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function() {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }
    
</script>
@endpush