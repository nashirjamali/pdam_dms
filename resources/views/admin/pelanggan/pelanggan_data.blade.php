@extends('admin.admin')
@section('admin')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Pelanggan</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Pelanggan</li>
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
    <!-- Tabel Karyawan -->
    <!-- ============================================================== -->
    <div class="offset-xl-2 col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">

        @if(session()->has('msg'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('msg') }}
        </div>
        @endif

        <div class="card">
            <h5 class="card-header">
                <a href="/admin/pelanggan/create" class="btn btn-primary">Tambah Pelanggan</a>
            </h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="data-tables table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No Meter</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Kelurahan</th>
                                <th>Kecamatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pelanggans as $key)
                            <tr>
                                <td>{{ $key->no_meter }}</td>
                                <td>{{ $key->nama }}</td>
                                <td>{{ $key->alamat }}</td>
                                <td>{{ $key->nama_kelurahan }}</td>
                                <td>{{ $key->nama_kecamatan }}</td>
                                <td>
                                    <a href="pelanggan/{{ $key->id }}" class="btn btn-info btn-sm">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Tabel Pelanggan -->
    <!-- ============================================================== -->
</div>
@stop