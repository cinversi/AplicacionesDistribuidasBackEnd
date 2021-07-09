<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arrayBinario = ['si','no'];
        $random = Arr::random($arrayBinario);

        $arrayBinario = ['si','no'];
        $random = Arr::random($arrayBinario);

        $arrayCategoria = ['comun','especial','plata','oro','platino'];
        $random = Arr::random($arrayCategoria);

        return [
            'numeroPais' => $this->faker->countryCode(),
            //'admitido' => Arr::random($arrayBinario),
            //'categoria'=> Arr::random($arrayCategoria),            
        ];
    }
}