@extends('layouts.template')

@section('content')
<h1>Data Klasifikasi</h1>
<a href="/">Home</a> / <a href="{{ route('klasifikasi.data') }}">Data Klasifikasi Surat</a> / <a href="{{ route('klasifikasi.lihat', $letter_type->letter_code) }}">Data Klasifikasi Surat</a>

    <div class="container mt-5">
        <div class="d-flex">
            <h2>{{ $letter_type['letter_code'] }}</h2>
            <h5 class="text-secondary mt-2" style="margin-left: 0.5rem;">| {{ $letter_type['name_type'] }}</h5>
        </div>
        <div class="d-flex">
            @foreach($dataLetter as $letters)
            <div class="card p-3 d-block" style="width: 500px; margin-right: 1rem">  
                
                    <h6>{{ $letters['letter_perihal'] }}</h6>
                    <a href="" class="nav-link " style="float: right;margin-top:-2rem; font-size:25px;">⬇</a>
                    <div class="p-3">
                        <h6>{{ Carbon\Carbon::parse($letter_type['created_at'])->locale('id_ID')->formatLocalized('%d %B %Y') }}</h6>
                        <ol>
                            <li>{{ $letters['recipients'] }}</li>
                        </ol>
                    </div>
            </div>
            @endforeach
        </div>
    </div>

@endsection