<?php

use App\Exports\PaymentsExport;
use App\Exports\PenaltiesExport;
use App\Http\Controllers\Admin\PenaltyTypeController;
use App\Http\Controllers\Admin\RecycleBinController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Dashboard\Staff;
use App\Http\Controllers\Dashboard\User;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PenaltyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StaffReservationController;
use App\Http\Controllers\TimelogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;





Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [User::class, 'index'])
    ->middleware(['auth', 'role:user'])
    ->name('dashboard');

    Route::get('staff/dashboard', [Staff::class, 'index'])
    ->middleware(['auth',  'role:staff'])
    ->name('staff.dashboard');

Route::get('admin/dashboard', [Admin::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/userprofile', [UserProfileController::class, 'show'])->name('userprofile.show');
    Route::get('/userprofile/edit', [UserProfileController::class, 'edit'])->name('userprofile.edit');
    Route::patch('/userprofile', [UserProfileController::class, 'update'])->name('userprofile.update');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::get('roles/{role}/permissions', [RoleController::class, 'givePermissions'])->name('roles.give-permissions');
    Route::post('roles/{role}/permissions', [RoleController::class, 'storePermissions'])->name('roles.store-permissions');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/user/reservations', [ReservationController::class, 'index'])->name('user.reservations.index');
    Route::patch('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
});



Route::prefix('staff')->name('staff.')->middleware(['auth'])->group(function () {
    Route::resource('penalties', PenaltyController::class)->only(['index']);
});


Route::patch('/reservations/{reservation}/edit-pickup-date', [ReservationController::class, 'editPickupDate'])
    ->name('user.reservations.editPickupDate');


Route::get('user/book', [BookController::class, 'index'])->name('user.bookindex');


Route::get('/payments/export', function () {
    return Excel::download(new PaymentsExport, 'payment-records.xlsx');
})->name('payments.export');

Route::get('/penalties/export', function () {
    return Excel::download(new PenaltiesExport, 'penalty-records.xlsx');
})->name('penalties.export');

Route::post('/books/import', [BookController::class, 'import'])->name('books.import');
Route::get('timelog/export', [TimelogController::class, 'export'])->name('timelog.export');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('departments', DepartmentController::class);
});
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/staff.php';