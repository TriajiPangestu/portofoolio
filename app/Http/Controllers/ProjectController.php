<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\project;
use App\Models\siswa;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswas=siswa::all();
        $projects=project::with('siswa')->get();
        return view('admin.MasterProject', compact('projects', 'siswas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id_siswa = request()->query('siswa');
        $siswas = siswa::find($id);
        return view('admin.TambahProject', compact('siswas'));
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
        $projeks = siswa::find($id)->projeks;
        return view('admin.ShowProject', compact('projeks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        project::find($id);
        $siswas = siswa::all();
        $projects = project::where('id',$id)->firstorfail();
        return view('admin.EditProjek', compact('projects'), compact('siswas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, project $masterproject)
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
        $projects = project::where('id', $id)->firstorfail();

        $projects=project::find($id)
            ->delete();
        return redirect('/admin/masterproject')->with('error', 'Berhasil Menghapus Data !');
    }
}