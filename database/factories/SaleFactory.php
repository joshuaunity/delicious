<?php

namespace Database\Factories;

use App\Helpers\ExtraFunc as ExtraFunc;
use App\Models\Sale;
use App\Models\Dish;

use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Sale::class;

    public function definition()
    {
        $token = ExtraFunc::gentoken(20);
        return [
            'did' => $this->faker->catchPhrase(),
            'sid' => $model->id,
            'cid' => $category,
            'gender' => $this->faker->text(),
            'sale_token' => $token,
            'status' => 1,
        ];
    }
}
