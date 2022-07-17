<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Payment;
class ReturnPayment extends Component
{
    public $code_vnpay;
    public $code_bank;
    public $typecard;
    public $vnp_response_code;
    public $note;
    public $amount;
    public $TransactionNo;
    public $TransactionStatus;
    public function mount()
    {
        if ( $_GET['vnp_ResponseCode'] == 00) {

           $payment = new Payment();
           $payment->order_id =   $this->id =session('id');
          // $payment->code_vnpay = $_GET['code_vnpay'];
          $this->code_vnpay = $payment->code_vnpay = $_GET['vnp_BankTranNo'];
          $this->code_bank =   $payment->code_bank = $_GET['vnp_BankCode'];
          $this->typecard = $payment->typecard = $_GET['vnp_CardType'];
          $this->vnp_response_code = $payment->vnp_response_code = $_GET['vnp_ResponseCode'];
          $this->note = $payment->note = $_GET['vnp_OrderInfo'];
          $this->amount  = $payment->amount = $_GET['vnp_Amount']/100;;// rong migration ghi là
          $this->TransactionNo  = $payment->TransactionNo = $_GET['vnp_TransactionNo'];
          $this->TransactionStatus  = $payment->TransactionStatus = $_GET['vnp_TransactionStatus'];
          $payment->save();
        }
        $this->id =session('id');
    }

    public function render()
    {
        $amount = $this->amount;
        return view('livewire.return-payment',compact('amount'))->layout('layouts.returnpayment');
    }
}
