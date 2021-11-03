<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Hidehalo\Nanoid\Client;
use Hidehalo\Nanoid\GeneratorInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Redirect;
use PaymentType;

/**
 * @property User author
 * @property Issue issue
 * @property User client_assignee
 * @property string public_id
 * @property string description
 * @property integer status
 * @property float price
 */
class PaidService extends Model
{
    use HasFactory;
    use SoftDeletes;

    private $_nanoid_alphabet = '123456789ABCDEFGHJKLMNPRSTUVWXYZ';
    private $_nanoid_length = 8;

    static $STATUSES = [
        0 => 'PROPOSED',
        1 => 'ACCEPTED',
        2 => 'REJECTED'
    ];

    public function issue()
    {
        return Issue::where('id', $this->issue)->first();
    }

    public function author()
    {
        return User::where('id', $this->author)->first();
    }

    public function client_assignee()
    {
        return User::where('id', $this->client_assignee)->first();
    }

    public function accpetProposal(): string
    {
        $this->status = 1;
        $this->save();
        $k = new Payment();
        $i = $k->newItem();
        $i->setSKU($this->issue()->ticket_id)
            ->setName("Paid development")
            ->setDescription("Paid development regarding ticket ".$this->issue()->ticket_id)
            ->setUnitPrice($this->price)
            ->setItemTotal($this->price)
            ->setQuantity(1);
        $k->addItem($i);
        $trans = $k->newTransaction();
        $tf = $trans->setTransId(sprintf('%s/%s/%s', 'TRAN-PS', $this->public_id, 1))
            ->setPayee("d3n+bariontest@d3n.it")
            ->addItem($i)
            ->setTotal($this->price);

        $pr = $k->newPaymentRequest();
        $pr->setOrderNumber($this->public_id)
            ->setGuestCheckout(true)
            ->setPayerHint("foo@example.com")
            ->setRequestId(sprintf('%s/%s', 'TRAN-PS', $this->public_id))
            ->setPaymentType(PaymentType::Immediate)
            ->addTransaction($tf);
        $k->addPaymentRequest($pr->getPreparePaymentRequest());
        return $k->getPaymentURL();
    }

    public function rejectProposal()
    {
        $this->status = 2;
        $this->save();
    }

    public function genPublicId()
    {
        $client = new Client();
        return $client->formattedId($this->_nanoid_alphabet, $this->_nanoid_length);
    }
}
