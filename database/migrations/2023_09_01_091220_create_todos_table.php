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
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->boolean('done')->default(false)->comment('status');
            $table->integer('priority')->default(1)->comment('priority (1-5)');
            $table->string('title')->default('заголовок задачі')->comment('заголовок задачі');
            $table->dateTime('createdAt')->default(now())->comment('дата створення');
            $table->dateTime('completedAt')->nullable()->comment('дата завершення');
            $table->unsignedBigInteger('subtask')->nullable()->comment('подзадача');
            $table->unsignedBigInteger('user_id')->comment('master');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
