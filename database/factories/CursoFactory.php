<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_curso'=> $this->faker->unique()->sentence(),
            'profesor'=>$this->faker->name(),
            'sobre'=>$this->faker->text()
        ];
    }
}
