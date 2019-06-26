<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelurahans = DB::table('kelurahans')
            ->join('kecamatans', 'kecamatans.id_kecamatan', '=', 'kelurahans.id_kecamatan')
            ->get();

        return view('admin.wilayah.wilayah_data', ['kelurahans' => $kelurahans]);
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
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $monthNow = Carbon::now()->monthName;
        $pelanggans = DB::table('pelanggans')->where('id_kelurahan', $id)->get();

        $x = 0;

        foreach ($pelanggans as $key) {
            if (DB::table('catat_meters')
                ->whereMonth('tanggal', Carbon::now()->month)
                ->whereYear('tanggal', Carbon::now()->year)
                ->where('no_meter', $key->no_meter)
                ->first()
            ) { } else {
                $x++;
            }
        }

        $kelurahan = DB::table('kelurahans')
            ->join('kecamatans', 'kecamatans.id_kecamatan', '=', 'kelurahans.id_kecamatan')
            ->where('id_kelurahan', $id)
            ->first();

        $karyawans = DB::table('karyawans')
            ->where('id_kelurahan', $id)
            ->where('kode_karyawan', 'LIKE', 'KAR%')
            ->get();

        $countPelanggans = DB::table('pelanggans')
            ->where('id_kelurahan', $id)
            ->count();

        $catat_meters = DB::table('catat_meters')
            ->join('pelanggans', 'pelanggans.no_meter', '=', 'catat_meters.no_meter')
            ->where('id_kelurahan', $id)
            ->get();

        return view('admin.wilayah.wilayah_detail', [
            'kelurahan' => $kelurahan,
            'karyawans' => $karyawans,
            'countPelanggans' => $countPelanggans,
            'x' => $x,
            'monthNow' => $monthNow,
            'id_kelurahan' => $id,
            'catat_meters' => $catat_meters
        ]);
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

    public function filter(Request $request)
    {
        $id_kelurahan = $request->get('id_kelurahan');
        $bulan_1 = $request->get('bulan_1');
        $bulan_2 = $request->get('bulan_2');
        $tahun_1 = $request->get('tahun_1');
        $tahun_2 = $request->get('tahun_2');

        $catat_meters = DB::table('catat_meters')
            ->whereYear('tanggal', '>=', $tahun_1)
            ->whereYear('tanggal', '<=', $tahun_2)
            ->whereMonth('tanggal', '>=', $bulan_1)
            ->whereMonth('tanggal', '<=', $bulan_2)
            ->join('pelanggans', 'pelanggans.no_meter', '=', 'catat_meters.no_meter')
            ->where('id_kelurahan', $id_kelurahan)
            ->get();

        return redirect('admin/wilayah/' . $id_kelurahan)->with(['catat_meters' => $catat_meters]);
    }
}
