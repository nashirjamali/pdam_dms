@extends('admin.admin')
@section('admin')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Karyawan</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Karyawan</li>
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
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">
                <a href="/admin/karyawan/create" class="btn btn-primary">Tambah Karyawan</a>
            </h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="data-tables table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Kode</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Kelurahan</th>
                                <th>Kecamatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($karyawans as $key)
                            <tr>
                                <td>{{ $key->kode_karyawan }}</td>
                                <td>{{ $key->nama_karyawan }}</td>
                                <td>{{ $key->alamat }}</td>
                                <td>{{ $key->nama_kelurahan }}</td>
                                <td>{{ $key->nama_kecamatan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Tabel Karyawan -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Tabel Admin -->
    <!-- ============================================================== -->
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">
                <a href="/admin/karyawan/create-admin" class="btn btn-primary">Tambah Admin</a>
            </h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="data-tables table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Kode</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $key)
                            <tr>
                                <td>{{ $key->kode_karyawan }}</td>
                                <td>{{ $key->nama_karyawan }}</td>
                                <td>{{ $key->alamat }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--==============================================================-->
    <!-- End Tabel Admin -->
    <!-- ============================================================== -->
</div>
@stop