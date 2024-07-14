<?php

use App\Http\Controllers\Api\V1\EntityController;
use Illuminate\Support\Facades\Route;

Route::get('entities', [EntityController::class, 'index'])->name('entities.index');
