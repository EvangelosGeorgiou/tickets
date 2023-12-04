<?php

namespace EvanGeo\Ticket\Tests;

use EvanGeo\Ticket\TicketsServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use RefreshDatabase,
        WithFaker;

    protected function getPackageProviders($app): array
    {
        return [
            TicketsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');

        Artisan::call('migrate', [
            '--database' => 'testing',
            '--path' => '../../../../database/migrations',
        ]);
        //        (new CreateTicketsTable())->up();
        //        (new CreateTicketResponsesTable())->up();
        //        (new CreateTicketAttachmentsTable())->up();
        //        (new \CreateTicketCategoriesTable())->up();
        //        (new \CreateTicketInternalGroupTable())->up();
        //        (new \CreateTicketTagsTable())->up();
        //        (new \CreateTicketTagsPivotTable())->up();
    }
}
