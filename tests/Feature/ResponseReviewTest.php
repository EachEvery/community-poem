<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ResponseReviewTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     */
    public function testResponseReviewPageCanBeViewed()
    {

        $space = factory('CommunityPoem\\Space')->create();
        $routeData = ['space' => $space->slug];

        /**
         * Test non-signed routes won't do it, chief 😩.
         */
        $badResponse = $this->get(route('approveResponses', $routeData));
        $badResponse->assertStatus(403);

        $signedRoute = URL::signedRoute('approveResponses', $routeData);



        $response = $this->get($signedRoute);
        $response->assertStatus(200);
        $response->assertViewHas('responses', $space->unapproved_responses()->get());
    }

    public function testResponsesCanBeApproved()
    {
        $space = factory('CommunityPoem\\Space')->create();

        $displayResponse = factory('CommunityPoem\\Response')->create([
            'space_id' => $space->id,
        ]);

        $this->assertTrue(null === $space->approved_responses()->find($displayResponse->id));

        $route = route('markResponseApproved', [
            'space' => $space->slug,
            'repsonse' => $displayResponse->id,
        ]);

        /**
         * split on new line and take a random
         * number of lines.
         */
        $editedContent = collect(explode("\n", $displayResponse->content))
            ->take(3)->implode("\n");

        $res = $this->withoutMiddleware()->post($route, [
            'response' => [
                'content' => $editedContent,
                'font_size' => '3rem',
            ],
        ]);

        $res->assertSuccessful();

        $this->assertTrue(filled($displayResponse->fresh()->approved_at));

        $this->assertDatabaseHas('responses', [
            'id' => $displayResponse->id,
            'content' => $editedContent,
            'font_size' => '3rem',
        ]);

        $this->assertNotTrue(null === $space->approved_responses()->find($displayResponse->id));
    }

    public function testResponsesCanBeDiscarded()
    {
        $space = factory('CommunityPoem\\Space')->create();

        $displayResponse = factory('CommunityPoem\\Response')->create([
            'space_id' => $space->id,
        ]);

        $this->delete(route('discardResponse', [
            'space' => $space->slug,
            'response' => $displayResponse->id,
        ]));

        $this->assertDatabaseMissing('responses', [
            'id' => $displayResponse->id,
        ]);
    }
}
