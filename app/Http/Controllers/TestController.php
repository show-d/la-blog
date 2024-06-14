<?php

namespace App\Http\Controllers;

use App\Models\Content;

class TestController extends Controller
{

    private Content $_content;
    //依赖注入的方式
    public function __construct(protected Content $content)
    {
        $this->_content = $this->content;
    }

    public function index(): string
    {
        $ij = $this->_content->firstOrNew();//通过依赖注入的方式调用

        $facade = Content::firstOrNew();//通过外观模式方式调用
        dd($ij,$facade);
        return "hi";
    }

    public function index2(Content $content2): string
    {
        $ij = $content2->firstOrNew();//通过依赖注入的方式调用
        echo $ij::class;

        dd($ij);

    }
}
