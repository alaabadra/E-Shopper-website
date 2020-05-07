<?php

namespace App\Http\Controllers;
use Image;
use Illuminate\Http\Request;
use App\User;
use App\Delivery;
use DB;
use Auth;
use  Session;
use App\Country;
use Crypt;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Product;
use Illuminate\Contracts\Auth\MustVerifyEmail; 
use App\Order;
use App\Cart;
use App\OrdersProduct;
use App\Coupon;
use Illuminate\Support\Facades\Mail;
//class UserController extends Athenticatable implements MustVerifyEmail
class UserController
{
    //
    public function home(){
        return view('home_page');
    }
    public function loginUser(Request $req){
        if(Session::get('sessionAdmin')){
            Session::forget('sessionAdmin');

        }
        if(Session::get('sessionUser')){
            return redirect('/home-page')->with('flash_message_success','you are login exactly');
           

        }
        if($req->isMethod('post')){

            $data=$req->all();
            $userCount=User::where('email',$data['email'])->count();
            if($userCount==0){
                return redirect()->back()->with('flash_message_error','email is not exist, you can register after that you can login ');
            }else{
                $user=User::where('email',$data['email'])->first();
              $secPAssDb= $user->password;

                if(Crypt::decryptString($secPAssDb)==$data['password']){
                    if($user->status==0){
                    $email=$data['email'];
                    $messageData=['email'=>$data['email'],'name'=>$user->name,'code'=>base64_encode($data['email'])];
                    Mail::send('emails.confirmation',$messageData,function($message) use ($email){
                        $message->to($email)->subject('confirm your  e-com account');
                    });
                        return redirect()->back()->with('flash_message_error','your account is not activated! please check your inbox to confirm your account');
                   }elseif($user->status==1){

                        Session::put('sessionUser',$data['email']);
                        return redirect('/home-page')->with('flash_message_success','login success');
                   }

                    
                }else{
                    return redirect()->back()->with('flash_message_error','invalid username or pass');
                }
            
      
        }
        
    }
    return view('users.login_user');
}
    public function forgetPassword(Request $req){
        if($req->isMethod('post')){
            $data=$req->all();
          $user=User::where(['email'=>$data['email']])->first();
            $userCount=User::where(['email'=>$data['email']])->count();
            if($userCount>0){
                //generate password
                 $random_password=str_random(8);
                //bcypt this genarate pass to become new pass that will store in db and this will send into his email
                $new_password=Crypt::encryptString($random_password);
                //store in d
                User::where(['email'=>$data['email']])->update(['password'=>$new_password]);
                //send into his email
                $email=$data['email'];
                $messageData=[
                    'namey'=> $user->name,
                    'email'=>$data['email'],
                    'password'=>$random_password
                ];
                Mail::send('emails.enquiry_for_password',$messageData,function($message)use($email){
                    $message->to($email)->subject('new pasword-ecommerce website');
                });
              return redirect('login-user')->with('flash_message_success','please , check your inbox email to get your new password');


            }else{
                return redirect()->back()->with('flash_message_error','your email is not exsit , you not login before this time');
            }
        }
        return view('users.forget_password');
    }
    public function confirmAccount($emailCode){
        $emailU=base64_decode($emailCode);

        $userCount=User::where('email',$emailU)->count();
        if($userCount>0){
            echo 'success';
            $userDetails=User::where('email',$emailU)->first();
            if($userDetails->status==1){
                return redirect('/home-page')->with('flash_message_success','your email account is already activated');
            }else{
                $userDetailsUpdate=User::where('email',$emailU)->update(['status'=>1]);
                //send welcome into our web to email
            $userDetails=User::where('email',$emailU)->first();
                $emailU=base64_decode($emailCode);
                $nameU=$userDetails->name;
                $messageData=['email'=>$emailU,'name'=>$nameU];
                Mail::send('emails.welcome',$messageData,function($message) use ($emailU){
                    $message->to($emailU)->subject('welcome to  e-com website');
                });
                    Session::put('sessionUser',$emailU);
                    return redirect('/home-page')->with('flash_message_success','your email account is already activated');
        }
    
}else{
            abort(404);
        }
    }
    public function regUser(Request $req){
        if(Session::get('sessionAdmin')){
            Session::forget('sessionAdmin');

        }
        if(Session::get('sessionUser')){
            return redirect('/home-page')->with('flash_message_success','you are login exactly');
        }
        $getCountries=Country::get();
        if($req->isMethod('post')){
           $data=$req->all();
            $userCount=User::where('email',$data['email'])->count();
            if($userCount>0){
                return redirect()->back()->with('flash_message_error','email is exist already');
            }else{
            if($data['password-repeat']==$data['password']){
                    DB::table('users')->insert(['email'=>$data['email'],'password'=>Crypt::encryptString($data['password']),'name'=>$data['name'],'status'=>0, 'pincode'=>$data['pincode'],'state'=>$data['state'],'city'=>$data['city'],'address'=>$data['address'],'mobile'=>$data['mobile'],'country'=>$data['country_name']]);
                    //send confirmation email
                    $email=$data['email'];
                    $messageData=['email'=>$data['email'],'name'=>$data['name'],'code'=>base64_encode($data['email'])];
                    Mail::send('emails.confirmation',$messageData,function($message) use ($email){
                        $message->to($email)->subject('confirm your  e-com account');
                    });
                    
                    return redirect()->back()->with('flash_message_success','please , see your inbox to confirm your email to activate your account');
            }else{
                return redirect()->back()->with('flash_message_error','password must be match');
            }
            }
        }
        return view('users.reg_user')->with(compact('getCountries'));
    }
    public function logoutUser(){
        Auth::logout();
        Session::forget('sessionUser');
        Session::forget('sessionOrderId');
        Session::forget('sessionGrandTotal');
        return redirect('/home-page');
    }
    public function viewProfile($user_email){
        $dataThisUser=User::where(['email'=>$user_email])->first();
      $imageUser=  $dataThisUser->image;
        $dataThisUserCount=User::where(['email'=>$user_email])->count();
        return view('users.view_profile')->with(compact('dataThisUser','passwordDec','imageUser'));
    }
    public function editProfile($id=null,Request $req){
        $dataThisUser=User::where(['id'=>$id])->first();
        $user=User::where(['id'=>$id])->first();
        $userPassDb=$user->password;
        $userPassDec=Crypt::decryptString($userPassDb);
            $getCountries=Country::get();
            if($req->isMethod('post')){
                $req->validate([
                    'email'=>'required|email',
                    'name'=>'required',
                    'pincode'=>'required',
                    'city'=>'required',
                    'state'=>'required',
                    'mobile'=>'required',
                    'address'=>'required',
                    ]);
            $data=$req->all();
          
            DB::table('users')->where('id',$id)->update(['email'=>$data['email'],'name'=>$data['name'],'pincode'=>$data['pincode'],'state'=>$data['state'],'city'=>$data['city'],'address'=>$data['address'],'mobile'=>$data['mobile'],'country'=>$data['country']]);

        }
        return view('users.edit_profile')->with(compact('dataThisUser','getCountries','userPassDec'));
    }
    public function changeImage($id=null,Request $req){
        $sessionEmail=Session::get('sessionUser');
        $dataThisUser=User::where(['email'=>$sessionEmail])->first();
        if($req->isMethod('post')){
            //upload image
            if($req->hasFile('image')){
              $image_tmp=$req->file('image');
             if($image_tmp->isValid()){
                 $extension=$image_tmp->getClientOriginalExtension();
               $filename=rand(111,9999).'.'.$extension;
                 //save in folder
                 $image_path='images/backend_images/products/'.$filename;
                 //save in folder
                  $small_image_path='images/backend_images/products/small/'.$filename;
                  $medium_image_path='images/backend_images/products/medium/'.$filename;
                  $large_image_path='images/backend_images/products/large/'.$filename;
                  //resize, save
                  Image::make($image_tmp)->resize(300,300)->save(public_path($small_image_path));
                  //store in db
                  $editImg= User::where(['id'=>$id])->first();
                  $editImg->image=$filename;
                  $editImg->save();
                return redirect()->back()->with('flash_message_success','edit your image success');
             }
         }
        }
        return view('users.changeImageUser')->with(compact('dataThisUser'));
    }
    public function updatePassword(Request $req,$id=null){
        
        $dataThisUser=User::where(['id'=>$id])->first();
        if($req->isMethod('post')){
            $req->validate([
                'old_password'=>'required',
                'new_password'=>'required'
                ]);
            $data=$req->all();
            
            $oldPassDb=$dataThisUser->password;
            $reqpass=$data['old_password'];
        $oldPassDbDec= Crypt::decryptString($oldPassDb);
        if($reqpass==$oldPassDbDec){
            $newPassReq=Crypt::encryptString($data['new_password']);
            DB::table('users')->where('id',$id)->update(['password'=>$newPassReq]);
            return redirect()->back()->with('flash_message_success','your password updated successfully');
            
        }else{
            return redirect()->back()->with('flash_message_error','pls, write correct your old pass');
            }
          
        }
        return view('users.update_password')->with(compact('dataThisUser'));
    

    }

