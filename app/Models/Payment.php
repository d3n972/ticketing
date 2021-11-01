<?php

namespace App\Models;
require_once '../app/Barion/library/BarionClient.php';

use App\Models\Barion\PaymentItem;
use App\Models\Barion\PaymentRequest;
use App\Models\Barion\Transaction;
use BarionEnvironment;
use BarionClient;
use Currency;
use FundingSourceType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ItemModel;
use PaymentStateResponseModel;
use PaymentTransactionModel;
use PaymentType;
use PreparePaymentRequestModel;
use UILocale;

class Payment extends Model
{
    use HasFactory;

    private string $B_public_key;
    private string $B_POSKey;
    protected BarionClient $client;
    private int $apiVersion = 2;
    private $environment = \BarionEnvironment::Test;

    //----------------------------------------------//
    private $items = [];
    private Transaction $trans;
    private PreparePaymentRequestModel $pr;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->B_public_key = env("BARION_PUBKEY");
        $this->B_POSKey = env("BARION_POSKEY");
        $this->client = new BarionClient($this->B_POSKey, $this->apiVersion, $this->environment);
    }

    public function newItem()
    {
        return new PaymentItem();

    }

    public function addItem(PaymentItem $pi)
    {
        array_push($this->items, $pi);
    }

    public function addTransaction(Transaction $t)
    {
        $this->trans = $t;
    }

    public function newTransaction()
    {
        return new Transaction();
    }

    public function addPaymentRequest($pr)
    {
        $this->pr = $pr;
    }

    public function newPaymentRequest()
    {
        return new PaymentRequest();
    }

    public function getPaymentURL()
    {

        $myPayment = $this->client->PreparePayment($this->pr);
        return $myPayment->PaymentRedirectUrl;
    }

    public static function CheckPayment($pID): PaymentStateResponseModel
    {
        $z = new static();
        return $z->client->GetPaymentState($pID);
    }
}
