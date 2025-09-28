<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            // building カラムを NULL 許可に変更
            $table->string('building', 255)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            // 元に戻す（NOT NULL）
            $table->string('building', 255)->nullable(false)->change();
        });
    }
};