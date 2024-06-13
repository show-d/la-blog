<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Content;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;

class ContentController extends Controller
{

    public function detail(string $htmlName = ''): View
    {
        if (trim($htmlName) == '') {
            return parent::showMessagePage("页面不存在！",false);
        }

        $content = Content::where('html_name', $htmlName)->first();
        if (empty($content)) {
            return parent::showMessagePage("无数据！",false);
        }

        $category = Category::firstOrNew(['cat_id' => $content->cat_id]);
        $commentList = Comment::where('content_id', $content->content_id)
            ->where('status', 99)
            ->orderByDesc('input_time')->get();
        return view("frontend.content", [
            "content" => $content,
            "category" => $category,
            "commentList" => $commentList
        ]);
    }

    public function addHitAction(Request $request): JsonResponse //int $contentId = 0
    {
        $contentId = $request->input('contentId')[0];//post表单的值
        $content = Content::find($contentId);
        if(!$content){
            return response()->json([
                'code' => -1,
                'message' => '!$article',
                'data' => $contentId
            ]);
        }

        if (!$content->hits) {
            $content->hits = 1;
        } else {
            $content->hits += 1;
        }

        if (!$content->save()) {
            return response()->json([
                'code' => -1,
                'message' => 'failed',
                'data' => ''
            ]);
        }

        return response()->json([
            'code' => 0,
            'message' => 'successful',
            'data' => ''
        ]);
    }
}
