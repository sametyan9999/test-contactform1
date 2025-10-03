<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ContactFactory extends Factory
{
    public function definition()
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id ?? 1,

            // 固定値で作成（全部同じ内容）
            'first_name'  => '太郎',
            'last_name'   => '山田',
            'gender'      => 1, // 男性
            'email'       => 'test@example.com',
            'tel'         => '08012345678',
            'address'     => '東京都渋谷区千駄ヶ谷1-2-3',
            'building'    => '千駄ヶ谷マンション101',
            'detail'      => '届いた商品が注文した商品ではありませんでした。商品の交換をお願いします。',
        ];
    }
}