    public function checkoutShipping($user_id=null,Request $req){
        $user=  User::where(['id'=>$user_id])->first();
        $getCountries=Country::get();

        if($req->isMethod('post')){
            $req->validate([
                'email_shipping'=>'required',
                'name_shipping'=>'required',
                'pincode_shipping'=>'required',
                'state_shipping'=>'required',
                'address_shipping'=>'required',
                'mobile_shipping'=>'required',
                'country_name'=>'required',
                ]);
            $data=$req->all();

            $deliveryThisUser=Delivery::where(['user_id'=>$user_id])->count();
            if($deliveryThisUser>0){
                $delivery=Delivery::where(['user_id'=>$user_id])->first();
                $delivery->email=$data['email_shipping'];
                $delivery->name=$data['name_shipping'];
                $delivery->pincode=$data['pincode_shipping'];
                $delivery->state=$data['state_shipping'];
                $delivery->address=$data['address_shipping'];
                $delivery->mobile=$data['mobile_shipping'];
                $delivery->country_name=$data['country_name'];
                $delivery->save();
        return redirect()->back()->with('flash_message_success','updated successfully');

            }else{
                    $newDelivery= new Delivery();
                    $newDelivery->user_id=$user_id;
                    $newDelivery->email=$data['email_shipping'];
                    $newDelivery->name=$data['name_shipping'];
                    $newDelivery->pincode=$data['pincode_shipping'];
                    $newDelivery->state=$data['state_shipping'];
                    $newDelivery->address=$data['address_shipping'];
                    $newDelivery->mobile=$data['mobile_shipping'];
                    $newDelivery->country_name=$data['country_name'];
                    $newDelivery->save();
        return redirect()->back()->with('flash_message_success','added successfully');

            }

            

            
        }
        return view('users.checkout_shipping')->with(compact('user','getCountries'));
    }

