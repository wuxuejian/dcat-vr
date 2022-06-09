<?php

use Wuxuejian\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('dcat-vr', Controllers\DcatVrController::class.'@index');