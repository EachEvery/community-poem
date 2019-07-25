<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Fixtures\TypeformWebhookFixture;
use Display\Space;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TypeformWebhookTest extends TestCase
{
    use DatabaseMigrations;

    public function test()
    {
        $typeform = TypeformWebhookFixture::get();

        $response = $this->post('/webhook', $typeform);
        $response->assertNotFound();

        /**
         * Create space to collect responses from given form id.
         */
        $space = factory(Space::class)->create([
            'typeform_id' => $typeform['form_response']['form_id'],
        ]);

        $response = $this->post('/webhook', $typeform);

        $response->assertSuccessful();

        $this->assertDatabaseHas('responses', [
            'typeform_id' => $typeform['event_id'],
            'space_id' => $space->id,
        ]);
    }
}
