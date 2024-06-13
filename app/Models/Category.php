<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'cat_id';

    //更新而不修改更新时间，如添加访问量

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    // 覆盖模型的日期格式方法，不使用任何格式化
    public function getDateFormat()
    {
        return 'U'; // U 代表 Unix 时间戳
    }

    // 确保模型将时间戳作为整数存储和检索
    protected $casts = [
        'created_at' => 'integer',
        'updated_at' => 'integer',
    ];

    protected $fillable = [
        'cat_id',
        'cat_name',
        'description',
        'meta_keyword',
        'meta_description',
        'cat_content',
        'template',
        'parent_id',
        'parent_path',
        'list_order',
        'status',
        'article_count',
        //'create_time',
        //'update_time',
        'model_id',
        'cat_dir',
        'parent_dir',
        'cat_pic',
        'is_show',
        'is_page',
        'is_on_list',
        'is_html',
    ];

}
