<?php

namespace EvanGeo\Ticket\Database\Factories;

use EvanGeo\Ticket\Models\TicketInternalGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class InternalGroupFactory extends Factory
{
    protected $model = TicketInternalGroup::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(1),
            'entity' => config('ticket.entities')[0],
            'enabled' => 1,
        ];
    }
}
