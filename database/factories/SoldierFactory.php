<?php

namespace Database\Factories;
use App\Models\Army_corp;
use App\Models\Quater;
use App\Models\Company;
use App\Models\Soldier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\soldier>
 */
class SoldierFactory extends Factory
{
    protected $model = Soldier::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'grado' => $this->faker->numberBetween(1, 6),
            'army_corp_id' => Army_corp::inRandomOrder()->first()->id ?? null,
            'quarter_id' => Quater::inRandomOrder()->first()->id ?? null,
            'company_id' => Company::inRandomOrder()->first()->id ?? null,
        ];
    }
}
