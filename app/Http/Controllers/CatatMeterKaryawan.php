<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class CatatMeterKaryawan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->kode_karyawan;
        $karyawan = DB::table('karyawans')->where('kode_karyawan', '=', $userId)->first();
        $noMeters = DB::table('pelanggans')
            ->where('id_kelurahan', '=', $karyawan->id_kelurahan)
            ->select('no_meter')
            ->get()->toArray();
        $noMeters = json_decode(json_encode($noMeters), true);

        $catatMeters = DB::table('catat_meters')->whereIn('catat_meters.no_meter', $noMeters)
            ->join('pelanggans', 'pelanggans.no_meter', '=', 'catat_meters.no_meter')
            ->select(
                'tanggal',
                'catat_meters.no_meter',
                'catat_meters.nama',
                'alamat',
                'angka_meter'
            )
            ->get();

        return view('user.catat-meter.meter_data', ['catatMeters' => $catatMeters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::user()->kode_karyawan;
        $karyawan = DB::table('karyawans')->where('kode_karyawan', '=', $userId)->first();
        $pelanggans = DB::table('pelanggans')
            ->where('id_kelurahan', '=', $karyawan->id_kelurahan)
            ->get();
        $kelurahan = DB::table('kelurahans')->where('id_kelurahan', '=', $karyawan->id_kelurahan)->first();
        $kecamatan = DB::table('kecamatans')->where('id_kecamatan', '=', $karyawan->id_kecamatan)->first();

        return view('user.catat-meter.meter_add', ['pelanggans' => $pelanggans, 'kelurahan' => $kelurahan, 'kecamatan' => $kecamatan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dateNow = Carbon::now();
        $noMeter = $request->get('noMeter');

        if (DB::table('catat_meters')->where('no_meter', $noMeter)->whereYear('tanggal', $dateNow->year)->whereMonth('tanggal',$dateNow->month)->first()) {
            return redirect()->back()->with('msg', 'Angka meter bulan ini telah di upload');  
        }else{
            $nama = DB::table('pelanggans')->where('no_meter', $noMeter)->first()->nama;
            $angkaMeter = $request->get('angkaMeter');
            $tanggal = $dateNow->toDateString();
            $fotoMeter = $request->file('fotoMeter');
            $tujuanUpload = 'catat_meter';
            $namaFoto = $dateNow->year. $dateNow->month . '_' . $noMeter . '.' . $fotoMeter->getClientOriginalExtension();
            $fotoMeter->move($tujuanUpload, $namaFoto);

            DB::table('catat_meters')->insert([
                'no_meter' => $noMeter,
                'nama' => $nama,
                'angka_meter' => $angkaMeter,
                'tanggal' => $tanggal,
                'gambar' => $namaFoto,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            return redirect('karyawan');

            // return redirect('karyawan/catat-meter')->with('msg', 'Data berhasil di upload');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
