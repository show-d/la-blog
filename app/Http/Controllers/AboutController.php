<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\View\View;
use App\Models\Content;

class AboutController extends Controller
{
    public function about(): View
    {
        $about = Category::where('cat_name', 'about')->first();
        return view("frontend.about", ['about' => $about]);
    }
}
