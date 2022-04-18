<?php

namespace CommunityPoem\Repositories;

use Carbon\Carbon;
use CommunityPoem\Events\ResponseApproved;
use CommunityPoem\Events\ResponseDeleted;
use CommunityPoem\Events\ResponseSaved;
use CommunityPoem\Response;
use CommunityPoem\Space;
use Illuminate\Events\Dispatcher;

class Responses
{
    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function addToSpace($fillable, $space)
    {
        return tap($space->responses()->create($fillable), function ($response) {
            $this->dispatcher->dispatch(new ResponseSaved($response));
        });
    }

    public function approve($response, $fillable = [])
    {
        return tap($response, function ($response) use ($fillable) {
            $response->update(array_merge(
                ['approved_at' => Carbon::now()],
                $fillable
            ));

            if ($response->fresh()->is_approved) {
                $this->dispatcher->dispatch(new ResponseApproved($response));
            }
        });
    }

    public function approved(Space $space = null)
    {
        return filled($space) ?
            $space->approved_responses()->get() : Response::whereNotNull('approved_at')->get();
    }

    public function approvedForSlideshow(Space $space = null)
    {
        return $space->approved_responses_for_slideshow->isEmpty() ? null : $space->approved_responses_for_slideshow()->get();
    }

    public function displayOnSlideshow($response)
    {
        $response->update(['display_on_slideshow' => 1]);
        return $response;
    }

    public function removeFromSlideshow($response)
    {
        $response->update(['display_on_slideshow' => 0]);
        return $response;
    }

    public function forSpace(Space $space)
    {
        return $space->responses()->get();
    }

    public function approvedForSpace(Space $space, $limit = null, $offset = 0, $lang = 'en')
    {
        $q = $space->approved_responses()->latest();

        if ($limit != null) {
            $q->limit($limit);
        }
        
        return $q->offset($offset)->get();

    }

    public function delete($response)
    {
        $response->delete();

        $this->dispatcher->dispatch(new ResponseDeleted($response));
    }

    public function findOrFail($id)
    {
        return Response::findOrFail($id);
    }
}
