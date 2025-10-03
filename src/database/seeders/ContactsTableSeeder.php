<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsTableSeeder extends Seeder
{
    public function run()
    {
        // 既存データ削除
        DB::table('contacts')->truncate();

        // 固定データを35件挿入
        for ($i = 0; $i < 35; $i++) {
            DB::table('contacts')->insert([
                'category_id' => 1, // 「商品のお届けについて」
                'first_name'  => '太郎',
                'last_name'   => '山田',
                'gender'      => 1, // 男性
                'email'       => 'test@example.com',
                'tel'         => '08012345678',
                'address'     => '東京都渋谷区千駄ヶ谷1-2-3',
                'building'    => '千駄ヶ谷マンション101',
                'detail'      => '届いた商品が注文した商品ではありませんでした。商品の交換をお願いします。',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}