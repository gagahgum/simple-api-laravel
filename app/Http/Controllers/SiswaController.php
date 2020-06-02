<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Siswa::All()->toJson(JSON_PRETTY_PRINT);
    }
    
    public function getSiswa($id){
        if (Siswa::where('id', $id)->exists()) {
            $siswa = Siswa::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($siswa, 200);
          } else {
            return response()->json([
              "message" => "Data siswa tidak ditemukan"
            ], 404);
          }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $siswa = new Siswa;
        $nama = $request->input('nama');
        $kelas = $request->input('kelas');
        $siswa->nama = $nama;
        $siswa->kelas = $kelas;
        if($siswa->save()){
            $request['message'] = "Data berhasil dimasukan";
            $request['value'] = "$siswa";
            return response($request);
        }
        else{
            $request['message'] = "Data gagal dimasukan";
            return response($request);
        }
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
        $nama = $request->input('nama');
        $kelas = $request->input('kelas');

        $siswa = Siswa::where('id',$id)->first();
        $siswa->nama = $nama;
        $siswa->kelas = $kelas;
        if($siswa->save()){
            $request['message'] = "Data berhasil diupdate";
            $request['value'] = "$siswa";
            return response($request);
        }
        else{
            $request['message'] = "Data gagal diupdate";
            return response($request);
        }
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
    public function delete($id)
    {
        //
        $siswa = Siswa::where('id',$id)->first();
        if($siswa->delete()){
            $request['message'] = "Data berhasil dihapus";
            $request['value'] = "$siswa";
            return response($request);
        }
        else{
            $request['message'] = "Data gagal dihapus";
            return response($request);
        }

        return "Data berhasil dihapus";
    }
}
