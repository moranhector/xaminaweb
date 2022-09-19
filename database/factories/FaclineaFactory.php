<?php

namespace Database\Factories;

use App\Models\Faclinea;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaclineaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Faclinea::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'factura_id' => $this->faker->randomDigitNotNull,
        'inventario_id' => $this->faker->randomDigitNotNull,
        'cantidad' => $this->faker->randomDigitNotNull,
        'preciounit' => $this->faker->word,
        'importe' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
