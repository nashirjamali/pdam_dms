<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
