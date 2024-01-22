<?php

use App\Http\Controllers\DisasterController;
use App\Models\Disaster;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    $disasters = Disaster::where('status', 'approved')->get();
    return view('front.home', [
        'title' => 'Home | Sistem Informasi Bencana Alam Kota Depok',
        'disasters' => $disasters
    ]);
});

Route::resource('disaster', DisasterController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ==================== ADMIN ====================
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard', [
            'disasters' => Disaster::where('status', null)->get(),
            'title' => 'Dashboard | Sistem Informasi Bencana Alam Kota Depok'
        ]);
    });

    Route::get('/disaster/{disaster}/approve', [DisasterController::class, 'approve']);
    Route::get('/disaster/{disaster}/reject', [DisasterController::class, 'reject']);
});
