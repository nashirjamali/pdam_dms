<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PelangganKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->kode_karyawan;

        $karyawan = DB::table('karyawans')
            ->where('kode_karyawan', $userId)
            ->join('kecamatans', 'kecamatans.id_kecamatan', 'karyawans.id_kecamatan')
            ->join('kelurahans', 'kelurahans.id_kelurahan', 'karyawans.id_kelurahan')
            ->first();

        $pelanggans = DB::table('pelanggans')->where('id_kelurahan', $karyawan->id_kelurahan)->get();

        return view('user.pelanggan.pelanggan_data')->with(['karyawan' => $karyawan, 'pelanggans' => $pelanggans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelanggan = DB::table('pelanggans')
            ->where('id', $id)
            ->join('kelurahans', 'kelurahans.id_kelurahan', 'pelanggans.id_kelurahan')
            ->join('kecamatans', 'kecamatans.id_kecamatan', 'pelanggans.id_kecamatan')
            ->first();

        $thisYear = Carbon::now()->year;

        $belumAudit = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $catatMeters = DB::table('catat_meters')
            ->join('pelanggans', 'pelanggans.no_meter', '=', 'catat_meters.no_meter')
            ->whereYear('tanggal', '=', $thisYear)
            ->where('pelanggans.id', $id)
            ->select(
                DB::raw('MONTHNAME(tanggal) as bulan')
            )
            ->get();

        foreach ($catatMeters as $key) {
            if (in_array($key->bulan, $belumAudit)) {
                $idArr = array_search($key->bulan, $belumAudit);
                unset($belumAudit[$idArr]);
            }
        }

        return view('user.pelanggan.pelanggan_detail')->with(['pelanggan' => $pelanggan, 'thisYear' => $thisYear, 'belumAudit' => collect($belumAudit)]);
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

    public function grafikAngkaMeter($id)
    {
        $thisYear = Carbon::now()->year;
        $noMeter = DB::table('pelanggans')->where('id', '=', $id)->first()->no_meter;
        $angkaMeter = DB::table('catat_meters')
            ->where('no_meter', '=', $noMeter)
            ->whereYear('tanggal', '=', $thisYear)
            ->select(
                DB::raw('MONTHNAME(tanggal) as bulan'),
                'angka_meter'
            )
            ->get();
        return response()->json($angkaMeter);
    }
}
