<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminCategoryController extends Controller
{
    public function addEditCategory($catName = ''): View
    {
        $catName = urldecode($catName);
        $category = Category::where('status', 99)->where('cat_name', $catName)->firstOrNew();
        return View('admin.category.addEdit', ['category' => $category]);
    }

    public function addEditCategoryAction(Request $request,$catName=''): View
    {
        $formData = $request->all();
        //if(!$formData['cat_name']){
        if(empty($catName)){
            return $this->showMessagePage("目录名不能为空!",false);
        }
        $catId = intval($formData['cat_id']);
        $formData['description'] = $formData['description'] ?? '';
//dd($formData);
        $category = Category::where('status', 99)->where('cat_id', $catId)->firstOrNew();
        $category->fill($formData);//上面的firstOrNew可以防止$category为null
        $category->update_time = time();

        if (!$category->save()) {
            return $this->showMessagePage("保存失败", false);
        }
        return $this->showMessagePage("保存成功");
    }
}
