<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Redirect;

class SettingKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $kodeKaryawan = Auth::user()->kode_karyawan;
        $karyawan = DB::table('karyawans')->where('kode_karyawan', $kodeKaryawan)->first();
        return view('user.setting')->with(['karyawan' => $karyawan]);
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
        $passwordOld = $request->get('passwordOld');
        $kodeKaryawan = $request->get('kodeKaryawan');
        $passwordNew = $request->get('passwordNew');

        $user = User::where('kode_karyawan', '=', $kodeKaryawan)->first();

        if (Hash::check($passwordOld, $user->password)) {
            DB::table('users')->where('kode_karyawan', $kodeKaryawan)->update([
                'password' => bcrypt($passwordNew)
            ]);

            return redirect('/karyawan');
        } else {
            return redirect()->back()->with('msg', 'Password lama salah');  
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
    { }

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
