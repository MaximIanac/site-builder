<?php

use App\Http\Controllers\ControlPanel\Content\Modules\ModuleInstallerController;
use App\Http\Controllers\ControlPanel\Content\Modules\ModulesController;
use App\Http\Controllers\ControlPanel\Content\Pages\PageController;
use App\Http\Controllers\ControlPanel\Content\Pages\PanelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\ControlPanel\DashboardController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::name('cp.')->prefix('cp')->group(function () {
//    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');

//    Route::prefix('content')->name('content.')->group(function () {
//        Route::prefix('pages')->name('pages.')->group(function () {
//            Route::resource('/', PageController::class)->parameters(['' => 'page']);
//
//            Route::prefix('panel')->name('panel.')->group(function () {
//                Route::post('/add', [PanelController::class, 'add'])->name('add');
//                Route::post('/delete', [PanelController::class, 'delete'])->name('delete');
//            });
//        });

//        Route::prefix('modules')->name('modules.')->group(function () {
//            Route::resource('/', ModulesController::class)->parameters(['' => 'module']);

//            Route::put('/install/{module}', [ModuleInstallerController::class, 'install'])->name('install');
//        });
//    });
});


require __DIR__.'/auth.php';
