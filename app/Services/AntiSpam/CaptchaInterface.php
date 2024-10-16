<?php

namespace App\Services\AntiSpam;

interface CaptchaInterface
{
    public function generateKey(): string;

    public function veryify(string $key, string $answer): bool;

    public function getSolution(string $key): Mixed;
}