    public function checkoutBilling($id,Request $req){
        $user=  User::where(['id'=>$id])->first();
        $getCountries=Country::get();
        if($req->isMethod('post')){
            $req->validate([
                'email_billing'=>'required',
                'name_billing'=>'required',
                'pincode_billing'=>'required',
                'state_billing'=>'required',
                'address_billing'=>'required',
                'mobile_billing'=>'required',
                'country_name'=>'required',
                ]);
            $data=$req->all();
            DB::table('users')->where('id',$id)->update(['email'=>$data['email_billing'],'name'=>$data['name_billing'],'pincode'=>$data['pincode_billing'],'state'=>$data['state_billing'],'city'=>$data['city_billing'],'address'=>$data['address_billing'],'mobile'=>$data['mobile_billing'],'country'=>$data['country_billing']]);
            return redirect()->back()->with('flash_message_success','updated successfully');
        }
        return view('users.checkout_billing')->with(compact('user','getCountries'));   
    }
    public function orderReviewDetails($order_id){
        $sessionEmail=Session::get('sessionUser');
        $order=OrdersProduct::where(['order_id'=>$order_id])->get();
        $billingUser=  User::where(['email'=>$sessionEmail])->first();//billing
        $userCountDelivery=  Delivery::where(['email'=>$sessionEmail])->count();
        if($userCountDelivery==0){
            return redirect()->back()->with('flash_message_success','sorry , not exist any delivery for you to show it , if you want make delivery , you can click on checkout shipping');
        }else{
            $user=  Delivery::where(['email'=>$sessionEmail])->first();
            $shippingUser=Delivery::where(['email'=>$user->email])->first();
            return view('orders.view_order_review')->with(compact('billingUser','shippingUser','userCart','ordersProducts','order'));
        }
    }
    public function viewAllMyOrdersReview(){
        $sessionEmail=Session::get('sessionUser');
        $allMyOrdersCount= Order::where(['user_email'=>$sessionEmail])->count();
        if($allMyOrdersCount==0){
            return view('orders.view_all_my_orders');
        }
        $allMyOrders= Order::where(['user_email'=>$sessionEmail])->get();
        return view('orders.view_all_my_orders')->with(compact('allMyOrders'));
    }
    public function viewUsersCountriesCharts(){
         $getUsersCountries=User::select('country',DB::raw('count(country) as count'))->groupBy('country')->get();//write word country , which is beside it will put name this country 
         $getUsersCountries=json_decode(json_encode($getUsersCountries),true);
        return view('admins.view_users_countries_charts')->with(compact('getUsersCountries'));
    }

