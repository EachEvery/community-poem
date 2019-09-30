<?php

namespace CommunityPoem\Repositories;

use CommunityPoem\Events\ResponseSaved;
use CommunityPoem\Events\ResponseApproved;
use Illuminate\Events\Dispatcher;
use CommunityPoem\Events\ResponseDeleted;
use Carbon\Carbon;
use CommunityPoem\Space;
use CommunityPoem\Response;

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

            $this->dispatcher->dispatch(new ResponseApproved($response));
        });
    }

    public function approved(Space $space = null)
    {
        return filled($space) ?
            $space->approved_responses()->get() : Response::whereNotNull('approved_at')->get();
    }

    public function forSpace(Space $space)
    {
        return $space->responses()->get();
    }

    public function approvedForSpace(Space $space)
    {
        return $space->approved_responses()->latest()->get();
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
