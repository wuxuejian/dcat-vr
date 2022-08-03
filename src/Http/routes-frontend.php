<?php

use Wuxuejian\DcatVr\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Wuxuejian\DcatVr\Http\Controllers\Frontend\VrController;

Route::apiResource('vrs',VrController::class);
