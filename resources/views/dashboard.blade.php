@extends('layouts.template')

@section('content')
<br>
<h1>Dashboard</h1>
<br>

<div style="float:left; margin-top:30px;" class="card">
    <div class="card-body" style="margin: 20px; margin-right:515px;">
        <h3>Surat Keluar </h3>
        <p><i class="bi bi-envelope fs-1 text-primary-emphasis"> 1 </i></p>
    </div>
</div>

<div style="clear:right; float:right; margin-top:30px;" class="card">
    <div class="card-body" style="margin: 20px; margin-right:100px;">
        <h3>Klasifikasi Surat </h3>
        <p><i class="bi bi-envelope fs-1 text-primary-emphasis"> 1 </i></p>
    </div>
</div>

<div style="clear:left; float:left; margin-top:30px; max-width:30%" class="card">
    <div class="card-body" style="margin: 20px; ">
        <h3>Staff Tata Usaha</h3>
        <p><i class="bi bi-envelope fs-1 text-primary-emphasis">2{{-- {{ $Staff }}--}}</i></p> 
    </div>
</div>

<div style="clear:right; float:right; margin-top:30px;" class="card">
    <div class="card-body" style="margin: 20px; margin-right:670px;">
        <h3>Guru </h3>
        <p><i class="bi bi-envelope fs-1 text-primary-emphasis"> 1{{--{{ $Guru }}--}}</i></p> 
    </div>
</div>
@endsection
