<?php

namespace Display\Console\Commands;

use Illuminate\Console\Command;
use Display\Repositories\Spaces;
use Illuminate\Notifications\ChannelManager;
use Display\User;
use Display\Notifications\UnapprovedResponsesWaiting;

class SendEmailToAdmins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'display:emailAdmins';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends an email to admins of spaces that currently have reponses that need moderation.';

    /**
     * Create a new command instance.
     */
    public function __construct(Spaces $spaces, ChannelManager $chanMan)
    {
        parent::__construct();

        $this->spaces = $spaces;
        $this->chanMan = $chanMan;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $spaces = $this->spaces->whereModerationNeeded();

        $spaces->each(function ($space) {
            if (empty($space->admin_emails)) {
                warning('No admin email configured for space '.$space->id.' so we\'re not sending the email');

                return;
            }

            $users = collect(explode(',', $space->admin_emails))->map(function ($email) {
                return new User(['email' => trim($email)]);
            });

            $this->chanMan->send($users, new UnapprovedResponsesWaiting($space));
        });
    }
}
