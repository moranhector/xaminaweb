<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
        'ivacond' => $this->faker->word,
        'domicilio' => $this->faker->word,
        'telefono' => $this->faker->word,
        'email' => $this->faker->word,
        'tipodoc' => $this->faker->word,
        'documento' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'user_name' => $this->faker->word
        ];
    }
}
