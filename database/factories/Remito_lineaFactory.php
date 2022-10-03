<?php

namespace Database\Factories;

use App\Models\Remito_linea;
use Illuminate\Database\Eloquent\Factories\Factory;

class Remito_lineaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Remito_linea::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'remito_id' => $this->faker->randomDigitNotNull,
        'inventario_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
