<?php

namespace Database\Factories;

use App\Models\RecibosLineas;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecibosLineasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RecibosLineas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'recibo_id' => $this->faker->randomDigitNotNull,
        'tipopieza_id' => $this->faker->randomDigitNotNull,
        'cantidad' => $this->faker->randomDigitNotNull,
        'preciounit' => $this->faker->word,
        'importe' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
