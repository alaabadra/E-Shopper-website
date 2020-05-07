<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\ProductsAttribute;
use Session;
use App\User;
class CartsController extends Controller
{
    //
/////////////////////////admins/////////////////////////////////
//get
public function getAllCarts(){
    $sessionEmailAdmin=Session::get('sessionAdmin');
    $sessionEmailSubAdmin=Session::get('sessionsubAdmin');
    $sessionViewCarts=Session::get('sessionViewCarts');
    if($sessionEmailAdmin||$sessionEmailSubAdmin){
        if($sessionViewCarts){
  
   $getAllCarts= Cart::get();
   if(empty($getAllCarts)){
    return redirect()->back()->with('flash_message_error','there is no any products now ');
   }
   return view('carts.get_all_carts')->with(compact('getAllCarts'));
}else{
    return redirect()->back()->with('flash_message_error','you have not admin auth to enter into this page ');

}
}else{
    return redirect()->back()->with('flash_message_error','you have not admin auth to enter into this page ');

}
}
public function getCart($cart_id=null){
    $sessionEmailAdmin=Session::get('sessionAdmin');
    if($sessionEmailAdmin){
    $cart=Cart::where(['id'=>$cart_id])->first();
    $cartCount=Cart::where(['id'=>$cart_id])->count();
    if($cartCount==0){
        return view('carts.get_cart')->with('flash_message_error','there is no any products now , so you must add product into your cart');
       }
    return view('carts.get_cart')->with(compact('cart'));
}else{
    return redirect()->back()->with('flash_message_error','you have not admin auth to enter into this page ');

}
}
//add-edit-delete

public function editCart($id=null,Request $req){
    $oneCart=Cart::find(['id'=>$id])->first();
    $sessionEmail=Session::get('sessionAdmin');
    if($sessionEmail){
        if($req->isMethod('post')){
            $data=$req->all();
            $oneCart->product_id=$data['product_id'];            
            $oneCart->product_name=$data['product_name'];            
            $oneCart->product_size=$data['product_size'];            
            $oneCart->product_price=$data['product_price'];            
            $oneCart->product_code=$data['product_code'];            
            $oneCart->product_color=$data['product_color'];            
            $oneCart->product_status=$data['product_status'];            
            $oneCart->user_email=$data['user_email'];
            $oneCart->save();
        }

    return view('carts.edit_cart')->with(compact('oneCart'));
}else {
    return redirect()->back()->with('flash_message_error','you havent access in this page view coupons');

}
}
public function deleteCart($id=null){
    $sessionEmail=Session::get('sessionAdmin');
    if($sessionEmail){
    $deleteCart=Cart::where(['id'=>$id])->first();
    $deleteCart->delete();
    return redirect('get-all-carts');
    }else {
        return redirect()->back()->with('flash_message_error','you have not admin auth to enter into this page ');
    }
}
/////////////////////////////users///////////////////////////
//get
public function getMyCarts($user_email=null){
    $allMyCarts= Cart::where(['user_email'=>$user_email])->get();
    $allMyCartsCount= Cart::where(['user_email'=>$user_email])->count();
    if($allMyCartsCount==0){
        return view('carts.get_my_carts')->with('flash_message_error','there is no any products now , so you must add product into your cart');
       }
 return view('carts.get_my_carts')->with(compact('allMyCarts'));
 }
 //add
    public function addToCart($product_attribute_id=null,Request $req){
        $sessionEmailUser=Session::get('sessionUser');
        if($sessionEmailUser){
            $ProductAttribute= ProductsAttribute::where(['id'=>$product_attribute_id])->first();
            $newCart=new Cart();
            $newCart->product_id=$ProductAttribute->product_id;            
            $newCart->product_name=$ProductAttribute->product_name;            
            $newCart->product_size=$ProductAttribute->product_size;            
            $newCart->product_price=$ProductAttribute->product_price;            
            $newCart->product_code=$ProductAttribute->product_code;            
            $newCart->product_color=$ProductAttribute->product_color;            
            $newCart->product_status=$ProductAttribute->product_status;            
            $newCart->user_email=$sessionEmailUser;
            $newCart->save();
            return redirect()->back()->with('flash_message_success','added into your cart successful');
    }else{
        return redirect()->back()->with('flash_message_error','you havent access in this page ,you can go into login-user now');
    }
}

    public function addCartFromAdmin($cart_id=null,Request $req){
        $sessionAdmin=Session::get('sessionAdmin');
        if($sessionAdmin){
            if($req->isMethod('post')){
                $data=$req->all();
                $userCount=User::where(['email'=>$data['email']])->count();
                if($userCount==0){
                    return redirect()->back()->with('flash_message_error','you cannt add this email , because this email is not exsit');
                }else {
                    if(empty($data['product_status'])){
                        $product_status=0;
                    }else{
                        $product_status=1;
    
                    }
                    $newCart=new Cart();
                    $newCart->product_id=$data['product_id'];            
                    $newCart->product_name=$data['product_name'];            
                    $newCart->product_size=$data['product_size'];            
                    $newCart->product_price=$data['product_price'];            
                    $newCart->product_code=$data['product_code'];            
                    $newCart->product_color=$data['product_color'];            
                    $newCart->product_status=$product_status;            
                    $newCart->user_email=$data['email'];
                    $newCart->save();
            return redirect()->back()->with('flash_message_success','added into your cart successful');
                }
            }
            return view('carts.add_cart_from_admin');
            }else{
                
                return redirect()->back()->with('flash_message_error','you havent access in this page ,you can go into login-user now');
            }
    }
    public function DeleteProductFromCart($product_id=null){
        $sessionAdmin=Session::get('sessionAdmin');
        if($sessionAdmin){
      $productInCart=  Cart::where(['product_id'=>$product_id])->first();
        $productInCart->delete();
        return redirect()->back()->with('flash_message_success','deleted success');
    }else {
          return redirect()->back()->with('flash_error_message','you havent access in this page ');
    }
    }



}
