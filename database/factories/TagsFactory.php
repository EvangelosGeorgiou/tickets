<?php

namespace EvanGeo\Ticket\Database\Factories;

use EvanGeo\Ticket\Models\Tags;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagsFactory extends Factory
{
    protected $model = Tags::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(1),
            'entity' => config('ticket.entities')[0],
            'enabled' => true,
        ];
    }
}
