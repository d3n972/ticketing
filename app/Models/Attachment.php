<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property App\Models\Issue issue
 * @property App\Models\User author
 * @property string filename
 * @property string original_name
 * @property integer size
 */
class Attachment extends Model{
  use HasFactory;
  public function getHumanSize(){
    return $this->bytesToHuman($this->size);
  }
  private function bytesToHuman($bytes){
    $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

    for($i = 0; $bytes > 1024; $i++){
      $bytes /= 1024;
    }

    return round($bytes, 2) . ' ' . $units[$i];
  }
}
