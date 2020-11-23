<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('admin')->group(function (){
    Route::resource("user", UserController::class);
});
