<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\dasboardController;
use App\Http\Controllers\DocumentArchivesController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});


require __DIR__.'/auth.php';

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/imageAdd', [ProfileController::class, 'addAvatar'])->name('profile.imageAdd');
});


Route::controller(SocialController::class)->group(function(){

    Route::get('auth/{provider}/redirect', 'redirect')->name('auth.socialiste.redirect');
    Route::get('auth/{provider}/callback', 'Callback')->name('auth.socialiste.callback');

})->middleware(['auth', 'verified']);


Route::middleware(['auth','verified'])->group(function () {

    Route::get('/dashboard', dasboardController::class)->name('dashboard');

    Route::get('documents/export/', [DocumentController::class, 'export'])->name('documents.export');
    Route::post('documents/softdelete/', [DocumentController::class, 'softDelete'])->name('documents.softdelete');
    Route::post('documents/forcedelete/', [DocumentController::class, 'forceDelete'])->name('documents.forcedelete');
    Route::resource('/documents',DocumentController::class)->middleware(['auth'])->except(['destroy']);

    Route::post('documents/attachments/delete',[AttachmentController::class,'delete'])->name('attachments.delete');
    Route::get('documents/attachments/view',[AttachmentController::class,'view'])->name('attachments.view');
    Route::post('documents/attachments/download',[AttachmentController::class,'download'])->name('attachments.download');
    Route::post('documents/attachments/modify',[AttachmentController::class,'modify'])->name('attachments.modify');
    Route::resource('documents/attachments',AttachmentController::class)->except(['index',"show",'create','edit','update','destroy']);

    Route::get('documents/archives/index', [DocumentArchivesController::class , 'index'])->name('archives.index');
    Route::post('documents/archives/restore', [DocumentArchivesController::class , 'restore'])->name('archives.restore');
    Route::post('documents/archives/delete', [DocumentArchivesController::class , 'delete'])->name('archives.delete');

    Route::get('/documents/reports/search', [ReportsController::class , 'search'])->name('reports.search');
    Route::get('documents/reports/show', [ReportsController::class , 'index'])->name('reports.index');
    Route::post('documents/reports/filter', [ReportsController::class , 'filter'])->name('reports.filter');

    Route::resource('/sections', SectionController::class)->except(['create','show','edit']);

    Route::post('users/changeStatus', [UserController::class, 'changeStatus'])->name('users.changeStatus');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);

    Route::get('clients', [ClientController::class, 'index'])->name('clients.index');
    Route::post('clients/store', [ClientController::class, 'store'])->name('clients.store');
    Route::put('clients/update', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('clients/destroy', [ClientController::class, 'destroy'])->name('clients.destroy');
});



Route::get('/{page}', [AdminController::class, 'index']);
