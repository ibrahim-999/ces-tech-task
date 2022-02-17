<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\User;



class CompanyFactory extends Factory
{

    protected $model = Company::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'user_id' => User::get()->random()->id,
            'image' => $this->faker->image('public/storage/images',400,300, null, false) 
        ];
    }
}
