<?php

namespace App\Http\Livewire;

use App\Models\Issue;
use App\Models\Severity;
use Asantibanez\LivewireStatusBoard\LivewireStatusBoard;
use Illuminate\Support\Collection;


class TicketStatusBoard extends LivewireStatusBoard
{
    private Collection $records;

    public function statuses(): Collection
    {
        return collect([
            [
                'id' => Issue::STATUS_CREATED,
                'title' => 'Created',
            ],
            [
                'id' => Issue::STATUS_OPEN,
                'title' => 'Open',
            ],
            [
                'id' => Issue::STATUS_LOCKED,
                'title' => 'Locked',
            ]
        ]);
    }

    public function styles()
    {
        return [
            'wrapper' => 'w-full h-full flex space-x-4 overflow-x-auto', // component wrapper
            'statusWrapper' => 'h-full flex-1', // statuses wrapper
            'status' => 'bg-gray-700 rounded px-2 flex flex-col max-h-screen text-gray-300', // status column wrapper
            'statusHeader' => 'p-2 text-sm text-gray-300', // status header
            'statusFooter' => 'bg-red-800', // status footer
            'statusRecords' => 'space-y-2 p-2 flex-1 overflow-y-auto', // status records wrapper
            'record' => 'shadow bg-gray-700 p-2 rounded border', // record wrapper
            'recordContent' => 'bg-green-800', // record content
        ];
    }

    public function records(): Collection
    {
        return $this->records = Issue::with('author', 'assignee', 'severity')->get()
            ->map(function (Issue $ticket) {
                return [
                    'id' => $ticket->ticket_id,
                    'title' => $ticket->title,
                    'status' => $ticket->status,
                    'content' => $ticket->getContent(),
                    'severity' => Severity::where('id',$ticket->severity)->first()
                ];
            });
    }

    public function onStatusChanged($recordId, $statusId, $oldStatus, $newStatus)
    {
        $i = Issue::getTicketById($recordId);
        $i->status = (int)$statusId;
        $i->save();
    }

}
