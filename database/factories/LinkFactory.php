<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LinkFactory extends Factory
{
    public function definition(): array
    {
        return [
            'url' => fake()->url(),
            'shortcode' => Str::random(10),
        ];	
    }
}

?>
