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
            'first_name'  => $this->faker->firstName,
            'last_name'   => $this->faker->lastName,
            'gender'      => $this->faker->numberBetween(1, 3),
            'email'       => $this->faker->unique()->safeEmail,
            'tel'         => $this->faker->phoneNumber,
            'address'     => $this->faker->address,
            'building'    => $this->faker->secondaryAddress,
            'detail'      => $this->faker->text(50),
        ];
    }
}