@extends('user.user')
@section('user')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Catat Meter</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Catat Meter</li>
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
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        @if(session()->has('msg'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('msg') }}
        </div>
        @endif

        <div class="card">
            <h5 class="card-header">
                <a href="/karyawan/catat-meter/create" class="btn btn-primary text-light">Upload Catat Meter</a>
            </h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>No Meter</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Angka</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($catatMeters as $key)
                            <tr>
                                <td>{{ $key->tanggal }}</td>
                                <td>{{ $key->no_meter }}</td>
                                <td>{{ $key->nama }}</td>
                                <td>{{ $key->alamat }}</td>
                                <td>{{ $key->angka_meter }}</td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop