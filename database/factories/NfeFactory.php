<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nfe>
 */
class NfeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero' => fake()->randomNumber(9, true),
            'valor' => fake()->randomFloat(2),
            'data_emissao' => fake()->date(),
            'cnpj_remetente' => function () {
                return fake()->randomNumber(2, true) . "." . fake()->randomNumber(3, true) . "." . fake()->randomNumber(3, true) . "/0001-" . fake()->randomNumber(2, true);
            },
            'nome_remetente' => fake()->name(),
            'cnpj_transportador' => function () {
                return fake()->randomNumber(2, true) . "." . fake()->randomNumber(3, true) . "." . fake()->randomNumber(3, true) . "/0001-" . fake()->randomNumber(2, true);
            },
            'nome_transportador' => fake()->name(),
            'user_id' => function () {
                return User::factory()->create()->id;
            }
        ];
    }

    public function setUserOwner(User $user) {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id
        ]);
    }
}
