<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContentRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Content;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class AdminContentController extends Controller
{
    public function addEdit(int $contentId = 0): View
    {
        $cc = Content::first();
        $cc->title = 'aaa';
        $fresh = $cc->fresh();

        var_dump($cc->title, $fresh->title); //aaa ,oracle
        echo '<hr/>';

        $cc = Content::first();
        $cc->title = 'aaa';
        $refresh = $cc->refresh();

        var_dump($cc->title,$refresh);

        $content = Content::where('content_id', $contentId)->firstOrNew();
        $catList = Category::where(['status' => 99, 'is_page' => 0])->get();
        return View('admin.content.addEdit', [
            'content' => $content,
            'catList' => $catList
        ]);
    }

    public function addEditAction(ContentRequest $request): View
    {
        $operateTipStr = '编辑';
        $formData = $request->all();

        $validated = $request->validate([
            'content_id' => 'nullable|integer',
            // 添加其他字段的验证规则
        ]);

        // 获取或创建 Content 实例
        $contentId = intval($formData['content_id']);
        $content = Content::firstOrNew(['content_id' => $contentId]);

        // 设置 input_time 仅在创建时
        if (!$content->exists) {
            $content->input_time = time();
            $content->publish_time = time();
            $operateTipStr = '添加';
        }

        // 设置 update_time
        $content->update_time = time();

        // 填充数据
        $content->fill($formData);


        // 保存内容
        if (!$content->save()) {
            $message = $operateTipStr . '失败';
            return parent::showMessagePage($message);
        }

        //统计栏目文章数量
        $cnt = Content::where('status', 99)->where('cat_id', $formData['cat_id'])->count();
        Category::where('cat_id', $formData['cat_id'])->update(['article_count' => $cnt]);

        $message = $operateTipStr . '成功';
        return parent::showMessagePage($message, url: '/');
    }

    function deleteContentAction(Request $request): View
    {
        /*        $obj = Content::where('content_id',$contentId)->update(['status',-1]);
                if($obj){
                    $obj = Comment::where('content_id',$contentId)->update(['status',-1]);
                }*/
        $contentId = $request->input('content_id');
        if ($contentId <= 0) {
            return parent::showMessagePage("删除失败，参数不正确。", false);
        }

        try {
            $dbPre = env('DB_PREFIX', '');
            DB::transaction(function () use ($dbPre, $contentId) {
                DB::update("update ${$dbPre}content set status = -1 where content_id=?", [$contentId]);

                DB::delete("update ${$dbPre}comment set status = -1 where content_id=?", [$contentId]);
            });

            return parent::showMessagePage("删除成功", true, '/');

        } catch (\Exception $ex) {
            return parent::showMessagePage("删除失败" . $ex->getMessage(), false);
        }
    }
}
