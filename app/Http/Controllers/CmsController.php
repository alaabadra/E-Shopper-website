<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cms;
use DB;
use Mail;
use Session;
class CmsController extends Controller
{
    //
    public function getCms(){
        $allCms=Cms::get();
        return view('cms.view_cms')->with(compact('allCms'));
    }
    public function editCms($id=null,Request $req){
        $sessionEmail=Session::get('sessionAdmin');
        if($sessionEmail){
        
        $oneCms=Cms::find(['id'=>$id])->first();
        if($req->isMethod('post')){
            $validateData = $req->validate([
                'title'=>'required|max:18|min:3|string',
                'description'=>'required|max:100|min:3|string',
                'url'=>'sometimes|url'
    
               
                
            ]);
            if(empty($data['status'])){
                $status=0;
            }else{
                $status=1;
    
            }
            $data=$req->all();
            $oneCms->title=$data['title'];
            $oneCms->description=$data['description'];
            $oneCms->url=$data['url'];
            $oneCms->status=$status;
            $oneCms->save();
        }

        return view('cms.edit_cms')->with(compact('oneCms'));
    }else{
        return redirect()->back()->with('flash_message_error','you havent access in this page ');
        
    }
    }
    public function addCms(Request $req){
        $sessionEmail=Session::get('sessionAdmin');
        if($sessionEmail){
        if($req->isMethod('post')){
            $data=$req->all();
            $validateData = $req->validate([
                'title'=>'required|max:18|min:3|string',
                'description'=>'required|max:100|min:3|string',
                'url'=>'sometimes|url'
            ]);
            if(empty($data['status'])){
                $status=0;
            }else{
                $status=1;

            }
            $addCms=new Cms();
            $addCms->title=$data['title'];
            $addCms->description=$data['description'];
            $addCms->url=$data['url'];
            $addCms->status=$status;
            $addCms->save();
        }
        return view('cms.add_cms');
    }else{
        return redirect()->back()->with('flash_message_error','you havent access in this page view coupons');
        
    }
    }
    public function deleteCms($id=null){
        $sessionEmail=Session::get('sessionAdmin');
        if($sessionEmail){
      $cms=  Cms::find(['id',$id])->first();
      $deleteCms=$cms->delete();
      return redirect('/view-cms');
    }else{
        return redirect()->back()->with('flash_message_error','you havent access in this page view coupons');
        
    }
    }
//this fun will call it in footer
    public function contact(Request $req){
        $sessionEmail=Session::get('sessionUser');
        if($sessionEmail){
        if($req->isMethod('post')){
            $validateData = $req->validate([
                'name'=>'required|string',
                'email'=>'required|string|email',
                'subject'=>'required|string',
                'message'=>'required|string',
            ]);
            $data=$req->all();
            $emailAdmin="alaabadra44@gmail.com";//email company
            $messageData=[
                'name'=>$data['name'],
                'email'=>$data['email'],
                'subject'=>$data['subject'],
                'comment'=>$data['message'],
            
            ];
            Mail::send('emails.enquiry',$messageData,function($message)use($emailAdmin){
                $message->to($emailAdmin)->subject('enquiry from e-com website');
            });
              return redirect()->back()->with('flash_message_success','thanks for your enqiuery');
        }

            return view('pages.contact');
        }else{
            return redirect()->back()->with('flash_message_error','you havent access in this page, please login  ');
            
        }
        
    }
}
