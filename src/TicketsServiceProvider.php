<?php

namespace EvanGeo\Ticket;

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
            ->hasMigrations('0001_create_tickets_table',
                '0002_create_ticket_response_table',
                '0003_create_ticket_attachments_table',
                '0004_create_ticket_categories_table',
                '0005_create_ticket_internal_group_table',
                '0006_create_ticket_tags_table',
                '0007_create_ticket_tags_pivot_table'
            );
    }
}
