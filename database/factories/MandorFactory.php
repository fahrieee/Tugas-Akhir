<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mandor>
 */
class MandorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pengawas_id' => fake()->randomElement(User::where('akses', 'pengawas')
                ->pluck('id')->toArray()),
            'pengawas_status' => 'ok',
            'nama' => fake()->name(),
            'kategori' => fake()->randomElement(['General Contractor', 'Microtunneling Contractor']),
            'periode' => fake()->randomElement(['2020', '2021', '2022', '2023', '2024', '2025']),
            'user_id' => 1,
            'hutang_id' => fake()->randomElement(['8', '7', '16']),
        ];
    }
}
