<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
					'name' => $this->faker->name(),
					'email' => $this->faker->unique()->safeEmail(),
					'date_of_birth' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
					'cpf' =>  $this->faker->cpf,
					'telephone' => $this->faker->cellphoneNumber
        ];
    }
}
