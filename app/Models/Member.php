<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Member extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'member';
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public $timestamps = true;

    const CREATED_AT = 'create_time';
    const UPDATED_AT = null;

    // 覆盖模型的日期格式方法，不使用任何格式化
    public function getDateFormat()
    {
        return 'U'; // U 代表 Unix 时间戳
    }

    // 确保模型将时间戳作为整数存储和检索
    protected $casts = [
        'create_time' => 'integer',
        //'updated_at' => 'integer',
    ];
}
