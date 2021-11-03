<?php

namespace App\Mail;

use App\Models\Issue;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

class UserCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $pass;
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
    public function __construct(User $u, string $pass)
    {
        $this->user = $u;
        $this->pass = $pass;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Account for '.env('APP_NAME'))
            ->html((new MailMessage)
                ->from($this->from)
                ->markdown('mail.user_created', ['user' => $this->user,'pass'=>$this->pass])
                ->render()
            );
    }
}
