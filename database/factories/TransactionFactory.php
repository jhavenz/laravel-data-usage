<?php

namespace Database\Factories;

use App\Models\Enums\Operation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // $1 to $100
            'amount' => collect([(string) rand(1, 100), rand(1, 99)])->implode(function ($value, $key) {
                if ($key === 1 && strlen($value) === 1) {
                    $value = '0'.$value;
                }
                return $value;
            }, '.'),
            'operation' => Arr::random(Operation::cases())
        ];
    }
}
