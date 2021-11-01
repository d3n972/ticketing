<?php

namespace App\Models\Barion;

use Currency;
use FundingSourceType;
use phpDocumentor\Reflection\Utils;
use PreparePaymentRequestModel;
use Illuminate\Database\Eloquent\Model;
use UILocale;

class PaymentRequest extends Model
{

    private PreparePaymentRequestModel $ppModel;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->ppModel = new PreparePaymentRequestModel();
        $this->ppModel->FundingSources = array(FundingSourceType::All);
        $this->ppModel->Locale = UILocale::EN;
        $this->ppModel->Currency = Currency::HUF;
        $this->ppModel->RedirectUrl = route('payment.after');
        $this->ppModel->CallbackUrl = route('payment.process');
    }

    public function addTransaction(Transaction $t)
    {
        $this->ppModel->AddTransaction($t->getTrans());
    }

    public function setGuestCheckout($t): PaymentRequest
    {
        $this->ppModel->GuestCheckout = $t;
        return $this;
    }

    public function setPaymentType( $pt): PaymentRequest
    {
        $this->ppModel->PaymentType = $pt;
        return $this;
    }

    public function setRequestId($id): PaymentRequest
    {
        $this->ppModel->PaymentRequestId = $id;
        return $this;
    }

    public function setPayerHint($hint): PaymentRequest
    {
        $this->ppModel->PayerHint = $hint;
        return $this;
    }

    public function setOrderNumber($on): PaymentRequest
    {
        $this->ppModel->OrderNumber = $on;
        return $this;
    }

    public function getPreparePaymentRequest()
    {
        return $this->ppModel;
    }

    public static function Factory(): PaymentRequest
    {
        return new static();
    }
}
