<?php

namespace Display\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Display\Space;

class UnapprovedResponsesWaiting extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(Space $space)
    {
        $this->space = $space;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $count = $this->space->unapproved_responses()->count();
        $message = sprintf("%s Thread from '%s' responses are awaiting approval", $count, $this->space->name);

        return (new MailMessage())
            ->subject($message)
            ->view('adminEmail', [
                'message' => $message,
                'signed_url' => $this->space->signedUrl(),
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
        ];
    }
}
