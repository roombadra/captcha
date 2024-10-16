<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AntiSpam\CaptchaInterface;
use App\Services\AntiSpam\Puzzle\PuzzleCaptcha;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CaptchaInterface::class, PuzzleCaptcha::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
