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
        Schema::create('content', function (Blueprint $table) {
            $table->bigIncrements('content_id');
            $table->string('title', 200)->nullable()->default(' ');
            $table->string('keyword', 100)->nullable()->default(' ');
            $table->string('description', 500)->nullable()->default(' ');
            $table->text('content')->nullable();
            $table->string('thumb', 200)->nullable()->default(' ');
            $table->string('copy_from', 50)->nullable()->default(' ');
            $table->string('send_from', 50)->nullable()->default('')->comment('发送自');
            $table->integer('hits')->nullable()->default(0);
            $table->integer('comment_count')->nullable()->default(0);
            $table->integer('cat_id')->default(0)->index('catid');
            $table->integer('user_id')->nullable()->default(0)->comment('编辑id');
            $table->string('author', 20)->nullable()->default(' ')->comment('文章作者');
            $table->string('pos_ids', 100)->nullable()->default(' ')->comment('推荐位id串');
            $table->string('url', 200)->nullable()->default(' ');
            $table->integer('is_redirect')->nullable()->default(0);
            $table->string('template', 200)->nullable()->default(' ');
            $table->string('html_name', 200)->nullable()->default(' ')->comment('静态页面名称');
            $table->integer('status')->nullable()->default(99)->comment('状态 99:通过,1:待审,-1:删除');
            $table->integer('list_order')->nullable()->default(0)->index('listorder')->comment('排序');
            $table->bigInteger('input_time')->nullable()->default(0);
            $table->bigInteger('update_time')->nullable()->default(0);
            $table->bigInteger('publish_time')->nullable()->default(0)->comment('发布时间');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content');
    }
};
