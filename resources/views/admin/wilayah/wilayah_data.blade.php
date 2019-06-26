@extends('admin.admin')
@section('admin')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Wilayah</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Wilayah</li>
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
    <!-- Tabel Kelurahan -->
    <!-- ============================================================== -->
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Daftar Kelurahan</h5>
            <div class="card-body">
                <table class="data-tables table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th>Kelurahan</th>
                            <th>Kecamatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kelurahans as $key)
                        <tr>
                            <th scope="row">{{ $key->id_kelurahan }}</th>
                            <td>{{ $key->nama_kelurahan }}</td>
                            <td>{{ $key->nama_kecamatan }}</td>
                            <td>
                                <a href="{{ route('admin.wilayah.show', $key->id_kelurahan) }}" class="text-secondary">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Tabel Kelurahan -->
    <!-- ============================================================== -->
</div>
@stop

@push('custom-script')

<script>

</script>

@endpush