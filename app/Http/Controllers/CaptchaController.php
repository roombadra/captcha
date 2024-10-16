<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AntiSpam\Puzzle\PuzzleGenerator;

class CaptchaController extends Controller
{

    public function captcha(Request $request, PuzzleGenerator $puzzleGenerator): Response
    {
        return $puzzleGenerator->generate($request->query->get('challenge', ''));
    }
}
