<?php

namespace Database\Factories;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;

class CapituloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_capitulo'=>$this->faker->unique()->sentence(),
            'contenido'=>$this->faker->text(1999),
            'curso_id'=> Curso::all()->random()->id,//foreign keys
        ];
    }
}
