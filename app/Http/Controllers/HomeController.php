<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AntiSpam\CaptchaInterface;

class HomeController extends Controller
{
    public function index(CaptchaInterface $captchaInterface)
    {
        return view('index', [
            'challenge' => $captchaInterface->generateKey()
        ]);
    }

    public function store(Request $request, CaptchaInterface $captcha)
    {
        $key = $captcha->generateKey();
        $solution = $captcha->getSolution($key);

        dd($captcha->veryify($key, implode('-', $solution)));
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
    }
}
