<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsletterSubscriber;
class NewsletterSubscriberController extends Controller
{
    //
    public function checkSubscriberEmail(Request $req){
            if($req->isMethod('post')){
                $data=$req->all();
                $subscriberEmailCount=NewsletterSubscriber::where('email',$data['subscriber'])->count();//check if exist or no
                if($subscriberEmailCount>0){
                    echo'exist';
                }else{
                    $emailInsert=NewsletterSubscriber::insert(['email'=>$data['subscriber']]);
                    echo'not exist';

                }
            }
    }
}
