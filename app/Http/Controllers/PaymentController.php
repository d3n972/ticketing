<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PaymentStateResponseModel;

class PaymentController extends Controller
{
    public function processPayment(Request $r)
    {
        $paymentId = $r->query('paymentId');
        /**
         * @var PaymentStateResponseModel
         */
        $w = Payment::CheckPayment($paymentId);
        if (PaymentData::where('payment_id', $paymentId)->first() == null) {

            $k = new PaymentData();
            $k->payment_id = $w->PaymentId;
            $k->total = $w->Total;
            $k->status = $w->Status;
            $k->order_number = $w->OrderNumber;  //public id for the paid service
            $k->completed_at = Carbon::parse($w->CompletedAt);
            $k->save();

        }
        return response()->redirectTo($w->RedirectUrl);
    }

    public function afterPayment(Request $r)
    {
        $paymentId = $r->query('paymentId');
        return view('payment.result',['pd'=>PaymentData::where('payment_id', $paymentId)->first()]);
    }
}
