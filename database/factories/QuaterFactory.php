<?php

namespace Database\Factories;

use App\Models\Quater;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\quater>
 */
class QuaterFactory extends Factory
{

    protected $model = Quater::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->bothify('Cuartel ###'),
            'ubicacion' => $this->faker->randomElement(['Bloque A', 'Bloque B', 'Bloque C', 'Edificio Principal', 'Laboratorios']),
        ];
    }
}
