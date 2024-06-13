<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Content;
use App\Models\Category;
use App\Models\Comment;

class CategoryController extends Controller
{
    public function list(): View
    {
        $categoryList = Category::where(['is_page' => 0, 'status' => 99])->orderBy('list_order')->get();
        return view("frontend.category", [
            "categoryList" => $categoryList,
        ]);
    }

    public function listFilter($catName=''): View
    {
        $subQuery = Category::select('cat_id')->where('cat_name',$catName)->limit(1);
        $contentList = Content::where('status', 99)
            ->where('cat_id',$subQuery)
            ->paginate(parent::DefaultPageSize);

        return view("frontend.index", ['contentList' => $contentList]);
    }
}
