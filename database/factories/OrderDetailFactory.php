<?php

namespace Database\Factories;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id'              =>  rand(1, 10),
            'product_name'          =>  $this->faker->text(100),
            'product_description'   =>  $this->faker->text(100),
            'product_image'         =>  $this->faker->imageUrl(),
            'price'                 =>  $this->faker->numberBetween(10, 100),
            'quantity'              =>  $this->faker->numberBetween(1, 5),
        ];
    }
}
