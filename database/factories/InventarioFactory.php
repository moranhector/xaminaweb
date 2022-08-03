<?php

namespace Database\Factories;

use App\Models\Inventario;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Inventario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo12' => $this->faker->word,
        'tipopieza_id' => $this->faker->randomDigitNotNull,
        'npieza' => $this->faker->word,
        'namepieza' => $this->faker->word,
        'comprob' => $this->faker->word,
        'recibo_id' => $this->faker->word,
        'factura' => $this->faker->word,
        'factura_id' => $this->faker->word,
        'costo' => $this->faker->word,
        'recargo' => $this->faker->word,
        'artesano_id' => $this->faker->randomDigitNotNull,
        'comprado_at' => $this->faker->word,
        'vendido_at' => $this->faker->word,
        'precio' => $this->faker->word,
        'precio_at' => $this->faker->word,
        'foto' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
