<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('member', function (Blueprint $table) {
            $table->mediumIncrements('user_id');
            $table->string('user_name', 20);
            $table->string('password', 200);
            $table->string('solt', 20)->default('121117')->comment('随机因子');
            $table->string('email', 40);
            $table->unsignedTinyInteger('group_id')->default(0)->comment('1:普通；99：管理员');
            $table->unsignedSmallInteger('point')->default(0);
            $table->unsignedTinyInteger('model_id')->default(0);
            $table->unsignedTinyInteger('disabled')->default(0);
            $table->integer('create_time')->default(0)->comment('创建时间');
            $table->integer('last_login_time')->default(0)->comment('上次登录时间');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member');
    }
};
