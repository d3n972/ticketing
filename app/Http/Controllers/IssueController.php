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
        $uid = $request->user()->id;
        $tok = $request->user()->createToken('usertoken', ['site:read-write'])->plainTextToken;
        return view('issues.list', [
            'token' => $tok
        ]);
    }

    public function api_ListIssues()
    {
        $o = [];
        foreach (Issue::with('author', 'assignee', 'severity')->get() as $i) {
            $l = $i;
            $l->author();
            $l->severityNumeric = $l->severity;
            //  $l->severity = $i->getSeverity();
            array_push($o, $l);
        }
        return response()->json($o);
    }
    public function new()
    {

        return view('issues.create');
    }
    public function switchStatus(Request $r)
    {
        $id = $r->input('id');
        $m = Issue::find($id)->take(1)->get()[0];

        $m->status=Issue::STATUS_LOCKED;
        if($m->save()){
            session()->flash('message', __('Ticket has been closed.'));
            return response()->json(new JSONResponse(false,__('Ticket closed')));
        }else{
            return response()->json(new JSONResponse(false,__('An error occured')));
        }

    }
}
