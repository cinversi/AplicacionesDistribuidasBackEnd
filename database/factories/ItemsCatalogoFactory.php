<?php

namespace Database\Factories;

use App\Models\ItemsCatalogo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class ItemsCatalogoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemsCatalogo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arrayBinario = ['si','no'];
        $random = Arr::random($arrayBinario);

        return [
            'precioBase' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
            'comision' => $this->faker->numberBetween($min = 1, $max = 15),
            //'subastado' => $this->faker->Arr::random($arrayBinario),
        ];
    }
}