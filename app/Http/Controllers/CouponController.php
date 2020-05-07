<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Session;
use DB;
use App\User;
class CouponController extends Controller
{
    //
    public function viewCoupons(){
        $sessionEmail=Session::get('sessionAdmin');
    $sessionEmailSubAdmin=Session::get('sessionsubAdmin');

        if($sessionEmail||$sessionEmailSubAdmin){

            $coupons=  Coupon::get();
            return view('coupons.view_coupons')->with(compact('coupons'));
        }else{
            return redirect()->back()->with('flash_message_error','you havent access in this page view coupons');
            
        }
    }
    public function addCoupon(Request $req){
        $sessionEmail=Session::get('sessionUser');
        if($sessionEmail){
        $sessionEmail=Session::get('sessionUser');
       $couponCount= Coupon::where(['email'=>$sessionEmail])->count();
        if($couponCount==0){

            if($req->isMethod('post')){
                $data=$req->all();
                if(empty($data['product_status'])){
                    $status=0;
                }else{
                    $status=1;
        
                }
                $addCoupon=new Coupon();
                $addCoupon->coupon_code=$data['coupon_code'];
                $addCoupon->amount=$data['amount'];
                $addCoupon->amount_type=$data['amount_type'];
                $addCoupon->expiry_date=$data['expiry_date'];
                $addCoupon->status=$status;
                $addCoupon->email=$sessionEmail;
                $addCoupon->save();
                return redirect()->back()->with('flash_message_success','added success');
            }
            return view('coupons.add_coupon');
        }else{
        $sessionEmail=Session::get('sessionUser');
        $coupon = Coupon::where(['email'=>$sessionEmail])->first();
        $couponIdThisUser=  $coupon->id;
            $editCoupon=Coupon::where(['id'=>$couponIdThisUser])->first();
            return redirect("/user/edit-coupon/.$editCoupon->id");
        }
    }else{
        return redirect()->back()->with('flash_message_error','you havent access in this page view coupons');
        
    }
    }

    public function addCouponFromAdmin(Request $req){
        $sessionAdmin=Session::get('sessionAdmin');
        if($sessionAdmin){
        if($req->isMethod('post')){
            $data=$req->all();
            $couponCount= Coupon::where(['email'=>$data['email']])->count();
             if($couponCount==0){
            $userCount=User::where(['email'=>$data['email']])->first();
            if($userCount==0){
                return redirect()->back()->with('flash_message_error','you cannt add this email , because this email is not exsit');

            }else {
                
                if(empty($data['product_status'])){
                    $status=0;
                }else{
                    $status=1;
        
                }
                $addCoupon=new Coupon();
                $addCoupon->email=$data['email'];
                $addCoupon->coupon_code=$data['coupon_code'];
                $addCoupon->amount=$data['amount'];
                $addCoupon->amount_type=$data['amount_type'];
                $addCoupon->expiry_date=$data['expiry_date'];
                $addCoupon->status=$status;
                $addCoupon->save();
                return redirect()->back()->with('flash_message_success','added success');
            }
        }else{
            return redirect()->back()->with('flash_message_error','you  cannt add this user , because is exist with his the coupon code');

        }
    }else{
        return view('coupons.add_coupon_from_admin');
       
        }
    }else{
        return redirect()->back()->with('flash_message_error','you havent access in this page view coupons');
        
    }
    }

