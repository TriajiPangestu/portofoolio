<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;
use App\Models\project;

class ProjectController extends Controller
{
    public function __constract() {
        $this->middleware('Auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project=project::all();
        $data=siswa::all('id', 'nama');
        return view('admin.MasterProject', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id_siswa = request()->query('siswa');
        $siswa = siswa::all();
        return view('admin.TambahProject', compact('siswa', 'id_siswa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $massage=[
            'required' => ':attribute harus diisi dulu gaess',
            'min' => ':attribute minimal :min karakter coy',
            'max' => ':attribute maximal :max karakter gaess',
        ];
        $this->validate($request,[
            'nama_project' => 'required|min:5|max:20',
            'tanggal' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required'
        ], $massage);

        // ambil info file yang diupload
        $file = $request->file('foto');
        // rename + ambil nama file
        $nama_file = time()."_".$file->getClientOriginalName();
        // proses upload
        $tujuan_upload = './template/img';
        $file->move($tujuan_upload, $nama_file);

        // Proses insert database
        project::create([
            'id_siswa' => $request->id_siswa,
            'nama_project' => $request->nama_projek,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'foto' => $nama_file             
        ]);

        return redirect('/mastersiswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = siswa::find($id)->project()->get(); 
        return view('admin.ShowProject', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = siswa::all();
        return view('admin.EditProject');
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
        $project = project::all();
        $massage=[
            'required' => ':attribute harus diisi dulu gaess',
            'min' => ':attribute minimal :min karakter coy',
            'max' => ':attribute maximal :max karakter gaess',
        ];
        $this->validate($request,[
            'id_siswa' => 'required',
            'nama_project' => 'required|min:5|max:20',
            // 'tanggal' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required'
        ], $massage);

        // ambil info file yang diupload
        $file = $request->file('foto');
        // rename + ambil nama file
        $nama_file = time()."_".$file->getClientOriginalName();
        // proses upload
        $tujuan_upload = './template/img';
        $file->move($tujuan_upload, $nama_file);

        // Proses insert database
        project::create([
            'id_siswa' => $request->id_siswa,
            'nama_project' => $request->nama_projek,
            // 'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'foto' => $nama_file           
        ]);

        return redirect('/mastersiswa');
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
