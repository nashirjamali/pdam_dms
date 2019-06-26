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
    <!-- Form -->
    <!-- ============================================================== -->
    <div class="offset-xl-2 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">
                Isi data karyawan
            </h5>
            <div class="card-body">
                <form action="{{ route('admin.pelanggan.store') }}" method="post">
                    {{ csrf_field() }}

                    <!-- No Meter -->
                    <div class="form-group">
                        <label for="">No Meter</label>
                        <input name="no_meter" type="number" required class="form-control">
                    </div>

                    <!-- Nama -->
                    <div class="form-group">
                        <label for="">Nama Pelanggan</label>
                        <input name="name" required type="text" class="form-control">
                    </div>

                    <div class="row">

                        <!-- Kecamatan -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Kecamatan</label>
                                <br>
                                <select required class="form-control" name="kecamatan" id="selectKecamatan">
                                    @foreach($kecamatans as $key)
                                    <option value="{{ $key->id_kecamatan }}">{{ $key->nama_kecamatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Kelurahan -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Kelurahan</label><br>
                                <select required class="form-control" name="kelurahan" id="selectKelurahan"> </select>
                            </div>
                        </div>

                    </div>

                    <!-- Alamat -->
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea required name="alamat" id="alamat" class="form-control" rows="2"></textarea>
                    </div>

                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>

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
    $(document).ready(function() {
        $('#selectKecamatan').change(function() {

            var kecamatanId = $(this).val()
            var _token = $('input[name="_token"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $.ajax({
                url: "{{ url('admin/wilayah/kelurahanCek') }}",
                method: "POST",
                data: {
                    kecamatanId: kecamatanId,
                    _token: _token
                },
                success: data => {
                    var kelurahans = JSON.parse(data)
                    var option = ''
                    kelurahans.forEach(e => {
                        option += "<option value=" + e.id_kelurahan + " >" + e.nama_kelurahan + "</option>"
                    });

                    $('#selectKelurahan').html(option)
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            })

        })
    })
</script>
@endpush