<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LatesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RayonsController;
use App\Http\Controllers\RombelsController;
use App\Http\Controllers\StudentsController;

/*
|--------------------------------------------------------------------------
| Web Routes`
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/error-permission', function(){
    return view('errors.permission');
})->name('error.permission');

Route::get('/', function () {
    return view('login');
})->name('login');
Route::post('/login', [UsersController::class, 'loginAuth'])->name('login.auth');

Route::middleware('IsLogin')-> group(function() {
    Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
    Route::get('/home', function () {
        return view('home');
    })->name('home');
});


Route::get('home', [StudentsController::class, 'count'])->name('home');

Route::prefix('/rombel')->name('rombel.')->group(function () {
    Route::get('/index', [RombelsController::class, 'index'])->name('index');
    Route::get('/create', [RombelsController::class, 'create'])->name('create');
    Route::post('/store', [RombelsController::class, 'store'])->name('store');
    Route::get('/{id}', [RombelsController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [RombelsController::class, 'update'])->name('update');
    Route::delete('/{id}', [RombelsController::class, 'destroy'])->name('delete');
});

Route::prefix('/user')->name('user.')->group(function () {
    Route::get('/index', [UsersController::class, 'index'])->name('index');
    Route::get('/create', [UsersController::class, 'create'])->name('create');
    Route::post('/store', [UsersController::class, 'store'])->name('store');
    Route::get('/{id}', [UsersController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [UsersController::class, 'update'])->name('update');
    Route::delete('/{id}', [UsersController::class, 'destroy'])->name('destroy');
});
Route::prefix('/rayon')->name('rayon.')->group(function () {
    Route::get('/index', [RayonsController::class, 'index'])->name('index');
    Route::get('/create', [RayonsController::class, 'create'])->name('create');
    Route::post('/store', [RayonsController::class, 'store'])->name('store');
    Route::get('/{id}', [RayonsController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [RayonsController::class, 'update'])->name('update');
    Route::delete('/{id}', [RayonsController::class, 'destroy'])->name('destroy');
});

Route::prefix('/student')->name('student.')->group(function () {
    Route::get('/index', [StudentsController::class, 'index'])->name('index');
    Route::get('/create', [StudentsController::class, 'create'])->name('create');
    Route::post('/store', [StudentsController::class, 'store'])->name('store');
    Route::get('/{id}', [StudentsController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [StudentsController::class, 'update'])->name('update');
    Route::delete('/{id}', [StudentsController::class, 'destroy'])->name('destroy');
});

Route::prefix('/keter')->name('keter.')->group(function () {
    Route::get('/data', [LatesController::class, 'data'])->name('data');
    Route::get('/export-excel', [LatesController::class, 'exportExcel'])->name('export-excel');
});

Route::prefix('/lates')->name('lates.')->group(function () {
    Route::get('/index', [LatesController::class, 'index'])->name('index');
    Route::get('/show', [LatesController::class, 'show'])->name('show');
    Route::get('/create', [LatesController::class, 'create'])->name('create');
    Route::get('/download/{id}', [LatesController::class, 'downloadPDF'])->name('download');
    Route::get('/detail/{id}', [LatesController::class, 'lihat'])->name('lihat');
    Route::get('/export-excel', [LatesController::class, 'exportExcel'])->name('export-excel');
    Route::post('/store', [LatesController::class, 'store'])->name('store');
    Route::get('/{id}', [LatesController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [LatesController::class, 'update'])->name('update');
    Route::delete('/{id}', [LatesController::class, 'destroy'])->name('destroy');
});


Route::middleware(['IsLogin', 'IsPs'])->group(function () {
    Route::prefix('/ps')->name('ps')->group(function () {
        Route::get('/home', function () {
            return view('errors.permission');
        });
    });
});