    public function viewUsersCharts(){
        $current_month_users=User::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->count();//will dispaly users registered in this month
        $last_month_users=User::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(1))->count();//will dispaly users registered in this month
        $last_to_last_month_users=User::whereYear('created_at',Carbon::now()->year)->whereMonth('created_at',Carbon::now()->subMonth(2))->count();//will dispaly users registered in this month
        return view('admins.view_users_charts')->with(compact('current_month_users','last_month_users','last_to_last_month_users'));
    }
 
    public function AddToMyOrders($product_id=null,Request $req){
        $sessionEmail=Session::get('sessionUser');
        $productId=$product_id;
        $couponThisUser=Coupon::where(['email'=>$sessionEmail])->first();
        if(empty($couponThisUser->coupon_code)){
            return view('coupons.add_coupon')->with('flash_message_error','you must add your code before making your order, after that you can add your product into your order');
        }
        $couponCodeThisUser= $couponThisUser->coupon_code;
        $allCartsForThisUser = Cart::where(['user_email'=>$sessionEmail,'product_id'=>$product_id])->first();
        $prodPrice=$allCartsForThisUser->product_price;
        $prodQuantity=$allCartsForThisUser->product_quantity;
        $total_amount=0;
        $total_amount=$total_amount+($prodPrice*$prodQuantity);
        if(!$couponThisUser){
        return redirect('/add-coupon')->with('flash_message_error','you dont have coupon , please you must register your coupon code');
        }
        $amountType=$couponThisUser->amount_type;
        if($amountType=='fixed'){
            $couponAmount=$couponThisUser->amount;
        }else{
            $couponAmount=$total_amount*($couponThisUser->amount/100);
        }
        $grandTotal=$total_amount-$couponAmount;
        Session::put('sessionGrandTotal',$grandTotal);
        $sessionGrandTotal  = Session::get('sessionGrandTotal');
        $ordersUser=   Order::where(['user_email'=>Session::get('sessionUser')])->get();
        if($req->isMethod('post')){
            $req->validate([
                'coupon_code'=>'required'
                ]);
            $data=$req->all();
            if(empty($data['status'])){
                $status=0;
            }else{
                $status=1;
    
            }
            $neworder=new Order;
            $neworder->user_email=$sessionEmail;
            $neworder->grand_total=$grandTotal;
            $neworder->coupon_code=$data['coupon_code'];
            $neworder->coupon_amount=$couponAmount;
            $neworder->order_status=$status;
            $neworder->save();
            $orderId=  $neworder->id;
            Session::put('sessionOrderId',$orderId);
            $orderId  = Session::get('sessionOrderId');
            $newOrderProduct=new OrdersProduct;
            $newOrderProduct->order_id=$orderId;
            $newOrderProduct->product_id=$product_id;
            $newOrderProduct->save();
            redirect()->back()->with('flash_message_success','added your product into your orders successfully');
        }
        return view('orders.add_to_my_orders')->with(compact('productId','ordersProducts','couponCodeThisUser','ordersUser'));
    
}



public function EditMyOrder($id=null,Request $req){
    $editOrder= Order::where(['id'=>$id])->first();
        $sessionEmail=Session::get('sessionUser');
        $couponThisUser=Coupon::where(['email'=>$sessionEmail])->first();
        if(empty($couponThisUser->coupon_code)){
            return view('coupons.add_coupon')->with('flash_message_error','you must add your code before making your order, after that you can add your product into your order');
        }
        $couponCodeThisUser= $couponThisUser->coupon_code;
        $amountType=$couponThisUser->amount_type;
        if($amountType=='fixed'){
            $couponAmount=$couponThisUser->amount;
        }else{
            $couponAmount=$total_amount*($couponThisUser->amount/100);
        }
        if($req->isMethod('post')){
            $req->validate([
                'coupon_code'=>'required'
                ]);
            $data=$req->all();
            if(empty($data['status'])){
                $status=0;
            }else{
                $status=1;
    
            }
            $editOrder->user_email=$sessionEmail;
            $editOrder->coupon_code=$data['coupon_code'];
            $editOrder->order_status=$status;
           $editOrder->save();
           return redirect()->back()->with('flash_message_success','updated success');
        }
        return view('orders.edit_my_order')->with(compact('editOrder','id','productId','ordersProducts','couponCodeThisUser'));

    }


    
    public function DeleteOrder($order_id=null){
        $order=Order::where(['id'=>$order_id]);
        $order->delete();
        $orderProd=OrdersProduct::where(['order_id'=>$order_id]);
        $orderProd->delete();
        return redirect()->back()->with('flash_message_success','deleted this order from your orders is successfully');
    }
}
