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
            ->hasMigrations('0001_0001_create_tickets_table',
                '0001_0002_create_ticket_response_table',
                '0001_0003_create_ticket_attachments_table',
                '0001_0004_create_ticket_categories_table',
                '0001_0005_create_ticket_internal_groups_table',
                '0001_0006_create_ticket_tags_table',
                '0001_0007_create_ticket_tags_pivot_table'
            )
            ->hasCommand(TicketsCommand::class);
    }
}
