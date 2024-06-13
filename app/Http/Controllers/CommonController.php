<?php

namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Overtrue\Pinyin\Pinyin;

class CommonController extends Controller
{
    public function convertToPinyin(Request $request): JsonResponse
    {
        $text = $request->input('text');
        $pinyin = new Pinyin();
        $pinyinText = $pinyin->sentence($text, 'null');

        return response()->Json([
            "code" => 0,
            "message" => '',
            "data" => $pinyinText,
        ]);

    }

    public function uploadFileAction(Request $request): JsonResponse
    {
        if (!$request->hasFile('file')) {
            return response()->json([
                "errno" => -1,
                "data" => [
                    "url" => '',
                    "alt" => '',
                ]
            ]);
        }

        $path = public_path('uploads');
        $fileName = time().'.'.$request->file->extension();
        $request->file->move($path, $fileName);

        //$file = $request->input('file');
        return response()->json([
            "errno" => 0,
            "data" => [
                "url" => "/uploads/$fileName",
                "alt" => $fileName,
            ]
        ]);

    }
}
