<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Trancision;
use App\Models\Payment;
class CheckOut extends Controller
{

    public $message;
    public $fullname;
    public $paymode;
    public $paymode1;
    public $email;
    public $phone;
    public $address;
    public $zipcode;

    public function orderstatus()
    {

       $ordetails= DB::table('trancisions')
       ->join('orders', 'orders.id', '=', 'trancisions.order_id')
       ->join('order_items', 'order_items.order_id', '=', 'orders.id')
       ->join('sanpham', 'sanpham.id', '=', 'order_items.product_id')
       ->where('trancisions.user_id', '=', auth()->user()->id)
       ->get();
        //dd($ordetails);
       // lấy thêm đc cả id order_item
        //dd($ordetails);
       return view('site.orderstatus',compact('ordetails'));
    }
    public function deleteOrder( $id_item, Request $request)
    {
        // get order_item for delete
     $item = OrderItem::find($request->id_item);//DB::table('order_items')
        //dd($item);
    //    ->where('order_items.id', '=', $request->id_item)
    //    ->get();
      // dd($items);

      // get order
      $order =  Order::find($item->order_id);
      //dd($order);

     // get coupon
     $coupon =DB::table('counpons')
     ->where('counpons.code', '=', $order->coupon)
     ->get();

    if ( $order->coupon == "không sử dụng") {

            $order->total =  $order->total - $item->price*$item->quantity*1.100;
            $order->subtotal = $order->total*0.9;

    }
    else
    {
        if ($coupon[0]->type == "fixed") {
            $order->total =  $order->total + $coupon[0]->value - $item->price*$item->quantity*1.100;
            $order->subtotal = $order->total*0.9;


        }
        if ($coupon[0]->type == "percent") {
            $order->total =  $order->total + $coupon[0]->value - $item->price*$item->quantity*1.100;
            $order->subtotal = $order->total*0.9;
        }

        if($order->total  < 0 || $order->subtotal < 0 )
        {
            $order->total = 0;
            $order->subtotal = 0;
        }
    }


       $order->save();
       OrderItem::where('id', $request->id_item)->delete();
        return redirect()->route('orderstatus');

    }





    public function index()
    {
        $items=Cart::content();
        return view('site.checkout',compact('items'));
    }





