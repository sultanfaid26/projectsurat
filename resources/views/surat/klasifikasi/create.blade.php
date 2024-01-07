@extends('layouts.template')

@section('content')
<h1>Tambah Data Klasifikasi</h1>
<a href="/">Home</a> / <a href="{{ route('klasifikasi.data') }}">Data klasifikasi</a> / <a href="{{ route('klasifikasi.createData') }}">Tambah klasifikasi</a>

<br>

<form action="{{ route('klasifikasi.storeData') }}" method="post" class="card p-5 mt-5 bg-dark">
    {{--sebagai token akses database--}}
    @csrf
    {{--jika terjadi error validasi, akan ditampilkan bagian errornya : --}}
    @if ($errors->any())
        <ul class="alert alert-danger p-5">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif

    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    <div class="mb-3 row">
      <label for="letter_code" class="col-sm-2 col-form-label">Kode Surat :</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="letter_code" name="letter_code">
      </div>
    </div>
    <div class="mb-3 row">
      <label for="name_type" class="col-sm-2 col-form-label">Klasifikasi Surat :</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name_type" name="name_type">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Kirim</button>
</form>
@endsection