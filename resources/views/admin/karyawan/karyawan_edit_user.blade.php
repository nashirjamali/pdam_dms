@extends('admin.admin')
@section('admin')
<!-- ============================================================== -->
<!-- pageheader -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Edit Karyawan</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="/admin/karyawan">Karyawan</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Karyawan</li>
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
                <form action="{{ route('admin.karyawan.update', $user->kode_karyawan) }}" method="post">
                    {{ csrf_field() }}

                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" value="user" name="role">
                    <!-- Nama -->
                    <div class="form-group">
                        <label for="">Nama Karyawan</label>
                        <input name="name" required type="text" value="{{ $user->nama_karyawan }}" class="form-control">
                    </div>

                    @if($user->role == 'user')
                    <div class="row">

                        <!-- Kecamatan -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Kecamatan</label>
                                <br>
                                <select required class="form-control" name="kecamatan" id="selectKecamatan">
                                    @foreach($kecamatans as $key)
                                    <option value="{{ $key->id_kecamatan }}" {{ ($user->id_kecamatan == $key->id_kecamatan ? "selected" : "" ) }}>{{ $key->nama_kecamatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Kelurahan -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Kelurahan</label><br>
                                <select required class="form-control" name="kelurahan" id="selectKelurahan">
                                    @foreach($kelurahans as $key)
                                    <option value="{{ $key->id_kelurahan }}" {{ ($user->id_kelurahan == $key->id_kelurahan ? "selected" : "" ) }}>{{ $key->nama_kelurahan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    @endif

                    <!-- Alamat -->
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea required name="alamat" id="alamat" class="form-control" rows="2">{{ $user->alamat }}</textarea>
                    </div>

                    <!-- Telepon -->
                    <div class="form-group">
                        <label for="">Telepon</label>
                        <div class="input-group mb-3 w-50">
                            <div class="input-group-prepend"><span class="input-group-text">+62</span></div>
                            <input required type="number" name="telepon" class="form-control" value="{{ $user->telepon }}">
                        </div>
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