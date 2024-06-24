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
        Schema::create('category', function (Blueprint $table) {
            $table->integer('cat_id', true);
            $table->string('cat_name', 100)->nullable();
            $table->string('description', 2000);
            $table->string('meta_keyword', 500)->nullable();
            $table->string('meta_description', 1000)->nullable();
            $table->text('cat_content')->nullable()->comment('栏目内容');
            $table->string('template', 50)->default('list')->comment('模板');
            $table->integer('parent_id')->nullable()->default(0);
            $table->string('parent_path', 5000)->nullable()->default(' ');
            $table->integer('list_order')->nullable()->default(0);
            $table->integer('status')->nullable()->default(2);
            $table->integer('article_count')->default(0)->comment('文章数');
            $table->bigInteger('create_time')->nullable()->default(0);
            $table->bigInteger('update_time')->default(0);
            $table->integer('model_id')->default(0);
            $table->string('cat_dir', 500)->nullable();
            $table->string('parent_dir', 500)->nullable()->default(' ');
            $table->string('cat_pic', 500)->nullable();
            $table->integer('is_show')->default(1)->comment('是否在菜单上显示');
            $table->integer('is_page')->default(0)->comment('只根据page.html模板生成页面。显示栏目时,不显示单网页栏目 ispage=0');
            $table->integer('is_on_list')->default(1)->comment('是否显示该栏目文章在文章列表');
            $table->integer('is_html')->default(1)->comment('是否生成静态页');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category');
    }
};
