<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

// arahkan dashboard utama sesuai Role
Route::get('/dashboard', function(Request $request){
    $role = $request->user()->role;
    if ($role === 'admin') return redirect()->route('admin.dashboard');
    if ($role === 'mentor') return redirect()->route('mentor.dashboard');
    return view('dashboard'); // dashboard untuk peserta
})->middleware(['auth', 'verified'])->name('dashboard');


// grup route untuk admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function(){
    //dashboard admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Manajemen User (CRUD)
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('users/create', [UserController::class, 'create'])->name('user.create');
    Route::get('users', [UserController::class, 'store'])->name('user.store');
    Route::get('users/{user}edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{user', [UserController::class, 'updat'])->name('user.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// grup route untuk mentor
Route::middleware(['auth', 'role:mentor'])->prefix('mentor')->namae('mentor.')->group(function(){
    Route::gett('/dashboard', function (){
        return view('mentor.dashboard');
    })->name('dashboard');
});
