<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Content extends Model
{

    protected $table = 'content';
    protected $primaryKey = 'content_id';

    /*
        public $incrementing = false;//默认主键自增，如不自增，设为false
        protected $keyType = 'string';//默认主键整型，如是字符串，设为string
        public $timestamps = false; //false 不自动接管 created_at and updated_at

        //时间自定列，不使用默认的 created_at and updated_at
        const CREATED_AT = 'creation_date';
        const UPDATED_AT = 'updated_date';

       //更新而不修改更新时间，如添加访问量
       Model::withoutTimestamps(fn () => $post->increment(['reads']));

        //使用uuid做主键，插入新数据时会自动生成主键
        use Illuminate\Database\Eloquent\Concerns\HasUuids;
        use HasUuids; //trait

        //指定model使用特定的驱动
        protected $connection = 'mysql';

       //设置默认字段值
        protected $attributes = [
        'options' => '[]',
        'delayed' => false,
    ];
    */

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

    protected $fillable = [
        'content_id',
        'title',
        'keyword',
        'description',
        'content',
        'thumb',
        'copy_from',
        'send_from',
        'hits',
        'comment_count',
        'cat_id',
        'user_id',
        'author',
        'pos_ids',
        'url',
        'is_redirect',
        'template',
        'html_name',
        'status',
        'list_order',
        'input_time',
        'update_time',
        'publish_time',
    ];

/*    protected $fillable;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fillable = $this->getFillableFields();
    }

    protected function getFillableFields(): array
    {
        return $this->getFillable();
    }*/
}
