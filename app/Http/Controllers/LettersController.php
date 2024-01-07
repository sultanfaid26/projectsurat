<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\LetterType;
use App\Models\User;
use Illuminate\Http\Request;
use Excel;
use App\Exports\LetterExport;

class LettersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Letter::orderBy('letter_type_id')->simplePaginate(5);
        return view('surat.datasurat.data', compact('data'));
    }

    public function index2()
    {

        $data = Letter::orderBy('letter_type_id')->simplePaginate(5);
        return view('surat.datasurat.guru.data', compact('data'));
    }

    public function createData()
    {
        $data = LetterType::all();
        $guru = User::where('role', 'guru')->get();
        return view('surat.datasurat.create', compact('data', 'guru'));
    }
    
    public function createData2()
    {
        $data = LetterType::all();
        $guru = User::where('role', 'guru')->get();
        return view('surat.datasurat.guru.create', compact('data', 'guru'));
    }
    
    public function upload(Request $request)
    {
        if($request->hasFile('file')) {
            //get filename with extension
            $filenamewithextension = $request->file('file')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('file')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File
            $request->file('file')->storeAs('public/uploads', $filenametostore);

            // you can save image path below in database
            $path = asset('storage/uploads/'.$filenametostore);

            echo $path;
            exit;
        }
    }

    public function upload2(Request $request)
    {
        if($request->hasFile('file')) {
            //get filename with extension
            $filenamewithextension = $request->file('file')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('file')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File
            $request->file('file')->storeAs('public/uploads', $filenametostore);

            // you can save image path below in database
            $path = asset('storage/uploads/'.$filenametostore);

            echo $path;
            exit;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeData(Request $request)
    {

        $request->validate([
            'letter_type_id' => 'required',
            'letter_perihal' => 'required',
            'recipients' => 'required',
            'content' => 'required',
            'notulis' => 'required',
        ]);


        Letter::create([
            'letter_type_id' => $request->letter_type_id,
            'letter_perihal' => $request->letter_perihal,
            'recipients' => $request->recipients,
            'content' => $request->content,
            'attachment' => $request->attachment,
            'notulis' => $request->notulis,
        ]);

        return redirect()->route('datasurat.data')->with('success', 'Berhasil menambahkan data surat!');
    }

    public function storeData2(Request $request)
    {

        $request->validate([
            'letter_type_id' => 'required',
            'letter_perihal' => 'required',
            'recipients' => 'required',
            'content' => 'required',
            'notulis' => 'required',
        ]);


        Letter::create([
            'letter_type_id' => $request->letter_type_id,
            'letter_perihal' => $request->letter_perihal,
            'recipients' => $request->recipients,
            'content' => $request->content,
            'attachment' => $request->attachment,
            'notulis' => $request->notulis,
        ]);

        return redirect()->route('guru.datasurat.data')->with('success', 'Berhasil menambahkan data surat!');
    }


    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cari = Letter::find($id);
        $data = LetterType::all();
        $guru = User::where('role', 'guru')->get();
        return view('surat.datasurat.edit', compact('data', 'guru', 'cari'));
    }

    public function edit2($id)
    {
        $cari = Letter::find($id);
        $data = LetterType::all();
        $guru = User::where('role', 'guru')->get();
        return view('surat.datasurat.guru.edit', compact('data', 'guru', 'cari'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $searchId = Letter::find($id);

        $request->validate([
            'letter_type_id' => 'required',
            'letter_perihal' => 'required',
            'recipients' => 'required',
            'content' => 'required',
            'notulis' => 'required',
        ]);


        Letter::create([
            'letter_type_id' => $request->letter_type_id,
            'letter_perihal' => $request->letter_perihal,
            'recipients' => $request->recipients,
            'content' => $request->content,
            'attachment' => $request->attachment,
            'notulis' => $request->notulis,
        ]);

        return redirect()->route('datasurat.data')->with('success', 'Berhasil mengubah data user!');
    }

    public function update2(Request $request, $id)
    {
        $searchId = Letter::find($id);

        $request->validate([
            'letter_type_id' => 'required',
            'letter_perihal' => 'required',
            'recipients' => 'required',
            'content' => 'required',
            'notulis' => 'required',
        ]);


        Letter::create([
            'letter_type_id' => $request->letter_type_id,
            'letter_perihal' => $request->letter_perihal,
            'recipients' => $request->recipients,
            'content' => $request->content,
            'attachment' => $request->attachment,
            'notulis' => $request->notulis,
        ]);

        return redirect()->route('guru.datasurat.data')->with('success', 'Berhasil mengubah data user!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Letter::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil Menghapus Data');
    }

    public function destroy2($id)
    {
        Letter::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil Menghapus Data');
    }

    public function searchData(Request $request)
    {
        $dataSur = $request->input('search');
        $data = Letter::where('letter_perihal', 'like', "%" . $dataSur . "%")->simplePaginate(5);
        return view('surat.datasurat.data', compact('data'));
    }

    public function searchData2(Request $request)
    {
        $dataSur = $request->input('search');
        $data = Letter::where('letter_perihal', 'like', "%" . $dataSur . "%")->simplePaginate(5);
        return view('surat.datasurat.guru.data', compact('data'));
    }

    public function downloadExcel()
    {
        $file_name = 'Data Surat.xlsx';
        return Excel::download(new LetterExport, $file_name);
    }

    public function downloadExcel2()
    {
        $file_name = 'Data Surat.xlsx';
        return Excel::download(new LetterExport, $file_name);
    }
}
