<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;
use App\Models\kontak;
use File;

class SiswaController extends Controller
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
        $data = siswa::all();
        return view('admin.MasterSiswa', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.TambahSiswa');
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
            'numeric' => ':attribute diisi coy',
            'min' => ':attribute minimal :min karakter coy',
            'max' => ':attribute maximal :max karakter gaess',
            'mimes' => 'file :attribute harus bertipe jpg,png,jpeg',
            'size'  => 'file yang diupload maksimal :size'
        ];
        $this->validate($request,[
            'nisn' => 'required|numeric',
            'nama'=> 'required|min:5|max:20',
            'alamat'=> 'required|min:5',
            'jk'=> 'required',
            'foto' => 'required|mimes:jpg,jpeg,png,gif,svg',
            'about'=> 'required',
            'email'=> 'required',
        ], $massage);

        // ambil info file yang diupload
        $file = $request->file('foto');
        // rename + ambil nama file
        $nama_file = time()."_".$file->getClientOriginalName();
        // proses upload
        $tujuan_upload = './template/img';
        $file->move($tujuan_upload, $nama_file);
        // Proses insert database
        siswa::create([
            'nisn' => $request->nisn,
            'nama'=> $request->nama,
            'alamat'=> $request->alamat,
            'jk'=> $request->jk,
            'foto' => $nama_file,
            'about'=> $request->about,
            'email'=> $request->email             
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
        $data = siswa::find($id);
        // $kontak = siswa::find($id)->kontak;
        return view('admin.ShowSiswa', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=siswa::find($id);
        return view('admin.EditSiswa', compact('data'));
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
        $siswa =siswa::find($id);
        $massage=[
            'required' => ':attribute harus diisi dulu gaess',
            'numeric' => ':attribute diisi coy',
            'min' => ':attribute minimal :min karakter coy',
            'mimes' => 'file :attribute harus bertipe jpg,png,jpeg',
            'max' => ':attribute maximal :max karakter gaess',
            'size'  => 'file yang diupload maksimal :size'
        ];
        $this->validate($request,[
            'nisn' => 'required|numeric',
            'nama'=> 'required|min:5|max:20',
            'alamat'=> 'required|min:5',
            'foto' => 'required|mimes:jpg,jpeg,png,gif,svg',
            'jk'=> 'required',
            'about'=> 'required',
            'email'=> 'required'
        ], $massage);
        

        if($request->foto !=''){
            // Dengan ganti foto

            //1. hapus foto lama
            file::delete('./template/img/'.$siswa->foto);

            //2. ambil info file yang diupload
            $file = $request->file('foto');

            //3. rename + ambil nama file
            $nama_file = time()."_".$file->getClientOriginalName();

            //4. proses upload
            $tujuan_upload = './template/img';
            $file->move($tujuan_upload, $nama_file);

            //5. Menyimpan ke database
            $siswa->nisn = $request->nisn;
            $siswa->nama = $request->nama;
            $siswa->jk = $request->jk;
            $siswa->email = $request->email;
            $siswa->alamat = $request->alamat;
            $siswa->about = $request->about;
            $siswa->foto = $nama_file;
            $siswa->save();
            return redirect ('/mastersiswa');

        } else {
            // Tanpa ganti foto
            $siswa->nisn = $request->nisn;
            $siswa->nama = $request->nama;
            $siswa->jk = $request->jk;
            $siswa->email = $request->email;
            $siswa->alamat = $request->alamat;
            $siswa->about = $request->about;
            $siswa->save();
            return redirect ('/mastersiswa');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapus($id)
    {
        $data=siswa::destroy($id);
        return redirect('mastersiswa');
    }
}