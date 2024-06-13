<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Comment;

class CommentController extends Controller
{
    public function addEditCommentAction(Request $request)
    {
        $userCaptcha = strtolower(request()->input('captchaCode'));
        $generatedCaptcha = session()->get('captcha');
        if ($userCaptcha !== $generatedCaptcha) {
            return response()->json([
                'code' => -1,
                'message' => '验证码不正确',
                'data' => $generatedCaptcha
            ]);
        }

        $operateTipStr = '评论编辑';
        $formData = $request->all();

        // 验证数据 需要 CommentRequest 验证类
        /*        $validated = $request->validate([
                    'comment_id' => 'nullable|integer',
                    // 添加其他字段的验证规则
                ]);*/

        // 获取或创建 Comment 实例
        $commentId = 0;//intval($formData['comment_id']); TODO 暂设为0
        $comment = Comment::firstOrNew(['comment_id' => $commentId]);
        $comment->fill($formData);

        $comment->comment_id = $commentId;
        if (!$comment->exists) {
            $comment->input_time = time();
            $operateTipStr = '评论添加';
        }
        $comment->update_time = time();


        // 保存内容
        if (!$comment->save()) {
            return response()->json([
                'code' => -1,
                'message' => $operateTipStr . '失败',
                'data' => ''
            ]);
        }

        //添加评论数
        $content = Content::find($comment->content_id);
        if (!$content->hits) {
            $content->hits = 1;
        } else {
            $content->hits += 1;
        }


        return response()->json([
            'code' => 0,
            'message' => $operateTipStr . '成功',
            'data' => $comment->comment,
        ]);

    }
}
