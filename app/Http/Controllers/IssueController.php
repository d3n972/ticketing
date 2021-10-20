<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use PhpParser\Node\Expr\Isset_;

class IssueController extends Controller
{
   public function api_ListIssues(){
        $o=[];
        foreach (Issue::all() as $i) {
            $l=$i;
            $l->severity=$i->getSeverity();
            array_push($o,$l);
        }
      return response()->json($o);
   }
}
