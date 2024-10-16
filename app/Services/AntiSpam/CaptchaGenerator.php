<?php

namespace App\Services\AntiSpam;

use Illuminate\Http\Response;

interface CaptchaGenerator
{
    public function generate(string $key): Response;
}