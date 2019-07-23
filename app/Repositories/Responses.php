<?php

namespace Display\Repositories;

use Display\Events\ResponseSaved;
use Display\Events\ResponseApproved;
use Illuminate\Events\Dispatcher;
use Display\Events\ResponseDeleted;
use Carbon\Carbon;
use Display\Space;
use Display\Response;

class Resposnes
{
    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function addToSpace($fillable, $space)
    {
        return tap($space->responses()->save($fillable), function ($response) {
            $this->dispatcher->dispach(new ResponseSaved($response));
        });
    }

    public function approve($response)
    {
        return tap($response, function ($response) {
            $response->update(['approved_at' => Carbon::now()]);
            $this->dispatcher->dispatch(new ResponseApproved($response));
        });
    }

    public function approved(Space $space = null)
    {
        return filled($space) ?
            $space->approved_responses()->get() :
            Response::whereNotNull('approved_at')->get();
    }

    public function delete($response)
    {
        $response->delete();

        $this->dispatcher->dispatch(new ResponseDeleted($response));
    }
}
