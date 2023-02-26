<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
