@if($data->empty())
    <h6 class="text-center">Siswa belum memiliki project</h6>

@else
    <div class="card">
        <div class="card-header">
            {{ $item->nama_project }}
        </div>
        <div class="card-body">
            <h6>Tanggal Project</h6>
            {{ $item->tanggal }}
            <h6>Deskripsi Project</h6>
            {{ $item->deskripsi }}
        </div>
        <div class="card-footer">
            <a href="" onclick="show({{ $item->id }})" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
            <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
        </div>
    </div>
@endforeach
@endif
