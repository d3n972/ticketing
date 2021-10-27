<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Team $project
 * @property string $pattern
 * @property integer current
 */
class TicketId extends Model{
  use HasFactory;

  public function project(){
    return $this->hasOne(Team::class, 'id', 'project')->first();
  }

  public function getNext(){

    $id = [];
    $padTo = 1;
    $parts = preg_split('/[\/-]/', $this->pattern);
    foreach($parts as $idPart){
      $part = strtoupper($idPart);
      $padTo = substr_count($idPart, '#');

      if($padTo <= 0){
        switch($part){
          case 'T':
            array_push($id, preg_replace("/[^A-Za-z0-9 ]/", '', $this->project()->name));
            break;
          case 'Y':
            array_push($id, Carbon::now()->format('Y'));
            break;
          default:
            if($part[0] != '#'){
              array_push($id, $part);
            }
            break;
        }
      }

      if(isset($padTo) && $padTo > 0){
        array_push($id, str_pad($this->current, $padTo, '0', STR_PAD_LEFT));
      }
    }
    $this->current += 1;
    $this->save();
    return implode((substr_count($this->pattern, '/') > 0) ? '/' : '-', $id);
  }
}
