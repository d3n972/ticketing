<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;
    protected $fillable=['*'];
    const STATUS_LOCKED=1;
    const STATUS_OPEN=0;
    const STATUS_CREATED=-1;


    public function assignee()
    {
        return $this->hasOne(User::class,'id','assignee')->latest();
    }
    public function author()
    {
        return $this->hasOne(User::class,'id','author')->latest();
    }
    public function severity(){
        return $this->hasOne(Severity::class,'id','severity')->latest();
    }
}
