<?php

namespace App\Http\Controllers;
use Gregwar\Captcha\CaptchaBuilder;

class CaptchaController extends Controller
{
    public function generateCaptcha()
    {
        $builder = new CaptchaBuilder();
        $builder->build();

        $lowercaseCaptcha = strtolower($builder->getPhrase());
        session()->put('captcha', $lowercaseCaptcha);

        return response($builder->output())->header('Content-type', 'image/jpeg');
    }
}

