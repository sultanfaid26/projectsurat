<?php

use App\Http\Controllers\LetterTypesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LettersController;
use App\Http\Controllers\TrixController;
use App\Models\Letter;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('IsGuest')->group(function(){
    Route::get('/', function(){
        return view('login');
    })->name('login');
    
    Route::post('/login', [UserController::class, 'authLogin'])->name('auth-login');
    
});
    
    
Route::middleware('IsLogin')->group(function(){
    Route::get('/logout', [UserController::class, 'logout'])->name('auth-logout');
        Route::get('/dashboard', function () {
            return view('dashboard');
        });
    });

    Route::middleware('IsGuru')->group(function(){
        Route::prefix('guru/datasurat')->name('guru.datasurat.')->group(function(){
            Route::get('/dataguru', [LettersController::class, 'index2'])->name('data');
            Route::get('/createguru', [LettersController::class, 'createData2'])->name('createData');
            Route::post('/storeguru', [LettersController::class, 'storeData2'])->name('store');
            Route::get('/editsuratguru/{id}', [LettersController::class, 'edit2'])->name('edit');
            Route::patch('/updatesuratguru/{id}', [LettersController::class, 'update2'])->name('update');
            Route::delete('/deletedataguru/{id}', [LettersController::class, 'destroy2'])->name('delete');
            Route::get('/searchdataguru', [LettersController::class, 'searchData2'])->name('searchData');
            Route::get('/download-excel/guru', [LettersController::class, 'downloadExcel2'])->name('download-excel');
        });
    });

    Route::middleware('IsTu')->group(function(){
    Route::prefix('/user')->name('user.')->group (function(){
        Route::get('/staff', [UserController::class, 'staff'])->name('staff');
        Route::get('/guru', [UserController::class, 'guru'])->name('guru');
        Route::get('/create/staff', [UserController::class, 'createStaff'])->name('createStaff');
        Route::get('/create/guru', [UserController::class, 'createGuru'])->name('createGuru');
        Route::post('/storestaff', [UserController::class, 'storeStaff'])->name('storeStaff');
        Route::post('/storeguru', [UserController::class, 'storeGuru'])->name('storeGuru');
        Route::get('/editstaff/{id}', [UserController::class, 'editStaff'])->name('editStaff');
        Route::get('/editguru/{id}', [UserController::class, 'editGuru'])->name('editGuru');
        Route::patch('/updatestaff/{id}', [UserController::class, 'updateStaff'])->name('updateStaff');
        Route::patch('/updateguru/{id}', [UserController::class, 'updateGuru'])->name('updateGuru');
        Route::delete('/deletestaff/{id}', [UserController::class, 'destroyStaff'])->name('deleteStaff');
        Route::delete('/deleteguru/{id}', [UserController::class, 'destroyGuru'])->name('deleteGuru');
        Route::get('/searchstaff', [UserController::class, 'searchStaff'])->name('searchStaff');
        Route::get('/searchguru', [UserController::class, 'searchGuru'])->name('searchGuru');
    });
    
    Route::prefix('/klasifikasi')->name('klasifikasi.')->group(function(){
        Route::get('/data', [LetterTypesController::class, 'index'])->name('data');
        Route::get('/create/klasifikasi', [LetterTypesController::class, 'createData'])->name('createData');
        Route::post('/storedata', [LetterTypesController::class, 'storeData'])->name('storeData');
        Route::get('/editKlasifikasi/{id}', [LetterTypesController::class, 'editKlasifikasi'])->name('editKlasifikasi');
        Route::patch('/updateKlasifikasi/{id}', [LetterTypesController::class, 'updateData'])->name('updateData');
        Route::get('/searchdata', [LetterTypesController::class, 'searchData'])->name('searchData');
        Route::get('/lihat/{letter_code}', [LetterTypesController::class, 'show'])->name('lihat');
        Route::delete('/deletedata/{id}', [LetterTypesController::class, 'destroy'])->name('deleteData');
        Route::get('/download-excel', [LetterTypesController::class, 'downloadExcel'])->name('download-excel');
    });

    Route::prefix('/datasurat')->name('datasurat.')->group(function(){
        Route::get('/data', [LettersController::class, 'index'])->name('data');
        Route::get('/create', [LettersController::class, 'createData'])->name('createData');
        Route::post('/store', [LettersController::class, 'storeData'])->name('store');
        Route::get('/editsurat/{id}', [LettersController::class, 'edit'])->name('edit');
        Route::patch('/updatesurat/{id}', [LettersController::class, 'update'])->name('update');
        Route::delete('/deletedata/{id}', [LettersController::class, 'destroy'])->name('delete');
        Route::get('/searchdata', [LettersController::class, 'searchData'])->name('searchData');
        Route::get('/download-excel', [LettersController::class, 'downloadExcel'])->name('download-excel');
    });
});