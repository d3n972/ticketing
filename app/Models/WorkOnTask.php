<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOnTask extends Model
{
    use HasFactory;
    public function getDuration(){
      return Carbon::parse($this->updated_at)->diff(Carbon::parse($this->created_at))->format('%H:%I:%S');
    }
}
