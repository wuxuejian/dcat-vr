<?php

use Wuxuejian\DcatVr\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('vr', Controllers\Frontend\VrController::class.'@index');
