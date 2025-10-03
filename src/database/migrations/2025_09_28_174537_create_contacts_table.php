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
            $table->string('last_name');   // 姓
            $table->string('first_name');  // 名
            $table->tinyInteger('gender'); // 1: 男性, 2: 女性, 3: その他
            $table->string('email', 255);       // メールアドレス
            $table->string('tel', 15);       // 電話番号（必須に変更）
            $table->string('address')->nullable();   // 住所（任意）
            $table->string('building')->nullable();  // 建物名（任意）
            $table->unsignedBigInteger('category_id'); // カテゴリID
            $table->text('detail');        // お問い合わせ内容
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};