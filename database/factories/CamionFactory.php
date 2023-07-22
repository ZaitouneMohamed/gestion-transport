<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Camion>
 */
class CamionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "matricule" => $this->faker->bothify('Hello ##?###'),
            "marque" => $this->faker->word(),
            "numchassis" => $this->faker->randomNumber($nbDigits = NULL, $strict = false),
            "consommation" => $this->faker->randomDigit()
        ];
    }
}
