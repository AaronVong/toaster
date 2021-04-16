<?php

namespace Database\Factories;

use App\Models\Toast;
use Illuminate\Database\Eloquent\Factories\Factory;

class ToastFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Toast::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->sentence(15),
        ];
    }
}
