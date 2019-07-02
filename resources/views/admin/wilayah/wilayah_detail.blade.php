@extends('admin.admin')
@section('admin')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">{{ $kelurahan->nama_kelurahan }}, {{ $kelurahan->nama_kecamatan }}</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <a href="{{ url('admin/wilayah') }}" class="breadcrumb-item">Wilayah</a>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
    <!-- Karyawan -->
    <!-- ============================================================== -->
    <div class="col-xl-6 col-lg-12 col-md-6 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Karyawan</h5>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Kode</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($karyawans as $key)
                        <tr>
                            <th scope="row">{{ $key->kode_karyawan }}</th>
                            <td>{{ $key->nama_karyawan }}</td>
                            <td>{{ $key->telepon }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Karyawan -->
    <!-- ============================================================== -->
    <div class="col-xl-6 col-lg-12 col-md-6 col-sm-12 col-12">
        <div class="row">
            <!-- ============================================================== -->
            <!-- Jumlah Pelanggan -->
            <!-- ============================================================== -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-inline-block">
                            <h5 class="text-muted">Total Pelanggan</h5>
                            <h2 class="mb-0">{{ $countPelanggans }} orang</h2>
                        </div>
                        <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
                            <i class="fa fa-users fa-fw fa-sm text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Jumlah Pelanggan -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Belum Bulan Ini -->
            <!-- ============================================================== -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
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
        </div>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
        <div class="section-block">
            <h3 class="section-title">Catat Meter</h3>
        </div>
        <div class="card">
            <h5 class="card-header">
                <button class="btn btn-rounded btn-outline-primary btn-sm mr-2" data-toggle="modal" data-target="#modalFilter">Filter Periode</button>
            </h5>
            <div class="card-body">
                @if(session()->has('catat_meters'))
                <div class="table-responsive">
                    <table id="table" class="table data-table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>No Meter</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Angka</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(session()->get('catat_meters') as $key)
                            <tr>
                                <td>{{ $key->bulan }}</td>
                                <td>{{ $key->no_meter }}</td>
                                <td>{{ $key->nama }}</td>
                                <td>{{ $key->alamat }}</td>
                                <td>{{ $key->angka_meter }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="table-responsive">
                    <table id="table" class="table data-table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>No Pelanggan</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pelanggans as $key)
                            <tr>
                                <td>{{ $key->no_meter }}</td>
                                <td>{{ $key->nama }}</td>
                                <td>{{ $key->alamat }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Modal Filter -->
<!-- ============================================================== -->
<div class="modal fade" id="modalFilter" tabindex="-1" role="dialog" aria-labelledby="modalFilterTittle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFilterCenterTittle">Atur Periode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.wilayah.filter') }}" method="post">
                    @csrf
                    <input type="hidden" name="id_kelurahan" value="{{ $id_kelurahan }}">
                    <div class="form-group">
                        <label for="">Dari Bulan</label>
                        <br>
                        <select name="bulan_1" class="selectpicker">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <select name="tahun_1" class="selectpicker">
                            <?php
                            $right_now = getdate();
                            $this_year = $right_now['year'];
                            $start_year = 2000;
                            while ($this_year >= $start_year) {
                                echo "<option value='{$this_year}'>{$this_year}</option>";
                                $this_year--;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Sampai Bulan</label>
                        <br>
                        <select name="bulan_2" class="selectpicker">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <select name="tahun_2" class="selectpicker">
                            <?php
                            $right_now = getdate();
                            $this_year = $right_now['year'];
                            $start_year = 2000;
                            while ($this_year >= $start_year) {
                                echo "<option value='{$this_year}'>{$this_year}</option>";
                                $this_year--;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Kondisi</label>
                        <br>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="kondisi" value="1" checked="" class="custom-control-input"><span class="custom-control-label">Sudah</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="kondisi" value="0" class="custom-control-input"><span class="custom-control-label">Belum</span>
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Atur</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Modal Filter -->
<!-- ============================================================== -->

@stop

@push('custom-script')
<script>
    $(document).ready(function() {

        // $.ajax({
        //     url: "",
        //     method: "POST",
        //     data: {

        //     },
        //     success: data => {

        //     },
        //     error: function(xhr, ajaxOptions, thrownError) {
        //         console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        //     }
        // })
    })
</script>
@endpush