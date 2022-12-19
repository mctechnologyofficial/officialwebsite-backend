<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\PortofolioController;
use App\Http\Controllers\Leader\ProjectController as LeaderProjectController;

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
    Route::prefix('admin')->group(function(){

        // Member Routes
        Route::controller(MemberController::class)->group(function(){
            Route::get('/member', 'index')->name('admin.member.index');
            Route::get('/member/create', 'create')->name('admin.member.create');
            Route::post('/member/store', 'store')->name('admin.member.store');
            Route::get('/member/{id}/edit', 'edit')->name('admin.member.edit');
            Route::put('/member/{id}/update', 'update')->name('admin.member.update');
            Route::delete('/member/{id}/destroy', 'destroy')->name('admin.member.destroy');
        });

        // Team Routes
        Route::controller(TeamController::class)->group(function(){
            Route::get('/team', 'index')->name('admin.team.index');
            Route::get('/team/create', 'create')->name('admin.team.create');
            Route::post('/team/store', 'store')->name('admin.team.store');
            Route::get('/team/{id}/edit', 'edit')->name('admin.team.edit');
            Route::put('/team/{id}/update', 'update')->name('admin.team.update');
            Route::delete('/team/{id}/destroy', 'destroy')->name('admin.team.destroy');
        });

        // Project Routes
        Route::controller(ProjectController::class)->group(function(){
            Route::get('/project', 'index')->name('admin.project.index');
            Route::get('/project/create', 'create')->name('admin.project.create');
            Route::post('/project/store', 'store')->name('admin.project.store');
            Route::get('/project/edit/{id}', 'edit')->name('admin.project.edit');
            Route::put('/project/update/{id}', 'update')->name('admin.project.update');
            Route::delete('/project/destroy/{id}', 'destroy')->name('admin.project.destroy');
            Route::get('/project/getuser', 'getUser');
        });

        // Portfolio
        Route::controller(PortofolioController::class)->group(function(){
            Route::get('/portfolio', 'index')->name('admin.portofolio.index');
            Route::get('/portfolio/create', 'create')->name('admin.portofolio.create');
            Route::post('/portfolio/store', 'store')->name('admin.portfolio.store');
        });
    });
});

Route::group(['middleware' => ['role:leader developer']], function(){
    Route::prefix('leader')->group(function(){
        // Project Routes
        Route::controller(LeaderProjectController::class)->group(function(){
            Route::get('/project', 'index')->name('leader.project.index');
            Route::get('/project/create', 'create')->name('leader.project.create');
            Route::post('/project/store', 'store')->name('leader.project.store');
            Route::get('/project/edit/{id}', 'edit')->name('leader.project.edit');
            Route::put('/project/update/{id}', 'update')->name('leader.project.update');
            Route::delete('/project/destroy/{id}', 'destroy')->name('leader.project.destroy');
        });
    });
});

require __DIR__.'/auth.php';
