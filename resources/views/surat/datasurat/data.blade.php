@extends('layouts.template')

@section('content')
<h1>Data Surat</h1>
<a href="/">Home</a> / <a href="datasurat.data">Data Surat</a>
<br>
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success')}}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted')}}</div>
    @endif

    <div class="d-flex justify-content-end">
        <a href="{{ route('datasurat.download-excel') }}" class="btn btn-primary"><i class="bi bi-upload"></i> Export Excel</a>
    </div>
    <a href="{{route('datasurat.createData')}}" class="btn btn-primary mt-5 ">Tambah Data</a>
    <form action="{{ route('datasurat.searchData') }}" method="get" class="mt-3">
        <div style="width: 500px" class="d-flex">
            <input type="text" class="form-control" placeholder="Search...." name="search" id="search" style="margin-left: 5px">
            <Button type="submit" class="btn btn-success" style="margin-left: 5px">Cari</Button>
            <a href="{{ route('datasurat.data') }}" class="btn btn-danger" style="margin-left: 5px">Reset</a>
        </div>
    </form>
<table class="table mt-4 table-striped table-bordered table-hovered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nomor Surat</th>
            <th>Perihal</th>
            <th>Tanggal Keluar</th>
            <th>Penerima Surat</th>
            <th>Notulis</th>
            <th>Hasil Rapot</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach ($data as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item['letter_type_id'] }}</td>
                <td>{{ $item['letter_perihal'] }}</td>
                <td>{{ $item['created_at'] }}</td>
                <td>{{ $item['recipients'] }}</td>
                <td>{{ $item['notulis'] }}</td>
                <td>Sudah Dilaksanakan</td>    
                <td class="d-flex justify-content-center">
                   <a href="" class=" me-3 mt-2 ">Lihat</a> 
                  <a href="{{ route('datasurat.edit', $item->id) }}" class="btn btn-primary me-3"><i class="ri-edit-line">Edit</i></a>
                    <form action="{{ route('datasurat.delete', $item->id) }}" method="POST">
                       @csrf
                       @method('DELETE')
                       <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item['id'] }}">
                            <i class="ri-delete-bin-line">Hapus</i>
                       </button>
                            <div class="modal fade" id="exampleModal{{ $item['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                 <div class="modal-dialog">
                                   <div class="modal-content">
                                    <div class="modal-header">
                                       <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                               </div>
                                          <div class="modal-body">
                                             <p>Yakin ingin menghapus data ini ?</p>
                                                  </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                 <button type="submit" class="btn btn-danger">Hapus</button>
                                            </div>
                                     </div>
                              </div>
                        </div>
                  </form>
             </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection