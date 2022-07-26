<?php

namespace Database\Factories;

use App\Models\Tipopieza;
use Illuminate\Database\Eloquent\Factories\Factory;

class TipopiezaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tipopieza::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'descrip' => $this->faker->word,
        'tecnica' => $this->faker->word,
        'rubro_id' => $this->faker->randomDigitNotNull,
        'precio' => $this->faker->word,
        'insumo' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
