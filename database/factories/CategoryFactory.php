<?php

namespace EvanGeo\Ticket\Database\Factories;

use EvanGeo\Ticket\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(1),
            'entity' => config('ticket.entities')[0],
            'enabled' => 1,
        ];
    }
}
