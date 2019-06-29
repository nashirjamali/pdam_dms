<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');

        $countPelanggan = DB::table('pelanggans')->count();
        $monthNow = Carbon::now()->monthName;
        $pelanggans = DB::table('pelanggans')->get();

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

        $countKelurahan = DB::table('kelurahans')->count('id_kelurahan');
        $countKaryawan = DB::table('karyawans')->where('kode_karyawan', 'LIKE', 'KAR%')->count();

        return view('admin.dashboard', [
            'countPelanggan' => $countPelanggan,
            'monthNow' => $monthNow, 'x' => $x,
            'countKelurahan' => $countKelurahan,
            'countKaryawan' => $countKaryawan
        ]);
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

    public function persebaranPelanggan()
    {
        $kecamatans = DB::table('kecamatans')->get();
        $countPelanggan = array();

        foreach ($kecamatans as $key) {
            $x = DB::table('pelanggans')->where('id_kecamatan', '=', $key->id_kecamatan)->count();
            array_push($countPelanggan, $x);
        }
        
        $countPelanggan = collect($countPelanggan);

        return response()->json(['kecamatans' => $kecamatans, 'countPelanggan' => $countPelanggan]);
    }
}
