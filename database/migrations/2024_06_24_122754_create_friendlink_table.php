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
        Schema::create('friendlink', function (Blueprint $table) {
            $table->increments('friendlink_id');
            $table->string('name');
            $table->string('url');
            $table->string('logo')->nullable();
            $table->string('description', 500)->nullable();
            $table->tinyInteger('status')->default(99);
            $table->bigInteger('input_time')->nullable();
            $table->bigInteger('update_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friendlink');
    }
};
