<?php

use Alijumaan\LaravelPermissionEditor\Http\Controllers\RoleController;
use Alijumaan\LaravelPermissionEditor\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);
