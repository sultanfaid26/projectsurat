@extends('layouts.template')

@section('content')
<h1>Edit Data Guru</h1>
<a href="/">Home</a> / <a href="{{ route('user.guru') }}">Data Guru</a> / <a href="{{ route('user.editGuru', $user['id']) }}">Edit Data Guru </a>
<br>
<form action="{{ route('user.updateGuru', $user['id'])}}" method="post" class="card p-5 mt-5 bg-dark">
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
      <label for="name" class="col-sm-2 col-form-label">Nama :</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="name" value="{{ $user['name'] }}">
      </div>
    </div>
    <div class="mb-3 row">
        <label for="price" class="col-sm-2 col-form-label"> Email: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email" value="{{ $user['email'] }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="price" class="col-sm-2 col-form-label"> Ubah Password: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="password" name="password">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Kirim</button>
</form>
@endsection