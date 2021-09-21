<?php

namespace Database\Factories;

use App\Models\UserMembreship;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

class WalletFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wallet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_user_membreship' => UserMembreship::inRandomOrder()->first()->id,
            'amount' => $this->faker->randomFloat(2, 10, 1000),
        ]; 
    }
}
