@extends('admin.admin')
@section('admin')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Admin</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="/admin/karyawan">Karyawan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Admin</li>
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
        <div class="card">
            <h5 class="card-header">
                Isi data karyawan
            </h5>
            <div class="card-body">
                <form action="{{ route('admin.karyawan.store') }}" method="post">
                    {{ csrf_field() }}

                    <input type="hidden" value="admin" name="role">
                    <!-- Nama -->
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input name="name" required type="text" class="form-control">
                    </div>

                    <!-- Alamat -->
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea required name="alamat" id="alamat" class="form-control" rows="2"></textarea>
                    </div>

                    <!-- Telepon -->
                    <div class="form-group">
                        <label for="">Telepon</label>
                        <div class="input-group mb-3 w-50">
                            <div class="input-group-prepend"><span class="input-group-text">+62</span></div>
                            <input required type="number" name="telepon" class="form-control">
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>

        </div>

        <div class="alert alert-warning" role="alert">
            <b>Password default adalah : </b> Admin[Kode Admin]
            <br>
            Contoh : <i>AdminADM1</i>
        </div>

    </div>
</div>
<!-- ============================================================== -->
<!-- End Form -->
<!-- ============================================================== -->
</div>
@stop

@push('custom-script')
<script>
</script>
@endpush