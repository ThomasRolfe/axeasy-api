<?php

namespace Database\Factories;

use App\Models\Scholarship;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScholarshipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Scholarship::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'label' => $this->faker->name,
            'start_date' => $this->faker->date,
            'monthly_slp_target' => $this->faker->numberBetween(1000, 5000),
            'scholar_split' => ($this->faker->numberBetween(0, 100) / 100),
            'encoded_id' => base_convert($this->faker->numberBetween(100, 10000), 10, 32)
        ];
    }
}
