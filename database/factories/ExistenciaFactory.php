<?php

namespace Database\Factories;

use App\Models\Existencia;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExistenciaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Existencia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'inventario_id' => $this->faker->randomDigitNotNull,
        'tipodoc' => $this->faker->word,
        'documento' => $this->faker->word,
        'deposito_id' => $this->faker->randomDigitNotNull,
        'tiposalida' => $this->faker->word,
        'documento_sal' => $this->faker->word,
        'fecha_desde' => $this->faker->word,
        'fecha_hasta' => $this->faker->word,
        'user_name' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
