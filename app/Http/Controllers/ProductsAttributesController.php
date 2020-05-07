<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductsAttribute;
use Image;
use Session;
class ProductsAttributesController extends Controller
{
    //
    public function viewProductAttribute(){
      $ProductsAttributes=  ProductsAttribute::get();
        return view('productsAttributes.get_products_attributes')->with(compact('ProductsAttributes'));
    }
    public function addProductAttribute(Request $req){
        $sessionEmail=Session::get('sessionAdmin');
        if($sessionEmail){
      $ProductsAttributes=  ProductsAttribute::get();
        if($req->isMethod('post')){
            $data=$req->all();
            if(empty($data['product_status'])){
                $status=0;
            }else{
                $status=1;
    
            }
            $addProdAtt=new ProductsAttribute();
            $addProdAtt->product_id=$data['product_id'];
            $addProdAtt->product_size=$data['product_size'];
            $addProdAtt->product_price=$data['product_price'];
            $addProdAtt->product_code=$data['product_code'];
            $addProdAtt->product_color=$data['product_color'];
            $addProdAtt->product_status=$status;
            $addProdAtt->product_name=$data['product_name'];
            $addProdAtt->pincode=$data['pincode'];
            //upload image
          if($req->hasFile('product_image')){
            $image_tmp=$req->file('product_image');
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
                $addProdAtt->product_image=$filename;
                $addProdAtt->save();
                    return redirect()->back()->with('flash_message_success','add success');
           }
       }
           
        }
        return view('productsAttributes.add_product_attribute')->with(compact('ProductsAttributes'));
    
    }else{
        return redirect()->back()->with('flash_message_error','you havent access in this page ');
        
    }
    }
    public function editProductAttribute($id=null,Request $req){
        $sessionEmail=Session::get('sessionAdmin');
        if($sessionEmail){
      $ProductsAttributes=  ProductsAttribute::get();
            $editProdAtt=ProductsAttribute::where(['id'=>$id])->first();
            if($req->isMethod('post')){
                $data=$req->all();    
                if(empty($data['product_status'])){
                    $status=0;
                }else{
                    $status=1;
        
                }
                $editProdAtt->product_id=$data['product_id'];
                $editProdAtt->product_size=$data['product_size'];
                $editProdAtt->product_price=$data['product_price'];
                $editProdAtt->product_code=$data['product_code'];
                $editProdAtt->product_color=$data['product_color'];
                $editProdAtt->product_status=$status;
                $editProdAtt->product_name=$data['product_name'];
                $editProdAtt->product_image=$data['product_image'];
                $editProdAtt->save();
                return redirect()->back()->with('flash_message_success','edit success');

            }
        return view('productsAttributes.edit_product_attribute')->with(compact('editProdAtt','ProductsAttributes'));
    }else{
        return redirect()->back()->with('flash_message_error','you havent access in this page view coupons');
    }
    }
    public function deleteProductAttribute($id=null){
        $sessionEmail=Session::get('sessionAdmin');
        if($sessionEmail){
        // if(!empty($id)){
            $ProductsAttribute=ProductsAttribute::where(['id'=>$id])->first();
            $ProductsAttribute->delete();
            return redirect()->back()->with('flash_message_success','deleted success');
        // }

    }else{
        return redirect()->back()->with('flash_message_error','you havent access in this page view coupons');
        
    }
    }
}
