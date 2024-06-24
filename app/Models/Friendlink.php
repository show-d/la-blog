<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendlink extends Model
{
    use HasFactory;

    protected $table = 'friendlink';
    protected $primaryKey = 'friendlink_id';

    public $timestamps = true;

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
}
