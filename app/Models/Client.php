<?php

namespace App\Models;

use App\Actions\Jetstream\AddTeamMember;
use App\Actions\Jetstream\CreateTeam;
use App\Actions\Jetstream\InviteTeamMember;
use Illuminate\Database\Eloquent\Model;

/**
 * @property User $user
 * @property string name;
 */
class Client extends Model{
  public function user(){
    return User::where('id',$this->user)->first();
  }
  public function addTeam(){
    /**
     * @var User
     */
    $sysuser = User::where('id', 1)->first();
    if($this->user()->teams()->count() == 0){
      $tm = new AddTeamMember();
      $t = $sysuser->ownedTeams()->create([
        'name' => $this->name,
        'personal_team' => false,
      ]);
      $im=new InviteTeamMember();
      $im->invite($sysuser,$t,$this->user()->email,'client_admin');


      dd($t,$t->teamInvitations()->get(), $sysuser->ownedTeams()->get());

    }
  }
}
