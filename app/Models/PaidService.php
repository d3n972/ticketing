<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Hidehalo\Nanoid\Client;
use Hidehalo\Nanoid\GeneratorInterface;

/**
 * @property App\Models\User author
 * @property App\Models\Issue issue
 * @property App\Models\User client_assignee
 * @property string public_id
 * @property string description
 * @property integer status
 * @property float price
 */
class PaidService extends Model
{
    use HasFactory;
    use softDeletes;
    private $_nanoid_alphabet='123456789ABCDEFGHJKLMNPRSTUVWXYZabcdefghjklmnprstuvwxyz';
    private $_nanoid_length=21;

    static $STATUSES=[
        0=>'PROPOSED',
        1=>'ACCEPTED',
        2=>'REJECTED'
    ]

    public function accpetProposal(){
        $this->status=1;
        $this->save();
    }

    public function rejectProposal(){
        $this->status=2;
        $this->save();
    }

    public function genPublicId(){
        $client = new Client();
        return $client->formattedId($alphabet = $this->_nanoid_alphabet, $size = $this->_nanoid_length);
    }
}
