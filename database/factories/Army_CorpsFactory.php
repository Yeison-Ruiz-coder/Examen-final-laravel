<?php

namespace Database\Factories;
use App\Models\Army_corp;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Army_corp>
 */
class Army_CorpFactory extends Factory
{

    protected $model = Army_corp::class;

    public function definition(): array
    {
        return [
            'denominacion' => $this->faker->bothify('Denominacion ###'),
        ];
    }
}
