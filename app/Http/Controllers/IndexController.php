<?php

namespace App\Http\Controllers;


use Illuminate\View\View;
use App\Models\Content;

class IndexController extends Controller
{
    public function index(): View
    {
        $contentList = Content::where('status', 99)->orderByDesc('publish_time')->paginate(parent::DefaultPageSize); //不需要->get()
        return view("frontend.index", ['contentList' => $contentList]);
    }
}
