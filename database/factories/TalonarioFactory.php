<?php

namespace Database\Factories;

use App\Models\Talonario;
use Illuminate\Database\Eloquent\Factories\Factory;

class TalonarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Talonario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tipo' => $this->faker->word,
        'ptoventa' => $this->faker->word,
        'proximodoc' => $this->faker->word,
        'fechavto' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
