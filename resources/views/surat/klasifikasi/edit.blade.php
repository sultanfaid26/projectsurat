@extends('layouts.template')

@section('content')
<h1>Edit Data Klasifikasi</h1>
<a href="/">Home</a> / <a href="{{ route('klasifikasi.data') }}">Data Guru</a> / <a href="{{ route('klasifikasi.editKlasifikasi',  $data['id']) }}">Edit Data Klasifikasi</a>

<br>

<form action="{{ route('klasifikasi.updateData', $data['id']) }}" method="post" class="card p-5 mt-5 bg-dark">
    {{--sebagai token akses database--}}
    @csrf
    @method('PATCH')
    {{--jika terjadi error validasi, akan ditampilkan bagian errornya : --}}
    @if ($errors->any())
        <ul class="alert alert-danger p-5">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif

    <div class="mb-3 row">
      <label for="letter_code" class="col-sm-2 col-form-label">Kode Surat :</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="letter_code" name="letter_code" value="{{ $data['letter_code'] }}">
      </div>
    </div>
    <div class="mb-3 row">
        <label for="name_type" class="col-sm-2 col-form-label"> Klasifikasi Surat: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name_type" name="name_type" value="{{ $data['name_type'] }}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Kirim</button>
</form>
@endsection