<?php

namespace CommunityPoem\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use CommunityPoem\Events\ResponseApproved;
use Illuminate\Support\Facades\Mail;

class SendPublishedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ResponseApproved $event)
    {
        if (filled($event->response->email)) {
            $subject = 'Your poem has been published!';

            $content = sprintf(
                "%s You can view it using this link:\n%s",
                $subject,
                $event->response->getUrl()
            );

            Mail::raw($content, function ($message) use ($subject, $event) {
                $message->subject($subject);
                $message->to($event->response->email);
            });
        }
    }
}
