<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Session;
use Auth;
use App\User;
use Crypt;
use Hash;
use DB;
use App\Country;
class AdminController extends Controller
{
    //
    public function addAdmin(Request $req){
        if($req->isMethod('post')){
            $data=$req->all();
        $encPass=    Crypt::encryptString($data['password']);
            $countAdmin=Admin::where(['email'=>$data['email']])->count();
                //if admin -> will put all it is 1 , if subAdmin will put it from data req
                if($data['type']=='subAdmin'){ 
                    if(empty($data['status'])){
                        $data['status']=0;
                    }else{
                        $data['status']=1;
            
                    }
                    if(empty($data['users_access'])){
                        $data['users_access']=0;
                    }else{
                        $data['users_access']=1;
            
                    }
                    if(empty($data['orders_access'])){
                        $orders_access=0;
                    }else{
                        $data['orders_access']=1;
            
                    }
                    if(empty($data['products_access'])){
                        $data['products_access']=0;
                    }else{
                        $data['products_access']=1;
            
                    }
                    if(empty($data['categories_view_access'])){
                        $data['categories_view_access']=0;
                    }else{
                        $data['categories_view_access']=1;
            
                    }
                    if(empty($data['categories_full_access'])){
                        $data['categories_full_access']=0;
                    }else{
                        $data['categories_view_access']=1;
            
                    }
                    if(empty($data['categories_edit_access'])){
                        $data['categories_edit_access']=0;
                    }else{
                        $data['categories_edit_access']=1;
            
                    }

                    //only sub admin hasnt any accesses
                    if(empty($data['users_access'])&&empty($data['orders_access'])&&empty($data['products_access'])&&empty($data['categories_access'])){
    
                        $data['users_access']=0;
                        $data['orders_access']=0;
                        $data['products_access']=0;
                        $data['categories_edit_access']=0;
                        $data['categories_full_access']=0;
                        $data['categories_view_access']=0;
                        $adminCount=Admin::where('email',$data['email'])->count();
                        if($adminCount==0){

                            Admin::insert(['email'=>$data['email'],'name'=>$data['name'],'password'=>$encPass,'type'=>$data['type'],'status'=>$data['status'],'categories_view_access'=>$data['categories_view_access'],'categories_edit_access'=>$data['categories_edit_access'],'categories_full_access'=>0,'orders_access'=>$data['orders_access'],'users_access'=>$data['users_access'],'products_access'=>$data['products_access']]);
                            return redirect()->back()->with('flash_message_success','add success');
                        }else{
                            return redirect()->back()->with('flash_message_error','you cannt add this email admin , because it is exist ');

                        }

                 
                    }else{
                        // subadmin has som accesses
                        Admin::insert(['email'=>$data['email'],'name'=>$data['name'],'password'=>$encPass,'type'=>$data['type'],'status'=>$data['status'],'categories_view_access'=>$data['categories_view_access'],'categories_edit_access'=>$data['categories_edit_access'],'categories_full_access'=>0,'orders_access'=>$data['orders_access'],'users_access'=>$data['users_access'],'products_access'=>$data['products_access']]);
                return redirect()->back()->with('flash_message_success','add success');
                       
                    }
                
                }else{
                    Admin::insert(['email'=>$data['email'],'name'=>$data['name'],'password'=>$encPass,'type'=>$data['type'],'status'=>1,'categories_full_access'=>1,'categories_view_access'=>0,'categories_edit_access'=>0,'orders_access'=>1,'users_access'=>1,'products_access'=>1]);
                return redirect()->back()->with('flash_message_success','add success');
                    
                }
            }
        return view('admins.add_admin');
    }
    public function loginAdmin(Request $req){
        if(Session::get('sessionUser')){
            Session::forget('sessionUser');

        }
        if(Session::get('sessionAdmin')){//عشان لو اجى عالراوت هادا وهو اصلا لوجين
            return redirect('/get-main-cats-for-admins')->with('flash_message_success','you are login exactly');
           

        }
        // , but finally according to type this admin
        // which some subAdmin will see some pages -> 0 in another pages which when 0 i will not put session , if 1 will put session to show it for his
        if($req->isMethod('post')){
            $data=$req->all();
            $adminCount=Admin::where('email',$data['email'])->count();
            if($adminCount>0){
            $admin=Admin::where('email',$data['email'])->first();
                
                 $secPAssDb=Crypt::decryptString($admin->password) ;
                 
                 if($secPAssDb==$data['password']){
                     if($admin->type=="Admin"){
                         Session::put('sessionAdmin',$data['email']);
                         Session::put('sessionEditCategory','edit cats');
                         Session::put('sessionViewProduct','view prods');
                         Session::put('sessionViewUser','view users');
                         Session::put('sessionViewCarts','view carts');
                     }elseif($admin->type=="SubAdmin"){
                        Session::put('sessionsubAdmin',$data['email']);
                        if($admin->categories_edit_access==1){
                             Session::put('sessionEditCategory','edit cats');
                         }elseif($admin->products_access==1){
                             Session::put('sessionViewProduct','view prods');
                         }elseif($admin->users_access==1){
                             Session::put('sessionViewUser','view users');
                         }elseif($admin->carts_access==1){
                             Session::put('sessionViewCarts','view carts');
                         }
                        }
                        $sessionAdmin=  Session::get('sessionAdmin');
                         $sessionsubAdmin= Session::get('sessionsubAdmin');
                         if($sessionsubAdmin||$sessionAdmin){
                            return redirect('/get-main-cats-for-admins')->with('flash_message_success','login success');
                        }
                 }else{
                     return redirect()->back()->with('flash_message_error','invalid password');
                 }

                
            }else{
                return redirect()->back()->with('flash_message_error','invalid your email ');

            }
        }
        return view('admins.login_admin');
    }
    public function logoutAdmin(){
        Auth::logout();
        Session::forget('sessionAdmin');
        Session::forget('sessionsubAdmin');
        Session::forget('sessionViewUser');
        Session::forget('sessionViewProduct');
        Session::forget('sessionViewCarts');
        Session::forget('sessionEditCategory');
        return redirect('login-admin');
    }
    public function viewAdmins(){
    $sessionEmailSubAdmin=Session::get('sessionsubAdmin');
        if(Session::get('sessionAdmin')||$sessionEmailSubAdmin){
            $admins=Admin::get();
            return view('admins.view_admins')->with(compact('admins'));
         }else{
            return redirect()->back()->with('flash_message_error','you have not admin auth to enter into this page ');
        }
    }

