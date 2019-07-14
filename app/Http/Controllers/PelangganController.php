<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggans = DB::table('pelanggans')
            ->join('kecamatans', 'kecamatans.id_kecamatan', '=', 'pelanggans.id_kecamatan')
            ->join('kelurahans', 'kelurahans.id_kelurahan', '=', 'pelanggans.id_kelurahan')
            ->get();
        return view('admin.pelanggan.pelanggan_data', ['pelanggans' => $pelanggans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatans = DB::table('kecamatans')->get();
        return view('admin.pelanggan.pelanggan_add', ['kecamatans' => $kecamatans]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $noMeter = $request->get('no_meter');
        $nama = $request->get('name');
        $alamat = $request->get('alamat');
        $idKecamatan = $request->get('kecamatan');
        $idKelurahan = $request->get('kelurahan');
        DB::table('pelanggans')->insert([
            'no_meter' => $noMeter,
            'nama' => $nama,
            'alamat' => $alamat,
            'id_kecamatan' => $idKecamatan,
            'id_kelurahan' => $idKelurahan
        ]);

        return redirect('admin/pelanggan')->with('msg', 'Data Berhasil Disimpan');
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
            ->where('id', '=', $id)
            ->join('kelurahans', 'kelurahans.id_kelurahan', '=', 'pelanggans.id_kelurahan')
            ->join('kecamatans', 'kecamatans.id_kecamatan', '=', 'pelanggans.id_kecamatan')
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


        $sudahAudit = DB::table('catat_meters')
            ->where('no_meter', $pelanggan->no_meter)
            ->get();

        foreach ($catatMeters as $key) {
            if (in_array($key->bulan, $belumAudit)) {
                $idArr = array_search($key->bulan, $belumAudit);
                unset($belumAudit[$idArr]);
            }
        }

        return response()->view('admin.pelanggan.pelanggan_detail', ['pelanggan' => $pelanggan, 'thisYear' => $thisYear, 'sudahAudit' => $sudahAudit, 'belumAudit' => collect($belumAudit)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelanggan = DB::table('pelanggans')->where('id', $id)->first();
        $kecamatans = DB::table('kecamatans')->get();
        $kelurahans = DB::table('kelurahans')->get();
        return view('admin.pelanggan.pelanggan_edit', ['pelanggan' => $pelanggan, 'kecamatans' => $kecamatans, 'kelurahans' => $kelurahans]);
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
        $nama = $request->get('name');
        $alamat = $request->get('alamat');
        $idKecamatan = $request->get('kecamatan');
        $idKelurahan = $request->get('kelurahan');

        DB::table('pelanggans')->where('id', $id)->update([
            'nama' => $nama,
            'alamat' => $alamat,
            'id_kecamatan' => $idKecamatan,
            'id_kelurahan' => $idKelurahan
        ]);

        return redirect('admin/pelanggan')->with('msg', 'Data Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('pelanggans')->delete($id);

        return redirect('admin/pelanggan')->with('msg', 'Data Berhasil Dihapus');
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
