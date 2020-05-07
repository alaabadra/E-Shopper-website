<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Softon\Indipay\Facades\Indipay;  
use Illuminate\Support\Facades\Mail;
use App\Order;
use Session;
use App\OrdersProduct;
use App\Product;
use App\Delivery;
use Auth;
class PayumoneyController extends Controller
{
    //
    public function payumoneyPayment(){
              /* All Required Parameters by your Gateway */

           $parameters = [

            'tid' => 1000001,
            'order_id' => 1000001,
            
            'amount' => 1200.00,
            'firstname'=>'Alaa',
             'lastname'=>'Badra',
             'email'=>'alaabadra4@gmail.com',
            'phone'=>'54540545214',
             'productinfo'=> 1000001,
             'service_provider'=>'',
             'zipcode'=>'141004',
             'city'=>'gaza',
             'state'=>'palestine',
             'country'=>'palestine',
             'address1'=>'Al-Naser',
             'address2'=>'abc',
             'curl'=>url('/payumoney/response'),
          ];
          $order=Indipay::prepare($parameters);
          return Indipay::process($order);
        
    }

    public function payumoneyResponse(Request $req){
      $response=Indipy::response($req);
      if($response['status']=='success'&&$response['unmappedstatus']=='captured'){
       Order::where('id',$orderId)->update(['order_status'=>'Payment caputer']);

//         //////////code for order email
        $productsInOrder=OrdersProduct::where(['order_id'=>$orderId])->get();//جبت كل البرودكتس اللي في هادا الاوردر
        foreach($productsInOrder as $productInOrder){
          $productsId=$productInOrder->product_id;
          $productDetails=Product::where(['id'=>$productsId])->first();//هلا حابحث عن كل برودكت لاجيب تفاصيله من جدول البرودكت
        }
        $orderDetails=Order::where(['order_id'=>$orderId])->first();
        $orderDetails=Order::where('id',$orderId)->first();
        $orderDetails=json_decode(json_encode($orderDetails));
        $userEmail=$orderDetails->user_email;
        $userId=Auth::user()->id;
        $shippingUserDetails=Delivery::where('user_email',$orderDetails->user_email)->first();
        $userName=$shippingDetails->name;
        $messageData=[
          'type_your_payment'=>'payumoney',
            'name'=> $userName,
            'email'=>$userEmail,
            'order_id'=>$orderId,
            'product_id'=>$productId,
            'orderDetails'=>$orderDetails,
            'productDetails'=>$productDetails,
            'userDetails'=>$shippingUserDetails
        ];
        Mail::send('emails.order',$messageData,function($message)use($email){
            $message->to($email)->subject('order placed - e-shopping website');
        });
        ////after send into his email will here redirect user to thanks page
        return redirect('/payumoney/thanks');
     }else{
       echo 'fail';
    $orderId=Session::get('sessionOrderId');
       Order::where('id',$orderId)->update(['order_status'=>'Payment failed']);
 ////after send into his email will here redirect user to fail page
 return redirect('/payumoney/fail');
     }
    }

    public function payumoneyThanks(){
      return view('emails.thanks_payumoney');
    }
    public function payumoneyFail(){
      return view('emails.fail_payumoney');
    }

    public function payumoneyVerification($order_id=null){//this for test on one order
      $key = 'gtKFFx';
      $salt = 'eCwWELxi';
      
      $command = "verify_payment";
      $var1 =$order_id;
      $hash_str = $key  . '|' . $command . '|' . $var1 . '|' . $salt ;
      $hash = strtolower(hash('sha512', $hash_str));
      $r = array('key' => $key , 'hash' =>$hash , 'var1' => $var1, 'command' => $command);

      $qs= http_build_query($r);
      $wsUrl = "https://test.payu.in/merchant/postservice?form=2";
      $c = curl_init();
      curl_setopt($c, CURLOPT_URL, $wsUrl);
      curl_setopt($c, CURLOPT_POST, 1);
      curl_setopt($c, CURLOPT_POSTFIELDS, $qs);
      curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 30);
      curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
      $o = curl_exec($c);
      if (curl_errno($c)) {
        $sad = curl_error($c);
        throw new Exception($sad);
      }
      curl_close($c);

      $valueSerialized = @unserialize($o);
      if($o === 'b:0;' || $valueSerialized !== false) {
        print_r($valueSerialized);
      } 
      $o = json_decode($o);
      echo "<pre>"; print_r($o); die;
    }

    public function payumoneyVerify(){
      // get last 30 payumoney orders
      // $orders=Order::where(['payment_method'=>'Payumoney'])->take(30)->get();
        // Get last few orders (Example of Laravel code)
        $orders = Order::where(['payment_method'=>'Payumoney'])->take(30)->orderBy('id','DESC')->get();
        $orders = json_decode(json_encode($orders));
        foreach($orders as $order){
            $key = 'gtKFFx';
            $salt = 'eCwWELxi';
            $command = "verify_payment";
            $var1 = $order->id;
            $hash_str = $key  . '|' . $command . '|' . $var1 . '|' . $salt ;
            $hash = strtolower(hash('sha512', $hash_str));
            $r = array('key' => $key , 'hash' =>$hash , 'var1' => $var1, 'command' => $command);
    
            $qs= http_build_query($r);
            $wsUrl = "https://test.payu.in/merchant/postservice?form=2";
            $c = curl_init();
            curl_setopt($c, CURLOPT_URL, $wsUrl);
            curl_setopt($c, CURLOPT_POST, 1);
            curl_setopt($c, CURLOPT_POSTFIELDS, $qs);
            curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
            $o = curl_exec($c);
            if (curl_errno($c)) {
              $sad = curl_error($c);
              throw new Exception($sad);
            }
            curl_close($c);

            $valueSerialized = @unserialize($o);
            if($o === 'b:0;' || $valueSerialized !== false) {
              print_r($valueSerialized);
            } 
            $o = json_decode($o);
            foreach($o->transaction_details as $key => $val){
                if(($val->status=="success")&&($val->unmappedstatus=="captured")){
                     if($order->order_status == "Payment Fail"||$order->order_status=='New'){
                        Order::where(['id' => $order->id])->update(['order_status' => 'Payment Captured']);
                    }                   
                }else{
                    if($order->order_status == "Payment Captured"||$order->order_status=='New'){
                        Order::where(['id' => $order->id])->update(['order_status' => 'Payment Cancelled']);
                    } 
                }
            }
        }
        echo "cron job run successfully"; die;
    
    }
}