    public function editAdmin(Request $req , $id=null){
        $editAdmin=Admin::find(['id'=>$id])->first();
        if(Session::get('sessionAdmin')){
        
        if(!empty($id)){
            
            $thisAdminDetails= Admin::where(['id'=>$id])->first();
            if($req->isMethod('post')){
                
                $data=$req->all();
                $editAdminCount=Admin::find(['email'=>$data['email'] ])->count();
                if($data['type']=="Admin"){//from this case will avoid any changes from input access into db
                    $encPass=    Crypt::encryptString($data['password']);

                    if($editAdminCount==0){
                    $editAdmin->email=$data['email'];
                    $editAdmin->password=$encPass;
                    $editAdmin->status=$data['status'];
                    $editAdmin->categories_view_access=$data['categories_view_access'];
                    $editAdmin->products_access=$data['products_access'];
                    $editAdmin->carts_access=$data['carts_access'];
                    $editAdmin->users_access=$data['users_access'];
                    $editAdmin->save();
                    return redirect()->back()->with('flash_message_success','edit success');
                }else{
                    return redirect()->back()->with('flash_message_error','you cannt add this email admin , because it is exist ');


                }
                    return redirect('/admin/view-admins');
                }elseif($data['type']=='SubAdmin'){
                    $encPass=    Crypt::encryptString($data['password']);

                    $editAdmin->email=$data['email'];
                    $editAdmin->password=$encPass;
                    $editAdmin->status=$data['status'];
                    $editAdmin->categories_edit_access=$data['categories_edit_access'];
                    $editAdmin->products_access=$data['products_access'];
                    $editAdmin->carts_access=$data['carts_access'];
                    $editAdmin->users_access=$data['users_access'];
                    $editAdmin->save();
                    return redirect()->back()->with('flash_message_success','edit success');
                }
         
            }
 
        return view('admins.edit_admin')->with(compact('editAdmin'));
    }

    }else{
        return redirect()->back()->with('flash_message_error','you have not admin auth to enter into this page ');

    }
}
public function deleteAdmin( $id=null){
    if(Session::get('sessionAdmin')){
    
    $admin=Admin::where(['id'=>$id])->first();
    if(!empty($id)){
              $admin->delete();  
        }

    return redirect('/admin/view-admins');
}else{
    return redirect('home-page')->with('flash_message_error','you have not admin auth to enter into this page ');

}
}
///view users , edit, delete
public function viewUsers(){
    $sessionEmailAdmin=Session::get('sessionAdmin');
        $sessionEmailSubAdmin=Session::get('sessionsubAdmin');
        $sessionViewUser=Session::get('sessionViewUser');
        if($sessionEmailAdmin||$sessionEmailSubAdmin){
            if($sessionViewUser){
            $users=User::get();
            return view('admins.view_users')->with(compact('users'));
            }else{
            return redirect()->back()->with('flash_message_error','you have not admin auth to enter into this page ');

            }
    }else{
        return redirect()->back()->with('flash_message_error','you have not admin auth to enter into this page ');

    }
}


public function addUser(Request $req ){
    if(Session::get('sessionAdmin')){
        $getCountries=Country::get();
        if($req->isMethod('post')){
            $req->validate([
                'email'=>'required|email',
                'password'=>'required',
                'name'=>'required',
                'pincode'=>'required',
                'state'=>'required',
                'address'=>'required',
                'mobile'=>'required',
                'country_name'=>'required',
                ]);
            $data=$req->all();
            $userCount=User::where('email',$data['email'])->count();
            if($userCount==0){
                DB::table('users')->insert(['email'=>$data['email'],'password'=>Crypt::encryptString($data['password']),'name'=>$data['name'],'pincode'=>$data['pincode'],'state'=>$data['state'],'city'=>$data['city'],'address'=>$data['address'],'mobile'=>$data['mobile'],'country'=>$data['country_name']]);
                return redirect()->back()->with('flash_message_success','add user success');
            }else{
                return redirect()->back()->with('flash_message_error','this email user is exsit, pls , enter another email ');
            }
            }    
            return view('admins.add_user')->with(compact('getCountries'));
    }else{
        return redirect('home-page')->with('flash_message_error','you have not admin auth to enter into this page ');
    }
}
public function editUser(Request $req , $id=null){
    if(Session::get('sessionAdmin')){
        $getCountries=Country::get();

    $user=User::where(['id'=>$id])->first();
    if(!empty($id)){

        if($req->isMethod('post')){
            
            $data=$req->all();
            $editUser=User::find(['id'=>$id])->first();
            $editUser->email=$data['email'];
            $editUser->password=Crypt::encryptString($data['password']);
            $editUser->name=$data['name'];
            $editUser->pincode=$data['pincode'];
            $editUser->city=$data['city'];
            $editUser->state=$data['state'];
            $editUser->address=$data['address'];
            $editUser->mobile=$data['mobile'];
            $editUser->country=$data['country_name'];
            $editUser->save();
            return redirect()->back()->with('flash_message_success','edit user success');
  
            }    
        }

        return view('admins.edit_user')->with(compact('user','getCountries'));
}else{
    return redirect('home-page')->with('flash_message_error','you have not admin auth to enter into this page ');
}
}

public function deleteUser( $id=null){
    if(Session::get('sessionAdmin')){
    
    $user=User::where(['id'=>$id])->first();
    if(!empty($id)){
              $user->delete();  
        }

    return redirect('/admin/view-users');
}else{
    return redirect('home-page')->with('flash_message_error','you have not admin auth to enter into this page ');

}
}
}
