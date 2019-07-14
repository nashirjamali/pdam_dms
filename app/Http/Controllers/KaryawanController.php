<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawans = DB::table('karyawans')
            ->join('kecamatans', 'kecamatans.id_kecamatan', '=', 'karyawans.id_kecamatan')
            ->join('kelurahans', 'kelurahans.id_kelurahan', '=', 'karyawans.id_kelurahan')
            ->join('users', 'users.kode_karyawan', '=', 'karyawans.kode_karyawan')
            ->where('role', 'user')
            ->get();

        $admins = DB::table('karyawans')
            ->join('users', 'users.kode_karyawan', '=', 'karyawans.kode_karyawan')
            ->where('role', 'admin')
            ->get();

        return view('admin.karyawan.karyawan_data', ['karyawans' => $karyawans, 'admins' => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelurahans = DB::table('kelurahans')->get();
        $kecamatans = DB::table('kecamatans')->get();
        return view('admin.karyawan.karyawan_add_user', ['kelurahans' => $kelurahans, 'kecamatans' => $kecamatans]);
    }

    public function createAdmin()
    {
        return view('admin.karyawan.karyawan_add_admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = $request->get('role');
        $nama = $request->get('name');
        $id_kelurahan = $request->get('kelurahan');
        $id_kecamatan = $request->get('kecamatan');
        $alamat = $request->get('alamat');
        $telepon = $request->get('telepon');

        if ($role == 'user') {
            $lastId = DB::table('karyawans')->where('kode_karyawan', 'LIKE', 'KAR%')->count() + 1;
            $kodeKaryawan = 'KAR' . $lastId;
            DB::table('karyawans')->insert([
                'kode_karyawan' => $kodeKaryawan,
                'nama_karyawan' => $nama,
                'id_kelurahan' => $id_kelurahan,
                'id_kecamatan' => $id_kecamatan,
                'alamat' => $alamat,
                'telepon' => $telepon
            ]);

            DB::table('users')->insert([
                'kode_karyawan' => $kodeKaryawan,
                'role' => 'user',
                'password' => bcrypt('Karyawan' . $kodeKaryawan)
            ]);
        } elseif ($role == 'admin') {
            $id_kelurahan = 1;
            $id_kecamatan = 1;
            $lastId = DB::table('karyawans')->where('kode_karyawan', 'LIKE', 'ADM%')->count() + 1;
            $kodeKaryawan = 'ADM' . $lastId;
            DB::table('karyawans')->insert([
                'kode_karyawan' => $kodeKaryawan,
                'nama_karyawan' => $nama,
                'id_kelurahan' => $id_kelurahan,
                'id_kecamatan' => $id_kecamatan,
                'alamat' => $alamat,
                'telepon' => $telepon
            ]);

            DB::table('users')->insert([
                'kode_karyawan' => $kodeKaryawan,
                'role' => 'admin',
                'password' => bcrypt('Admin' . $kodeKaryawan)
            ]);
        }

        return redirect('/admin/karyawan');
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
        $user = DB::table('karyawans')->where('karyawans.kode_karyawan', $id)
            ->join('users', 'users.kode_karyawan', '=', 'karyawans.kode_karyawan')
            ->select(
                'karyawans.kode_karyawan',
                'karyawans.nama_karyawan',
                'karyawans.alamat',
                'karyawans.telepon',
                'karyawans.id_kecamatan',
                'karyawans.id_kelurahan',
                'users.role'
            )
            ->first();

        $kecamatans = DB::table('kecamatans')->get();
        $kelurahans = DB::table('kelurahans')->get();
        return view('admin.karyawan.karyawan_edit_user', ['user' => $user, 'kecamatans' => $kecamatans, 'kelurahans' => $kelurahans]);
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
        $id_kelurahan = $request->get('kelurahan');
        $id_kecamatan = $request->get('kecamatan');
        $alamat = $request->get('alamat');
        $telepon = $request->get('telepon');

        DB::table('karyawans')->where('kode_karyawan', $id)->update([
            'nama_karyawan' => $nama,
            'id_kelurahan' => $id_kelurahan,
            'id_kecamatan' => $id_kecamatan,
            'alamat' => $alamat,
            'telepon' => $telepon
        ]);

        return redirect('/admin/karyawan')->with(['msg' => 'Data Berhasil Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('karyawans')->where('kode_karyawan', $id)->delete();

        return redirect('/admin/karyawan')->with(['msgDelete' => 'Data Berhasil Dihapus']);
    }

    public function kelurahanCek(Request $request)
    {
        $kecamatanId = $request->get('kecamatanId');
        $kelurahans = DB::table('kelurahans')->where('id_kecamatan', '=', $kecamatanId)->get();

        return $kelurahans->toJson();
    }
}
