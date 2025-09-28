<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ContactsTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('contacts')->insert([
                'category_id' => rand(1, 3), // categories テーブルの id
                'first_name' => Str::random(5),
                'last_name' => Str::random(7),
                'gender' => rand(1, 3), // 1:男性 2:女性 3:その他
                'email' => Str::random(5) . '@example.com',
                'tel' => '090' . rand(10000000, 99999999),
                'address' => '東京都' . rand(1, 23) . '区',
                'building' => 'ビル' . rand(1, 100),
                'detail' => Str::random(50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}