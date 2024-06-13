<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    protected $primaryKey = 'comment_id';

    const CREATED_AT = 'input_time';
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
        'comment_id',
        'content_id',
        'user_id',
        'user_name',
        'email',
        'site_url',
        'comment',
        'user_ip',
        'address',
        'status',
        'input_time',
        'update_time',
    ];
}
