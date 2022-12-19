<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
});
// force logout routes, temporary for debugging
Route::get('/force/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
});

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/{id}/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/updatepassword', [ProfileController::class, 'updatepassword'])->name('profile.updatepassword');
    Route::post('/updateimage', [ProfileController::class, 'updateimage'])->name('profile.updateimage');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['role:admin']], function(){

    // Member Routes
    Route::controller(MemberController::class)->group(function(){
        Route::prefix('member')->group(function(){
            Route::get('/', 'index')->name('admin.member.index');
            Route::get('/create', 'create')->name('admin.member.create');
            Route::post('/store', 'store')->name('admin.member.store');
            Route::get('/{id}/edit', 'edit')->name('admin.member.edit');
            Route::put('/{id}/update', 'update')->name('admin.member.update');
            Route::delete('/{id}/destroy', 'destroy')->name('admin.member.destroy');
        });
    });

    // Team Routes
    Route::controller(TeamController::class)->group(function(){
        Route::prefix('team')->group(function(){
            Route::get('/', 'index')->name('admin.team.index');
            Route::get('/create', 'create')->name('admin.team.create');
            Route::post('/store', 'store')->name('admin.team.store');
            Route::get('/edit/{id}', 'edit')->name('admin.team.edit');
            Route::put('/update/{id}', 'update')->name('admin.team.update');
            Route::delete('/destroy/{id}', 'destroy')->name('admin.team.destroy');
        });
    });

    // Project Routes
    Route::controller(ProjectController::class)->group(function(){
        Route::prefix('project')->group(function(){
            Route::get('/', 'index')->name('admin.project.index');
            Route::get('/create', 'create')->name('admin.project.create');
            Route::post('/store', 'store')->name('admin.project.store');
            Route::get('/edit/{id}', 'edit')->name('admin.project.edit');
            Route::put('/update/{id}', 'update')->name('admin.project.update');
            Route::delete('/destroy/{id}', 'destroy')->name('admin.project.destroy');
            Route::get('/getuser', 'getUser');
        });
    });
});



require __DIR__.'/auth.php';