    public function create( Request $request)
    {

        $order = new Order();
        if (session()->has('coupon')) {

        $order->coupon= session()->get('coupon')['code'];
        }
        else
        {
            $order->coupon = "không sử dụng";

            }

        $order->user_id = Auth::user()->id;
        $order->subtotal = session()->get('checkout')['subtotal'];
        $order->tax =session()->get('checkout')['tax'];
        $order->total =session()->get('checkout')['total'];
        $order->firstname= $request->ten;
        $order->lastname= $request->ten;
        $order->email= $request->email;
        $order->phone= $request->phone;
        $order->address= $request->diachi;

          $order->save();

            $transi = new Trancision();
            $transi->user_id = Auth::user()->id;
            $transi->order_id = $order->id;
              $transi->mode = $request->type;
              session()->put('paymenttype',$request->type);
              if ($request->type == "online") {
                $transi->status = 'đã giao thành công';
              }
              else{
                $transi->status = 'chưa giải quyết(có thể cancel)';
              }
              //dd($transi);
            $transi->save();
           session()->put('id',$order->id);
         $items =Cart::content();
         foreach ($items as $i) {
            $order_item = new OrderItem();
            $order_item->product_id= $i->id;
            $order_item->order_id= $order->id;
            $order_item->price= $i->price;
            $order_item->quantity= $i->qty;
            $order_item->save();
            $item = OrderItem::find($order_item->id);
            $item->id_item = $item->id;
            $item->save();
        }

        if ($request->type == "online") {
            $vnp_TxnRef = date("YmdHis");//Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "thanh toan ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount =   $order->total*100;
        $vnp_Locale =   "vn";
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr =$_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        $startTime = date("YmdHis");
        $expire =   date('YmdHis',strtotime('+10 minutes',strtotime($startTime)));
        $vnp_ExpireDate =  $expire;
        //Bill
        $vnp_Bill_Mobile =  "0934998386";
        $vnp_Bill_Email =   "xonv@vnpay.vn";
        $fullName = trim("NGUYEN VAN XO");

        if (isset($fullName) && trim($fullName) != '') {
            $name = explode(' ', $fullName);
            $vnp_Bill_FirstName = array_shift($name);
            $vnp_Bill_LastName = array_pop($name);
        }
        $vnp_Bill_Address=  "22 Láng Hạ, Phường Láng Hạ, Quận Đống Đa, TP Hà Nội";
        //$temp = explode(", ", $this->address);
        //$vnp_Bill_City = $temp[(count($temp)-1)];
        $vnp_Bill_City= 'Thanh hóa';
        $vnp_Bill_Country=  'VN';
        $vnp_Bill_State=   null;
        // Invoice
        $vnp_Inv_Phone= "02437764668";
        $vnp_Inv_Email= "pholv@vnpay.vn";
        $vnp_Inv_Customer=  "Lê Văn Phổ";
        $vnp_Inv_Address=   '22 Láng Hạ, Phường Láng Hạ, Quận Đống Đa, TP Hà Nội';
        $vnp_Inv_Company=   'Công ty Cổ phần giải pháp Thanh toán Việt Nam';
        $vnp_Inv_Taxcode=    '0102182292';
        $vnp_Inv_Type= 'I';
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => env('VNP_TMN_CODE'),
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => env('VNP_RETURNURL'),
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate"=>$vnp_ExpireDate,
            "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
            "vnp_Bill_Email"=>$vnp_Bill_Email,
            "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
            "vnp_Bill_LastName"=>$vnp_Bill_LastName,
            "vnp_Bill_Address"=>$vnp_Bill_Address,
            "vnp_Bill_City"=>$vnp_Bill_City,
            "vnp_Bill_Country"=>$vnp_Bill_Country,
            "vnp_Inv_Phone"=>$vnp_Inv_Phone,
            "vnp_Inv_Email"=>$vnp_Inv_Email,
            "vnp_Inv_Customer"=>$vnp_Inv_Customer,
            "vnp_Inv_Address"=>$vnp_Inv_Address,
            "vnp_Inv_Company"=>$vnp_Inv_Company,
            "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
            "vnp_Inv_Type"=>$vnp_Inv_Type
        );

        if ((null !== $vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if ((null !== $vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $vnp_Url = env('VNP_URL') . "?" . $query;
        if ((null !== env('VNP_HASH_SECRET'))) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, env('VNP_HASH_SECRET'));//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
       Cart::destroy();
       return redirect($vnp_Url);

        }
        else {

                $payment = new Payment();
                $payment->order_id =   $order->id;
               // $payment->code_vnpay = $_GET['code_vnpay'];
                $payment->code_vnpay = "null";
                 $payment->code_bank = "null";
              $payment->typecard = "null";
                $payment->vnp_response_code = "00";
                $payment->note = "thanh toán trực tiếp";
              $payment->amount = $order->total;// rong migration ghi là
               $payment->TransactionNo = rand();
              $payment->TransactionStatus = 0;
                $payment->save();
             $amount = $payment->amount;
             session()->forget('coupon');
             return view('livewire.return-payment',compact('amount'));
        }




    }
    public function payment()
    {

        if ( $_GET['vnp_ResponseCode'] == 00) {

            $payment = new Payment();
            $payment->order_id =   $this->id =session('id');
           // $payment->code_vnpay = $_GET['code_vnpay'];
            $payment->code_vnpay = $_GET['vnp_BankTranNo'];
             $payment->code_bank = $_GET['vnp_BankCode'];
          $payment->typecard = $_GET['vnp_CardType'];
            $payment->vnp_response_code = $_GET['vnp_ResponseCode'];
            $payment->note = $_GET['vnp_OrderInfo'];
          $payment->amount = $_GET['vnp_Amount']/100;;// rong migration ghi là
           $payment->TransactionNo = $_GET['vnp_TransactionNo'];
          $payment->TransactionStatus = $_GET['vnp_TransactionStatus'];

             $payment->save();
         }
         $amount = $payment->amount;
         session()->forget('coupon');
         return view('livewire.return-payment',compact('amount'));
    }
}
