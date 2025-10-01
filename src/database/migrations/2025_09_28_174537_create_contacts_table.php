<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_name');
            $table->tinyInteger('gender'); // 1: 男性, 2: 女性, 3: その他
            $table->string('email');
            $table->string('tel')->nullable();
            $table->string('address')->nullable();
            $table->string('building')->nullable(); // ← 最初から nullable
            $table->unsignedBigInteger('category_id');
            $table->text('detail');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};