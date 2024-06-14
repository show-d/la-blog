<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Content;

class TagsController extends Controller
{
    public function index(): View
    {
        $tagList = [];
        $keywordsList = Content::where(['status' => 99])->pluck('keyword');
        foreach ($keywordsList as $keywords) {
            $arr = explode(",", $keywords);

            foreach ($arr as $kw) {
                $kw = trim($kw);
                if (empty($kw))
                    continue;

                if (array_key_exists($kw, $tagList)) {
                    $v = intval($tagList[$kw]);
                    $tagList[$kw] = $v + 1;
                } else {
                    $tagList[$kw] = 1;
                }
            }
        }
        return view("frontend.tags", [
            "tagList" => $tagList,
        ]);
    }

    public function list($tagName = ''): View
    {
        $contentList = Content::where('status', 99)
            ->where('keyword', 'like', "%{$tagName}%")
            ->orderByDesc('input_time')
            ->paginate(parent::DefaultPageSize);

        return view("frontend.index", ['contentList' => $contentList]);
    }
}
