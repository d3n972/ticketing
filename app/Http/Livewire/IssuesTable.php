<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use \App\Models\Issue;
use App\Models\Team;
use App\Models\User;
use App\Models\JSONResponse;
use App\Models\Severity;
use Exception;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Column;

class IssuesTable extends LivewireDatatable
{
    public $teamsFilter=[];
    public function builder()
    {
        return Issue::with('author', 'assignee', 'severity');
    }
    public function getFilteredTeams(){
     $teams=Auth::user()->allTeams()->all();

     array_map(function($e){
       array_push($this->teamsFilter,$e->name);
     },$teams);
     return $this->teamsFilter;
    }
    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->searchable()
                ->filterable()
                ->linkTo("issue",6),
            Column::name('title')
                ->defaultSort('asc')
                ->searchable()
                ->hideable()
                ->filterable(),
            Column::name('content')
                ->defaultSort('asc')
                ->searchable()
                ->hideable()
                ->filterable(),
            Column::name('author.name')
                ->defaultSort('asc')
                ->searchable()
                ->hideable()
                ->filterable(),
                Column::name('assignee.name')
                ->defaultSort('asc')
                ->searchable()
                ->hideable()
                ->filterable()
                ->label('Assignee'),
            Column::name('project.name')
                ->defaultSort('asc')
                ->searchable()
                ->hideable()
                ->filterable($this->getFilteredTeams()),
            Column::name('severity.name')
                ->defaultSort('asc')
                ->searchable()
                ->hideable()
                ->filterable(),
            Column::callback(['status'], function ($status) {
                $r = "";
                switch ($status) {
                    case Issue::STATUS_CREATED:
                        $r = "CREATED";
                        break;
                    case Issue::STATUS_OPEN:
                        $r = "OPEN";
                        break;
                    case Issue::STATUS_LOCKED:
                        $r = "CLOSED";
                        break;
                    default:
                        throw new \ErrorException('Unknown issue status');
                        break;
                }
                return $r;
            })
                ->searchable()
                ->hideable()
                ->filterable()
                ->label('Status'),
            Column::callback(['id'], function ($id) {
                return view('issues.actions', ['id' => $id]);
            })->unsortable()
        ];
    }

    public function rowClasses($row, $loop)
    {

        $c = Severity::where('name', '=', $row->{'severity.name'})->first();
        $colClass = "text-gray-900 ";
        switch ($c->id) {
            case 1:
                $colClass = "text-white bg-gray-500";
                break;
            case 4:
                $colClass = "text-black bg-yellow-500";
                break;
            case 5:
            case 6:
                $colClass = "bg-red-500 text-white";
                break;
            default:
                # code...
                break;
        }


        return 'divide-x divide-gray-100 text-sm ' . $colClass;
    }
    public function cellClasses($row, $column)
    {
        $c = Severity::where('name', '=', $row->{'severity.name'})->first();
        $colClass = "text-gray-900 ";
        switch ($c->id) {
            case 1:
                $colClass = "text-white bg-gray-500";
                break;
            case 4:
                $colClass = "text-black bg-yellow-500";
                break;
            case 5:
            case 6:
                $colClass = "bg-red-500 text-white";
                break;
            default:
                # code...
                break;
        }

        return 'divide-x divide-gray-100 text-sm ' . $colClass;
    }
    public function details($id)
    {

      return (view('issue.view',['iid'=>$id]));
    }
    public function assign($id)
    {
        return new AssignTask();
    }
    public function lock_unlock($id)
    {

        $m = Issue::where('id', '=', $id)->first();

        if ($m->status) {
            $m->status = Issue::STATUS_OPEN;
        } else {

            $m->status = Issue::STATUS_LOCKED;
        }
        if ($m->save()) {
            session()->flash('message', __('Ticket has been closed.'));
            return response()->json(new JSONResponse(false, __('Ticket closed')));
        } else {
            return response()->json(new JSONResponse(false, __('An error occured')));
        }
    }
}
