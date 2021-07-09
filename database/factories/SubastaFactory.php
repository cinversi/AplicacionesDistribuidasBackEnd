<?php

namespace Database\Factories;

use App\Models\Subasta;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class SubastaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subasta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arrayEstado = ['abierta','cerrada'];
        $random = Arr::random($arrayEstado);

        $arrayBinario = ['si','no'];
        $random = Arr::random($arrayBinario);

        $arrayCategoria = ['comun','especial','plata','oro','platino'];
        $random = Arr::random($arrayCategoria);

        return [
            'ubicacion' => $this->faker->streetAddress(),
            'fecha' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'horaInicio' => $this->faker->time($format = 'H:i:s', $max = 'now'),
            'horaFin' => $this->faker->time($format = 'H:i:s', $max = 'now'),
            //'estado' => Arr::random($arrayEstado),
            'capacidadAsistentes'=> $this->faker->numberBetween($min = 5, $max = 30),
            //'tieneDeposito'=> Arr::random($arrayBinario),
            //'seguridadPropia'=> Arr::random($arrayBinario),
            //'categoria'=> Arr::random($arrayCategoria),
        ];
    }
}