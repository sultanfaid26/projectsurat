<?php

namespace App\Http\Controllers;

use App\Models\LetterType;
use App\Models\Letter;
use Illuminate\Http\Request;
use Excel;
use App\Exports\LetterTypeExport;

class LetterTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = LetterType::orderBy('letter_code')->simplePaginate(5);
        return view('surat.klasifikasi.data', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createData()
    {
        return view('surat.klasifikasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeData(Request $request)
    {
        $request->validate([
            'letter_code' => 'required',
            'name_type' => 'required',
        ]);

        $existingCount = LetterType::count();

        $letterCode = $request->letter_code . '-' . ($existingCount + 1);

        LetterType::create([
            'letter_code' => $letterCode,
            'name_type' => $request->name_type,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data surat!');
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function editKlasifikasi($id)
    {
        $data = LetterType::find($id);

        return view('surat.klasifikasi.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateData(Request $request, $id)
    {
        $data = LetterType::find($id);

        if (!$data) {
            return redirect()->route('user.staff')->with('error', 'Akun Tidak Ditemukan');
        }
        
        $request->validate([
            'letter_code' => 'required',
            'name_type' => 'required',
        ]);

        LetterType::where('id', $id)->update
        ([
            'letter_code' => $request->letter_code,
            'name_type' => $request->name_type,
        ]);

      
        return redirect()->route('klasifikasi.data')->with('success', 'Berhasil mengubah data user!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        LetterType::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil Menghapus Data');
    }

    public function show($letter_code)
    {
        $letter_type = LetterType::where('letter_code', $letter_code)->first();

        $dataLetter = Letter::where('letter_type_id', 'LIKE', $letter_type->letter_code)->get();
        return view('surat.klasifikasi.lihat', compact('letter_type', 'dataLetter'));
    }

    public function searchData(Request $request)
    {
        $dataKla = $request->input('search');
        $data = LetterType::where('name_type', 'like', "%" . $dataKla . "%")->simplePaginate(5);
        return view('surat.klasifikasi.data', compact('data'));
    }

    public function downloadExcel()
    {
        $file_name = 'Data klasifikasi.xlsx';
        return Excel::download(new LetterTypeExport, $file_name);
    }
}
