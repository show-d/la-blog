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
        Schema::create('comment', function (Blueprint $table) {
            $table->bigIncrements('comment_id');
            $table->bigInteger('content_id')->default(0)->index('contentid');
            $table->bigInteger('user_id')->nullable()->default(0);
            $table->string('user_name', 50);
            $table->string('email', 50)->nullable();
            $table->string('site_url')->nullable();
            $table->string('comment', 8000)->nullable();
            $table->string('user_ip', 64)->nullable()->default('0.0.0.0');
            $table->string('address')->nullable();
            $table->smallInteger('status')->default(99)->comment('状态 99:通过,1:待审,-1:删除');
            $table->bigInteger('input_time')->nullable()->default(0);
            $table->bigInteger('update_time')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment');
    }
};
