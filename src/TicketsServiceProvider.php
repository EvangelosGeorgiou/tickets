<?php

namespace EvanGeo\Ticket;

use EvanGeo\Ticket\Commands\TicketsCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TicketsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('tickets')
            ->hasConfigFile('ticket')
            ->hasViews()
            ->hasMigration('create_tickets_table')
            ->hasCommand(TicketsCommand::class);
    }
}
