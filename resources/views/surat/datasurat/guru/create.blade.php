@extends('layouts.template')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/trix.css') }}">
</head>
<body>
    <form method="post" action="{{ route('guru.datasurat.store') }}">
    <div class="mb-3 row">
        <label for="letter_perihal" class="col-sm-2 col-form-label">Perihal :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="letter_perihal" name="letter_perihal">
        </div>
      </div>

    <div class="mb-3 row">
        <label for="letter_type_id" class="col-sm-2 col-form-label">Tipe Surat :</label>
        <div class="col-sm-10">
          <select id="letter_type_id" class="form-control" name="letter_type_id">
              <option value="" selected hidden disabled>Pilih</option>    
            @foreach ($data as $item)
              <option value="{{$item->id}}">{{ $item->name_type }}</option>
            @endforeach
          </select>
        </div>
      </div>

        @csrf
        <p>
            <input id="content" type="hidden" name="content" value="<h1>This is content</h1>" />
            <trix-editor input="content" class="trix-content"></trix-editor>
        </p>

    <table class="table mt-4 table-striped table-bordered table-hovered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Peserta Checklist Jika "Ikut Berpartisipasi"</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($guru as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td><input type="checkbox" value="{{ $item['name'] }}" name="recipients" id="recipients"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
        <div class="mb-3 row">
            <label for="attachment" class="col-sm-2 col-form-label">Lampiran :</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" id="attachment" name="attachment">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="notulis" class="col-sm-2 col-form-label">Notulis :</label>
            <div class="col-sm-10">
              <select id="notulis" class="form-control" name="notulis">
                  <option value="" selected hidden disabled>Pilih</option>    
                @foreach ($guru as $item)
                  <option value="{{$item['name']}}">{{ $item['name'] }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
    <script src="{{ asset('js/trix.umd.min.js') }}"></script>
    <script src="{{ asset('js/attachments.js') }}"></script>
</body>
</html>

@endsection