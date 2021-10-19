<?php

namespace App\Listeners;

use App\Events\IssueFiled;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendIssueEmails
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
     * @param  IssueFiled  $event
     * @return void
     */
    public function handle(IssueFiled $event)
    {
        //
    }
}
