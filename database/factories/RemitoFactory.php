<?php

namespace Database\Factories;

use App\Models\Remito;
use Illuminate\Database\Eloquent\Factories\Factory;

class RemitoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Remito::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'descrip' => $this->faker->word,
        'fecha' => $this->faker->word,
        'deposito_id_from' => $this->faker->randomDigitNotNull,
        'deposito_id_to' => $this->faker->randomDigitNotNull,
        'user_name' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
