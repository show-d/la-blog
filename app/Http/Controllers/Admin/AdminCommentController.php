<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminCommentController extends Controller
{

    public function deleteCommentAction(Request $request): JsonResponse
    {
        $contentId = $request->input('content_id');
        $commentId = $request->input('comment_id');

        $rowsAffected = Comment::where('content_id', $contentId)
            ->where('comment_id', $commentId)
            ->update(['status' => -1]);

        if ($rowsAffected > 0) {
             return response()->json([
                'code'=>0,
                'message' => '删除成功！',
                'data'=>'',
            ]);

        }

        return response()->json([
            'code'=>-1,
            'message' => '删除失败！',
            'data'=>'',
        ]);

    }
}
