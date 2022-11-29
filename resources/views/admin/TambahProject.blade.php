@extends('admin.app')
@section('title', 'Tambah Project')
@section('content-title', 'Tambah Project')
@section('konten')
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div> 
                @endif
                <form method="POST" enctype="multipart/form-data" action="{{ route('masterproject.store')}}">
                    @csrf
                    <div class="form-group">
                        @foreach ($siswa as $item)
                        <input type="hidden" name="id_siswa" value="{{ $item->id }}">
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Project</label>
                        <input type="text" class="form-control" id="nama_project" name="nama_project" value="{{ old('nama_project')}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ old('deskripsi')}}">
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal </label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal')}}">
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto Project</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="simpan">
                        <a href="{{route ('masterproject.index') }}" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection