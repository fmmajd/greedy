<?php

namespace Database\Factories;

use App\Models\ProductionRequirement;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductionRequirementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductionRequirement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->numberBetween(),
        ];
    }
}
