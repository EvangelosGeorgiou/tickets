<?php

namespace EvanGeo\Ticket\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TicketsCommand extends Command
{
    public $signature = 'tickets:install';

    public $description = 'My command';

    public function handle(): int
    {
        Artisan::call('migrate');

        return self::SUCCESS;
    }
}
