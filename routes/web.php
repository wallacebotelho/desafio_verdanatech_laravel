<?php


use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/tickets/assign/{ticket}', [TicketController::class, 'assign'])->name('tickets.assign');
Route::post('/tickets/response/{ticket}', [TicketController::class, 'respond'])->name('tickets.response');

Route::resource('tickets', TicketController::class);
