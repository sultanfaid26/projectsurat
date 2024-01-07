@extends('layouts.template')

@section('content')
<h1>Tambah Data Staff Tu</h1>
<a href="/">Home</a> / <a href="{{ route('user.staff') }}">Data Staff Tu</a> / <a href="{{ route('user.createStaff') }}">Tambah Data Staff Tu</a>

<br>

<form action="{{ route('user.storeStaff') }}" method="post" class="card p-5 mt-5 bg-dark">
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
      <label for="name" class="col-sm-2 col-form-label">Nama :</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="name">
      </div>
    </div>
    <div class="mb-3 row">
      <label for="name" class="col-sm-2 col-form-label">Email :</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="email" name="email">
      </div>
    </div>
    <div hidden class="mb-3 row">
      <label for="type" class="col-sm-2 col-form-label">Tipe Pengguna :</label>
      <div class="col-sm-10">
        <select id="role" class="form-control" name="role">
            <option value="staff"> staff </option>
        </select>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Kirim</button>
</form>
@endsection