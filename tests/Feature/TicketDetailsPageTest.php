<?php

namespace Tests\Feature;

use App\Models\Issue;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TicketDetailsPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_view_ticket_details()
    {
        $t = new Issue();
        $t->author = 1;
        $t->project = 1;
        $t->assignee = 1;
        $t->severity = 5;
        $t->title = "testcase for test_create_ticket";
        $t->content = 'lorem ipsum';
        $res = $t->save();

        $this->actingAs(User::where('id', 1)->first());
        Livewire::actingAs(User::where('id', 1)->first());

        $this->get('/issue/' . $t->ticket_id)->assertSeeLivewire('issue-details');
    }
    public function test_can
}
