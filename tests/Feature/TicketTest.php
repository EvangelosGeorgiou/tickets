<?php

namespace EvanGeo\Ticket\Tests\Feature;

use EvanGeo\Ticket\Enums\Priority;
use EvanGeo\Ticket\Enums\ResponseMessageType;
use EvanGeo\Ticket\Enums\Status;
use EvanGeo\Ticket\Models\TicketAttachment;
use EvanGeo\Ticket\Models\TicketCategory;
use EvanGeo\Ticket\Models\TicketInternalGroup;
use EvanGeo\Ticket\Models\Tags;
use EvanGeo\Ticket\Models\Ticket;
use EvanGeo\Ticket\Models\TicketTags;
use EvanGeo\Ticket\Repository\TicketAttachmentRepository;
use EvanGeo\Ticket\Tests\TestCase;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;

class TicketTest extends TestCase
{
    /**
     * @throws BindingResolutionException
     */
    public function test_ticket()
    {
        $ticket = ticket()->createAsUser(1, [
            'subject' => $this->faker->sentence(3),
            'entity' => 'client',
            'entity_id' => 123,
        ]);

        $entityTicket = \ticket()->createAsEntity('client', [
            'subject' => $this->faker->sentence(3),
            'entity' => 'client',
            'entity_id' => 123,
        ]);

        $this->assertDatabaseHas(Ticket::class, ['id' => $ticket->id]);
        $this->assertDatabaseHas(Ticket::class, ['id' => $entityTicket->id]);

        $this->assertNotEmpty(\ticket()->getById($ticket->id));
        $this->assertTrue($ticket->open()->status == Status::OPEN->value);
        $this->assertTrue($ticket->closed()->status == Status::CLOSED->value);
        $this->assertTrue($ticket->reOpen()->status == Status::REOPEN->value);
        $this->assertTrue($ticket->archived()->status == Status::ARCHIVED->value);
        $this->assertTrue($ticket->priorityLow()->priority == Priority::LOW->value);
        $this->assertTrue($ticket->priorityNormal()->priority == Priority::NORMAL->value);
        $this->assertTrue($ticket->priorityHigh()->priority == Priority::HIGH->value);
    }

    /**
     * @throws BindingResolutionException
     */
    public function test_ticket_responses()
    {
        $response = \ticket()->createAsUser(1, [
            'subject' => $this->faker->sentence(3),
            'entity' => 'client',
            'entity_id' => 123,
        ])->replyAsUser(1, ['message' => $this->faker->sentence]);

        $this->assertEquals(ResponseMessageType::EXTERNAL, $response->markAsExternalMessage()->type);
        $this->assertEquals(ResponseMessageType::INTERNAL, $response->markAsInternalMessage()->type);

        Storage::fake(config('ticket.attachments.upload_disk'));

        $uploads = [File::fake()->image('dummy.jpeg'), File::fake()->image('dummy2.jpeg')];
        $attachments = [
            [
                'name' => 'dummy.jpeg',
                'mime' => 'jpeg',
            ],
            [
                'name' => 'dummy2.jpeg',
                'mime' => 'jpeg',
            ],
        ];

        $response->attachDocuments($attachments, function (TicketAttachmentRepository $attachment) use ($uploads) {
            $attachment->upload($uploads, $this->faker->filePath());
        });

        $this->assertDatabaseCount(TicketAttachment::class, 2);

    }

    /**
     * @throws BindingResolutionException
     */
    public function test_ticket_tags()
    {
        $tags = Tags::factory()->count(3)->create();

        $ticket = \ticket()->createAsUser(1, [
            'subject' => $this->faker->sentence(3),
            'entity' => 'client',
            'entity_id' => 123,
        ])->attachTags($tags->pluck('id')->toArray());

        $this->assertDatabaseCount(TicketTags::class, 3);

        $ticket->detachTags($tags->random(2)->pluck('id')->toArray());

        $this->assertDatabaseCount(TicketTags::class, 1);

        $ticket->syncTags($tags->random(1)->pluck('id')->toArray());

        $this->assertDatabaseCount(TicketTags::class, 1);

    }

    /**
     * @throws BindingResolutionException
     */
    public function test_ticket_internal_group()
    {
        $ticket = \ticket()->createAsUser(1, [
            'subject' => $this->faker->sentence(3),
            'entity' => 'client',
            'entity_id' => 123,
        ]);

        $this->assertNull($ticket->internal_group_id);

        $internalGroup = TicketInternalGroup::factory()->create();

        $ticket->setInternalGroup($internalGroup->getKey());

        $this->assertEquals($internalGroup->getKey(), $ticket->internal_group_id);

        $ticket->setInternalGroup($internalGroup->getKey());

        $ticket->setInternalGroup();

        $this->assertNull($ticket->internal_group_id);
    }

    /**
     * @throws BindingResolutionException
     */
    public function test_ticket_category()
    {
        $category = TicketCategory::factory()->create();

        $ticket = \ticket()->createAsUser(1, [
            'subject' => $this->faker->sentence(3),
            'entity' => 'client',
            'entity_id' => 123,
        ])->setCategory($category->getKey());

        $this->assertEquals($category->getKey(), $ticket->category_id);

        $this->assertNull($ticket->removeCategory()->category_id);
    }
}
