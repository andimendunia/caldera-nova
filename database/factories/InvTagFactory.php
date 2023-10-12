<?php

namespace Database\Factories;

use App\Models\InvArea;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvLoc>
 */
class InvTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $x = InvArea::all()->pluck('id')->toArray();
        return [
            'name' => fake()->unique()->name(),
            'inv_area_id' => $x[array_rand($x)]
        ];
    }
}
