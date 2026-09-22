<?php

use App\Http\Controllers\EncouragementController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EncouragementController::class, 'index'])->name('encouragement.index');
