<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class CustomerFactory extends Factory
{
    public function definition()
    {
        return [
            'Email' => fake()->unique()->safeEmail(),
            'Password' => Hash::make('password123'),
            'FullName' => fake()->name(),
            'Phone' => fake()->phoneNumber(),
            'Address' => fake()->address(),
            'RegDate' => fake()->dateTimeBetween('-1 year', 'now'),
            
            'is_admin' => 0,
            'google_id' => null,
        ];
    }
}