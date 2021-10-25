<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Severity extends Model{
  use HasFactory;

  protected $fillable = ['*'];

  public function getCSSStyling(){
    $colClass = "";
    switch($this->id){
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
    return $colClass;
  }
}
