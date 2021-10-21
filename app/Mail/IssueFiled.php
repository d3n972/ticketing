<?php

namespace App\Mail;

use App\Models\Issue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IssueFiled extends Mailable
{
    use Queueable, SerializesModels;
    public $issue;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Issue $issue)
    {
        $this->issue=$issue;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.issue_filed');
    }
}
