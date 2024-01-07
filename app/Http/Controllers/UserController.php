<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PharIo\Manifest\Email;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dash() {
        $Staff = User::where('role', 'staff')->count();
        $Guru = User::where('role', 'guru')->count();
        
        return view('dashboard', compact('Staff', 'Guru'));
    }
    public function  staff()
    {
        $user = User::where('role', 'staff')->simplePaginate(5);
        return view('user.staff.user', compact('user'));
    }

    public function  guru()
    {
        $user = User::where('role', 'guru')->simplePaginate(5);
        return view('user.guru.user', compact('user'));
    }

    public function createStaff()
    {
        return view('user.staff.create');
    }

    public function createGuru()
    {
        return view('user.guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeStaff(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
        ]);

        $emailPrefix = substr($request->email, 0, 3);
        $namePrefix = substr($request->name, 0, 3);

        // Menggabungkan kedua prefix menjadi password
        $generatedPassword = $emailPrefix . $namePrefix;

        // Mengenkripsi password dengan bcrypt
        $hashedPassword = bcrypt($generatedPassword);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'staff',
            'password' => $generatedPassword,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data user!');
    }
    public function storeGuru(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
        ]);

        $emailPrefix = substr($request->email, 0, 3);
        $namePrefix = substr($request->name, 0, 3);

        // Menggabungkan kedua prefix menjadi password
        $generatedPassword = $emailPrefix . $namePrefix;

        // Mengenkripsi password dengan bcrypt
        $hashedPassword = bcrypt($generatedPassword);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'guru',
            'password' => $generatedPassword,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data user!');
    }

    public function editStaff($id)
    {
        $user = User::find($id);

        return view('user.staff.edit', compact('user'));
    }

    public function editGuru($id)
    {
        $user = User::find($id);

        return view('user.guru.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStaff(Request $request, $id)
    {

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('user.staff')->with('error', 'Akun Tidak Ditemukan');
        }
        
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
        ]);

        $password = bcrypt($request->password) ;

        User::where('id', $id)->update
        ([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
        ]);

      
        return redirect()->route('user.staff')->with('success', 'Berhasil mengubah data user!');
    }

    public function updateGuru(Request $request, $id)
    {

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('user.guru')->with('error', 'Akun Tidak Ditemukan');
        }
        
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
        ]);

        $password = bcrypt($request->password) ;

        User::where('id', $id)->update
        ([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
        ]);

      
        return redirect()->route('user.guru')->with('success', 'Berhasil mengubah data user!');
    }

    public function destroyStaff($id)
    {

        User::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil Menghapus Data');
    }

    public function destroyGuru($id)
    {

        User::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil Menghapus Data');
    }

    public function searchStaff(Request $request)
    {
        $name = $request->input('search');
        $user = User::where('name', 'like', "%" . $name . "%")->simplePaginate(5);
        return view('user.staff.user', compact('user'));
    }

    public function searchGuru(Request $request)
    {
        $name = $request->input('search');
        $user = User::where('name', 'like', "%" . $name . "%")->simplePaginate(5);
        return view('user.staff.user', compact('user'));
    }
    

    
    public function authLogin(Request $request)
    {
        $request->validate([
            "email" => 'required|email:dns',
            "password" => "required",
        ]);

        $user = $request->only(['email', 'password']);

        if(Auth::attempt($user)){
            return redirect('/dashboard');
        }else {
            return redirect()->back()->with('failed', 'Login Gagal! Silahkan coba lagi');
        }
    }

    public function dashb() {
        $Staff = User::where('role', 'staff')->count();
        $Guru = User::where('role', 'guru')->count();
        
        return view('dashboard', compact('Staff', 'Guru'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    

}
