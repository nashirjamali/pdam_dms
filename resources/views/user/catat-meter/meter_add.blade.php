@extends('user.user')
@section('user')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Upload Catat Meter</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('karyawan/catat-meter') }}" class="breadcrumb-link">Catat Meter</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Upload</li>
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
    <div class="offset-xl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">
                Kelurahan {{ $kelurahan->nama_kelurahan }} , Kecamatan {{ $kecamatan->nama_kecamatan }}
            </h5>
            <div class="card-body">
                @if(session()->has('msg'))
                <div class="alert alert-warning">
                    {{ session()->get('msg') }}
                </div>
                @endif
                <form action="{{ route('karyawan.catat-meter.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <!-- No Meter -->
                    <div class="form-group">
                        <label for="">No Meter</label>
                        <select class="select2" name="noMeter">
                            @foreach($pelanggans as $key)
                            <option value="{{ $key->no_meter }}">{{ $key->no_meter }} || {{ $key->nama }} </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Angka Meter -->
                    <div class="form-group">
                        <label for="">Angka Meter</label>
                        <input type="number" class="form-control" name="angkaMeter">
                    </div>

                    <!-- Foto Meteran -->
                    <label for="">Foto Meteran</label>
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" name="fotoMeter" id="file">
                        <label class="custom-file-label" for="file">Upload Gambar</label>
                    </div>

                    <!-- Button Submit -->
                    <button class="btn btn-primary">
                        Simpan
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
@stop