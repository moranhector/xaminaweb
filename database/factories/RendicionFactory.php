<?php

namespace Database\Factories;

use App\Models\Rendicion;
use Illuminate\Database\Eloquent\Factories\Factory;

class RendicionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rendicion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cheque_id' => $this->faker->randomDigitNotNull,
        'inventario_id' => $this->faker->randomDigitNotNull,
        'recibo_id' => $this->faker->randomDigitNotNull,
        'importe' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
