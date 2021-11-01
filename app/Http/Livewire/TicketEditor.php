<?php

namespace App\Http\Livewire;

use App\Models\Issue;
use Illuminate\Http\Request;
use LivewireUI\Modal\ModalComponent;

class TicketEditor extends ModalComponent
{
    public $issue;
    protected $rules=[
        'issue.title'=>'max:50',
        'issue.content'=>'max:1000',
        'price'=>'numeric',
        'ticket_id'=>'max:50|nullable'
    ];
    public $price;
    public $ticket_id;
    public function render()
    {
        return view('livewire.ticket-editor');
    }


    public function submit(Request $r){
       $validatedData=$this->validate();
       $m=Issue::getTicketById($this->issue['id']);
       $changes=["==Ticket has been edited=="];
       foreach ($validatedData['issue'] as $k=>$v){
           if($m->$k!=$v) {
               array_push($changes,sprintf("* %s",$k));
               $m->$k = $v;
           }
       }
       $m->save();
       if($validatedData['price']!=null){

            $ps=new \App\Models\PaidService();
            $ps->issue=$m->id;
            $ps->price=$validatedData['price'];
            $ps->author=$r->user()->id;
            $ps->client_assignee=$m->author;
            $ps->public_id=$ps->genPublicId();
            $ps->save();
            session()->flash('message','Ticket saved!');
       }
    }
}
