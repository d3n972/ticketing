<?php

namespace App\Extensions\IMAPSync\Models;


use App\Models\Issue;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function Ramsey\Uuid\v4;

class FetchedEmail
{

    public $sender;
    public $subject;
    public $attachments;
    public $body;

    public function __construct(array $attributes = [])
    {
        $this->sender = $attributes['sender'];
        $this->subject = $attributes['subject'];
        $this->attachments = $attributes['attachments'];
        $this->body = $attributes['body'];
    }

    public function createTicket()
    {
        $author = User::where('email', $this->sender->address)->first();
        if ($author == null) {
            $p = Str::random(24);
            $author = User::create([
                'name' => $this->sender->name,
                'email' => $this->sender->address,
                'password' => Hash::make($p),
                'terms' => true
            ]);
            $author->ownedTeams()->save(Team::forceCreate([
                'user_id' => $author->id,
                'name' => explode(' ', $author->name, 2)[0] . "'s Team",
                'personal_team' => true,
            ]));
            Mail::to($author)->send((new \App\Mail\UserCreated($author,$p))->build());
        }

        $issue = new Issue();
        $issue->author = $author->id;
        $issue->title = $this->subject;
        $issue->content = $this->body;
        $issue->due_at = Carbon::now();
        $issue->severity = 1;
        $issue->project = 1;
        $issue->assignee = 1;
        $issue->save();
        foreach ($this->attachments as $aFN) {
            if (isset($aFN)) {
                echo $aFN;
                $d = Storage::get('public/attachments/' . $aFN);
                $issue->attachExistingFile($aFN, strlen($d));
            }
        }
        $issue->save();

        Mail::to($author)->send((new \App\Mail\IssueFiled($issue))->build());

    }

}
