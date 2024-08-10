<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::apiResource('rooms', RoomController::class);
Route::apiResource('guests', GuestController::class);

Route::post('rooms/{room}/set-as-ready', [RoomController::class, 'setAsReady']);
Route::post('rooms/{room}/assign', [RoomController::class, 'assignRoom']);
Route::post('rooms/{room}/deassign', [RoomController::class, 'deassignRoom']);
