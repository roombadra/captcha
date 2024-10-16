<?php

use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/contact', [HomeController::class, 'store'])->name('contact');

Route::get('/captcha/{captcha}', [CaptchaController::class, 'captcha'])->name('captcha');
