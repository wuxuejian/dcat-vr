<?php

use Wuxuejian\DcatVr\Http\Controllers;
use Illuminate\Support\Facades\Route;

//Route::get('dcat-vr', Controllers\DcatVrController::class.'@index');
Route::resource('dcat-vr/vrs',Controllers\DcatVrController::class);
Route::resource('dcat-vr/vrscenes',Controllers\VrSceneController::class);

