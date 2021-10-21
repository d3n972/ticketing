<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Severity;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Isset_;

class IssueController extends Controller
{
    public function api_ListIssues()
    {
        $o = [];
        foreach (Issue::with('author','assignee','severity')->get() as $i) {
            $l = $i;
            $l->author();
            $l->severityNumeric=$l->severity;
          //  $l->severity = $i->getSeverity();
            array_push($o, $l);
        }
        return response()->json($o);
    }
    public function new()
    {

        return view('issues.create');
    }
    public function switchStatus(Request $r){
        $id=$r->post('id');
        $m=Issue::where('id','=',$id)->get();
        dd($m);
    }
}
