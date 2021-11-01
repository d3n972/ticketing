<?php

namespace App\Models\Barion;

use Illuminate\Database\Eloquent\Model;
use PaymentTransactionModel;

class Transaction extends Model
{

    private PaymentTransactionModel $pmModel;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->pmModel = new PaymentTransactionModel();
    }

    public function setTransId($id)
    {
        $this->pmModel->POSTransactionId = $id;
        return $this;
    }

    public function setPayee($payee)
    {
        $this->pmModel->Payee = $payee;
        return $this;
    }

    public function setTotal($total)
    {
        $this->pmModel->Total = $total;
        return $this;
    }

    public function setComment($comment)
    {
        $this->pmModel->Comment = $comment;
        return $this;
    }

    public function addItem(PaymentItem $pi)
    {
        $this->pmModel->AddItem($pi->getItem());
        return $this;
    }

    public function getTrans()
    {
        return $this->pmModel;
    }

    public static function Factory()
    {
        return new static();
    }
}
