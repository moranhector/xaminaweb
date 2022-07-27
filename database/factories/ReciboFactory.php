<?php

namespace Database\Factories;

use App\Models\Recibo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReciboFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recibo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'formulario' => $this->faker->word,
        'fecha' => $this->faker->word,
        'artesano_id' => $this->faker->randomDigitNotNull,
        'total' => $this->faker->word,
        'cheque_id' => $this->faker->randomDigitNotNull,
        'rendido' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
