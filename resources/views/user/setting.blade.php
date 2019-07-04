@extends('user.user')
@section('user')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Ubah Password</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Setting</li>
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
    <!-- Form -->
    <!-- ============================================================== -->
    <div class="offset-xl-2 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">

        @if(session()->has('msg'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('msg') }}
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{route('karyawan.setting.store') }}" method="post">
                    {{ csrf_field() }}

                    <input type="hidden" value="user" name="role">
                    <input type="hidden" value="{{ $karyawan->kode_karyawan }}" name="kodeKaryawan">

                    <!-- Kode Karyawan -->
                    <div class="form-group">
                        <label for="">Kode Karyawan</label>
                        <input type="text" disabled class="form-control" value="{{ $karyawan->kode_karyawan }}">
                    </div>

                    <!-- Nama -->
                    <div class="form-group">
                        <label for="">Nama Karyawan</label>
                        <input disabled type="text" class="form-control" value="{{ $karyawan->nama_karyawan }}">
                    </div>

                    <!-- Password Lama -->
                    <div class="form-group">
                        <label for="">Masukan Password Lama</label>
                        <input type="password" class="form-control" name="passwordOld">
                    </div>

                    <!-- Password Baru -->
                    <div class="form-group">
                        <label for="">Masukan Password Baru</label>
                        <input type="password" class="form-control" name="passwordNew">
                    </div>

                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>

        </div>

        <div class="alert alert-warning" role="alert">
            <b>Password default adalah : </b> Karyawan[Kode Karyawan]
            <br>
            Contoh : <i>KaryawanKAR1</i>
        </div>

    </div>
</div>
<!-- ============================================================== -->
<!-- End Form -->
<!-- ============================================================== -->
</div>
@stop