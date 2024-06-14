<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected const DefaultPageSize = 5;

    public function showMessagePage($message = '无消息', $success = true, $url = "", $seconds = 3): View
    {
        //return redirect()->route('common.message')->with('success', $message);
        return View('common.message', [
            'message' => $message,
            'success' => $success,
            'url' => $url,
            'seconds' => $seconds,
        ]);

    }
}
