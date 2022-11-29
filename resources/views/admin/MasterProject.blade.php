@extends('admin.app')
@section('title', "Master Project")
@section('konten-title', "Master Project")
    
@section('konten')
<div class="row">
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 border bottom">
                <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
            </div>
            <div class="card-body text-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nisn</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                        <tbody>
                            @foreach ($siswas as $siswa)
                                <tr>
                                    <td>{{$siswa->nisn}}</td>
                                    <td>{{$siswa->nama}}</td>
                                    <td class="text-nowrap">
                                        <button onclick="show({{ $siswa->id }})" class="btn btn-info btn-circle btn-sm"><i class="fas fa-play"></i></button>

                                        <a href="{{ route('masterproject.create') }}?siswa={{ $siswa->id }}" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Project Siswa</h6>            
            </div>
            <div id="project" class="card-body">
                Pilih siswa terlebih dahulu
            </div>
        </div>
    </div>
</div>

<script>
    function show(id){
        $.get('masterproject/'+id, function(data){
            $('#project').html(data);
        })
    }
</script>
@endsection
