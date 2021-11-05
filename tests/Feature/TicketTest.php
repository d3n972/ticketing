<?php

namespace Tests\Feature;

use App\Models\Issue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TicketTest extends TestCase
{

    public function test_can_create_ticket_with_valid_data()
    {
        $t = new Issue();
        $t->author = 1;
        $t->project = 1;
        $t->assignee = 1;
        $t->severity = 5;
        $t->title = "testcase for test_create_ticket";
        $t->content = 'lorem ipsum';
        $res = $t->save();
        $this->assertTrue($res, 'Ticket are saved successfully');
    }

    public function test_can_get_ticket_by_public_id()
    {
        $t = Issue::getTicketById('System-000001');
        $this->assertNotNull($t, 'Failed to get ticket by id');
    }
}
