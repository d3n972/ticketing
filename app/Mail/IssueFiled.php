<?php

namespace App\Mail;

use App\Models\Issue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

class IssueFiled extends Mailable
{
    use Queueable, SerializesModels;

    public $issue;
    public $from = [
        ['address' => "support@d3n.it",
            'name' => 'D3nSupport'
        ]
    ];


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Issue $issue)
    {
        $this->issue = $issue;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New support ticket has been created')
            ->html((new MailMessage)
                ->from($this->from)
                ->markdown('mail.issue_filed', ['issue' => $this->issue])
                ->render()
            );
    }
}
