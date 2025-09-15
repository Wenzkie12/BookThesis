<?php


use App\Http\Controllers\BookController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PenaltyController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StaffReservationController;
use App\Http\Controllers\TimelogController;
use Illuminate\Support\Facades\Route;









Route::middleware(['auth'])->group(function () {
    Route::get('/timelog', function () {
        return view('timelog.scanner');
    })->name('timelog.scanner');

  Route::get('/timelog', [TimelogController::class, 'index'])->name('timelog.index');

   
Route::post('/scan/time-in', [TimelogController::class, 'timeIn'])->name('scan.timein');
Route::post('/scan/time-out', [TimelogController::class, 'timeOut'])->name('scan.timeout');
Route::view('/timelog/scanner', 'timelog.scanner')->name('timelog.scanner');


});

Route::middleware(['auth', 'role:staff'])->prefix('staff/reservations')->name('staff.reservations.')->group(function () {
    Route::get('/', [StaffReservationController::class, 'index'])->name('index');
    Route::patch('{reservation}/claim', [StaffReservationController::class, 'claim'])->name('claim');
    Route::patch('{reservation}/complete', [StaffReservationController::class, 'complete'])->name('complete');
    Route::patch('{reservation}/lost', [StaffReservationController::class, 'markLost'])->name('lost');
});

Route::patch('/reservations/{reservation}/declare-lost', [ReservationController::class, 'declareLost'])
    ->name('user.reservations.declareLost')
    ->middleware('auth');


Route::patch('/staff/reservations/{reservation}/accept-lost', [StaffReservationController::class, 'acceptLost'])
    ->name('staff.reservations.acceptLost')
    ->middleware('can:manage reservations');

Route::patch('/staff/reservations/{reservation}/deny-lost', [StaffReservationController::class, 'denyLost'])
    ->name('staff.reservations.denyLost')
    ->middleware('can:manage reservations');

    Route::get('/staff/penalties/users', [PenaltyController::class, 'usersWithPenalties'])->name('staff.penalties.users');

Route::post('/payments/{profile}', [PaymentController::class, 'store'])->name('payments.store');

Route::get('/staff/payments/users', [PaymentController::class, 'index'])->name('staff.payments.users');

Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');

