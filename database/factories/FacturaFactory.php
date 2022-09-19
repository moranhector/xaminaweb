<?php

namespace Database\Factories;

use App\Models\Factura;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacturaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Factura::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'formulario' => $this->faker->word,
        'ptovta' => $this->faker->word,
        'tipo' => $this->faker->word,
        'fecha' => $this->faker->word,
        'cliente_id' => $this->faker->randomDigitNotNull,
        'total' => $this->faker->word,
        'ivacond' => $this->faker->word,
        'domicilio' => $this->faker->word,
        'telefono' => $this->faker->word,
        'email' => $this->faker->word,
        'tipodoc' => $this->faker->word,
        'documento' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
