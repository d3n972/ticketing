<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\JSONResponse;
use App\Models\Severity;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Isset_;

class IssueController extends Controller
{
    public function index(Request $request)
    {
        return view('issues.list');
    }

    public function details($id)
    {
        return view('issues.view', ['issue' => (Issue::with('author', 'assignee', 'severity')->where('id', '=', $id)->first())]);
    }

    public function new()
    {
        return view('issues.create');
    }
    public function switchStatus(Request $r)
    {
        $id = $r->input('id');
        $m = Issue::find($id)->first();

        $m->status = Issue::STATUS_LOCKED;
        if ($m->save()) {
            session()->flash('message', __('Ticket has been closed.'));
            return response()->json(new JSONResponse(false, __('Ticket closed')));
        } else {
            return response()->json(new JSONResponse(false, __('An error occured')));
        }
    }
}