    public function UsereditCoupon(Request $req){
        $sessionEmail=Session::get('sessionUser');
        if($sessionEmail){
        // if(!empty($id)){
        $sessionEmail=Session::get('sessionUser');
            $coupon = Coupon::where(['email'=>$sessionEmail])->first();
          $couponIdThisUser=  $coupon->id;
            $editCoupon=Coupon::where(['id'=>$couponIdThisUser])->first();
            if($req->isMethod('post')){
                $data=$req->all();  
                $editCoupon->coupon_code=$data['coupon_code'];
                $editCoupon->amount=$data['amount'];
                $editCoupon->amount_type=$data['amount_type'];
                $editCoupon->expiry_date=$data['expiry_date'];
                $editCoupon->email=$sessionEmail;
                $editCoupon->save();  
                return redirect()->back()->with('flash_message_success','updated successfully');

            }
        // }
        return view('coupons.user_edit_coupon')->with(compact('editCoupon'));
    }else{
        return redirect()->back()->with('flash_message_error','you havent access in this page view coupons');
        
    }
    }
    public function AdmineditCoupon(Request $req,$id=null){
        $sessionEmail=Session::get('sessionAdmin');
        if($sessionEmail){
        if(!empty($id)){
            $editCoupon=Coupon::where(['id'=>$id])->first();
        if(empty($data['status'])){
            $status=0;
        }else{
            $status=1;

        }
            if($req->isMethod('post')){
                $data=$req->all();    
                DB::table('coupons')->where('id',$id)->update(['coupon_code'=>$data['coupon_code'],'amount'=>$data['amount'],'amount_type'=>$data['amount_type'],'expiry_date'=>$data['expiry_date'],'status'=>$status,'email'=>$data['email']]);
                return redirect()->back()->with('flash_message_success','edited success');

            }
        }
        return view('coupons.admin_edit_coupon')->with(compact('editCoupon'));
    }else{
        return redirect()->back()->with('flash_message_error','you havent access in this page view coupons');
        
    }
    }
    public function deleteCoupon($id=null){
        $sessionEmail=Session::get('sessionAdmin');
        if($sessionEmail){
        if(!empty($id)){
            $coupon=Coupon::where(['id'=>$id])->first();
            $coupon->delete();
            return redirect()->back()->with('flash_message_success','deleted success');
        }
    }else{
        return redirect()->back()->with('flash_message_error','you havent access in this page view coupons');
        
    }
    }

    public function applyCoupon(Request $req){
        $sessionEmail=Session::get('sessionAdmin');
            if($sessionEmail){
                if($req->isMethod('post')){
                    $data=$req->all();
                    $sessionEmail=Session::get('sessionUser');
                    $couponCount = Coupon::where(['email'=>$sessionEmail,'coupon_code'=>$data['coupon_code']])->count();//اوصلت لبرودكت معين ليوزر معين 
                    if($couponCount==0){
                        return redirect()->back()->with('flash_message_error','your coupon is not correct , pls write your coupon is right ');
                            }else{
                                //check vaild or not this coupon
                                $couponDetails=Coupon::where(['coupon_code'=>$data['coupon_code']])->first();
                                //1. is active or not
                                if($couponDetails->status==0){
                            return redirect()->back()->with('flash_message_error','this coupon is not active');
                                }
                                //2. is expire or not
                                $expiry_date=$couponDetails->expiry_date;
                                $current_date=date('Y-m-d');
                                if($expiry_date<$current_date){
                            return redirect()->back()->with('flash_message_error','this coupon is expired');

                                }
                                //3.get total mount
                                $total_mount=0;
                                $userCart = DB::table('carts')->where(['user_email'=>$sessionEmail])->get();
                                foreach($userCart as $item){
                                    $total_mount=$total_mount+($item->product_price*$item->product_quantity);
                                }
                                //3.if amount is fixed or percentage
                                if($couponDetails->amount_type=="fixed"){
                                    $couponAmount=$couponDetails->amount;
                                }else{
                                    $couponAmount=$total_mount*($couponDetails->amount/100);
                                }
                                //add coupon code and amount in session 
                                Session::put('sessionCouponCode',$data['coupon_code']);
                                Session::put('sessionCouponMount',$couponAmount);
                                //if active and not expired
                            return redirect()->back()->with('flash_message_success','coupon code successfully applied. you are available disacount');
                            }
                        
                        }
                    }else{
                        return redirect()->back()->with('flash_message_error','you havent access in this page view coupons');
                        
                    }
            }
        
}
