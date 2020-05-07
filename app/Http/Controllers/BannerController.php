<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Banner;
use Illuminate\Support\Facades\Input;
use Image;
use Session;
class BannerController extends Controller
{
    //
    public function viewBanners(){
        $sessionEmail=Session::get('sessionAdmin');
        if($sessionEmail){
        $banners=Banner::get();
        return view('banners.view_banners')->with(compact('banners'));
    }else{
        return redirect()->back()->with('flash_message_error','you havent auth  in this page ');
        
    }
    }
    public function addBanner(Request $req){
        $sessionEmail=Session::get('sessionAdmin');
        if($sessionEmail){
        if($req->isMethod('post')){
            $validateData = $req->validate([
                
                'banner_image'=>'required',
            ]);
            $data=$req->all();
            $newBanner= new  Banner;
            $newBanner->banner_status=$data['banner_status'];
            //upload image
            if($req->hasFile('banner_image')){
                $image_tmp=$req->file('banner_image');
               if($image_tmp->isValid()){
                   $extension=$image_tmp->getClientOriginalExtension();
                 $filename=rand(111,9999).'.'.$extension;
                   //save in folder
                   $banner_path='images/frontend_images/banners/'.$filename;
                   //resize, save
                       Image::make($image_tmp)->save($banner_path);
                      $newBanner->banner_image=$filename;
                   //store in db
                    $newBanner->banner_image=$filename;
               }
           }
           $newBanner->save();
           return redirect()->back()->with('flash_message_success','Banner has added successfully');
        }
        return view('banners.add_banner');
    }else{
        return redirect()->back()->with('flash_message_error','you havent access in this page ');
        
    }
    }

    public function editBanner(Request $req,$id=null){
        $sessionEmail=Session::get('sessionAdmin');
        if($sessionEmail){
        $editBanner=Banner::where(['id'=>$id])->first();
        if($req->isMethod('post')){
            $data=$req->all();
            $editBanner->banner_image=$data['banner_image'];
            $editBanner->banner_status=$data['banner_status'];
         
            $editBanner->save();
           return redirect()->back()->with('flash_message_success','Banner has edited successfully');
        }
        return view('banners.edit_banner')->with(compact('editBanner'));
    }else{
        return redirect()->back()->with('flash_message_error','you havent access in this page ');
        
    }
    }
    public function deleteBanner($id=null){
        $sessionEmail=Session::get('sessionAdmin');
        if($sessionEmail){
        $banner=Banner::where(['id'=>$id])->first();
        $banner->delete();
        return redirect()->back()->with('flash_message_success','Banner has deleted successfully');

    }   else{
        return redirect()->back()->with('flash_message_error','you havent access in this page ');
        
    }
}
}