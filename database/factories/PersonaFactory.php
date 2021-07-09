<?php

namespace Database\Factories;

use App\Models\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class PersonaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Persona::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arrayEstado = ['abierta','cerrada'];
        //$random = Arr::random($arrayEstado);

        return [
            'documento' => $this->faker->randomNumber($nbDigits = NULL, $strict = false),
            'nombre' => $this->faker->name(),
            'direccion' => $this->faker->streetAddress(),
            //'estado' => $this->faker->randomElement(['abierta','cerrada']),
            //'estado' = $faker->randomElement($array = array('abierta','cerrada'));
            //'estado' => Arr::random($arrayEstado),
            'foto' => $this->faker->imageUrl($width = 640, $height = 480)
        ];
    }
}