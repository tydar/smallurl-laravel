<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VisitFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ip' => fake()->ipv4(),
        ];	
    }
}

?>
