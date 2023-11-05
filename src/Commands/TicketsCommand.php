<?php

namespace EvanGeo\Ticket\Commands;

use Illuminate\Console\Command;

class TicketsCommand extends Command
{
    public $signature = 'tickets';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
