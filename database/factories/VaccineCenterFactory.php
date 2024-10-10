<?php

namespace Database\Factories;

use App\Models\VaccineCenter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VaccineCenter>
 */
class VaccineCenterFactory extends Factory
{
    protected $model = VaccineCenter::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'center_name'=>$this->faker->company(),
            'center_limit'=>$this->faker->randomNumber(2)
        ];
    }
}
