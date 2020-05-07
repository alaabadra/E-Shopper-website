<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;
use Session;
use App\Banner;
use Image;

class CategoriesController extends Controller
{
    public function indexSlider()
    {
        $banners=Banner::where(['banner_status'=>1])->get();

        return view('index')->with(compact('banners'));
    }
    public function getCategories(){
        $meta_title = "all categories - e-comm sample website";
        $meta_description='all cats';
        $meta_keyword='all cats, quires-eshop web , online, men clothing';
        $allCategories=Category::get();
        foreach($allCategories as $cat){

            $subCats=Category::where(['parent_id'=>$cat->id])->get();

        }
      return    view('layout')->with(compact('meta_title','meta_description','meta_keyword'));
    }

////////////////////admins//////////////////////////////////////
//get
    public function getMainCatsForAdmins(){
        $sessionEmailAdmin=Session::get('sessionAdmin');
        $sessionsubAdmin= Session::get('sessionsubAdmin');
        if($sessionEmailAdmin||$sessionsubAdmin){
        $getMainCatsCount=Category::where(['parent_id'=>0])->count();
        if($getMainCatsCount>0){
            $getMainCats=Category::where(['parent_id'=>0])->get();
            return view('categories.get_main_cats_for_admins')->with(compact('getMainCats'));
        }else{
            return redirect()->back()->with('flash_message_error','sorry, not exsit any main categeries');
        }
        }else{
            return redirect('/login-admin');
        }
    }
    
    public function getSubCatsForAdmins($id=null){
        $sessionEmailAdmin=Session::get('sessionAdmin');
        $sessionsubAdmin= Session::get('sessionsubAdmin');
        if($sessionEmailAdmin||$sessionsubAdmin){
        $MainCatCount=Category::where(['id'=>$id])->count();
        if($MainCatCount>0){
            $MainCat=Category::where(['id'=>$id])->first();
         $SubCats=   Category::where(['parent_id'=>$MainCat->id])->get();
            return view('categories.get_sub_cats_for_admins')->with(compact('SubCats'));
        }else{
            return redirect()->back()->with('flash_message_error','sorry, not exsit any subs categeries');

        }
    }else{
        return redirect('/login-admin');
    }
    }

//add-edit-delete
public function addCategory(Request $req){
    $sessionEmailAdmin=Session::get('sessionAdmin');
    if($sessionEmailAdmin){
        $cats=Category::where(['parent_id'=>0])->get();
    if($req->isMethod('post')){
        $data=$req->all();
        $validateData = $req->validate([
            'category_url'=>'required|max:100|min:3|string',
            'category_sub_image'=>'required',
            'category_name'=>'required|max:100|min:3|string',
            'products_quantity'=>'required',
        ]);
        $catNameCount=Category::where(['category_name'=>$data['category_name']])->count();
        if($catNameCount!==0){
            return redirect()->back()->with('flash_message_error','this name category is exsit arleady ');
            
        }else{
            $catCount=  Category::where(['category_url'=>$data['category_url']])->count();
            if($catCount!=0){
              return redirect()->back()->with('flash_message_error','you cannt  add this category url  because is exsit  for a nother category');
            }else{
            $catCount=  Category::where(['category_name'=>$data['category_name']])->count();
            if($catCount!=0){
                return redirect()->back()->with('flash_message_error','you cannt  add this category anme because is exsit ');

            }else{
             $cats=  Category::get();
            foreach($cats as $cat){
            }
            $newCat=new Category();
            $newCat->category_name=$data['category_name'];
            $newCat->products_quantity=$data['products_quantity'];
            $newCat->category_url=$data['category_url'];
            $newCat->category_status=$data['category_status'];
            $newCat->products_quantity=$data['products_quantity'];
           $successSave= $newCat->save();
            if($successSave){
                $newCat2=new Category();
                $newCat2->category_name=$newCat->category_url;
                $newCat2->parent_id=$newCat->id;                       
                //upload image
                    if($req->hasFile('category_sub_image')){
                        $image_tmp=$req->file('category_sub_image');
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
                            $newCat2->category_image=$filename;
                            $newCat2->save();
                            return redirect()->back()->with('flash_message_success','add success');
                        }
                    }
        
                }
        }

    }
}
}
    return view('categories.add_category')->with(compact('cats'));
}else{
    return redirect('/login-admin');
}
}

public function addSubCategory(Request $req,$id=null){
    $sessionEmailAdmin=Session::get('sessionAdmin');
    if($sessionEmailAdmin){
        $cats=Category::where(['parent_id'=>0])->get();
        $catsAll=Category::where('parent_id','!=',0)->get();
        $MainCat=Category::where(['id'=>$id])->first();
        $MainCats=Category::where(['parent_id'=>0])->get();
        $categoryName=$MainCat->category_name;
        $categoryId=$MainCat->id;
        $subCats=   Category::where(['parent_id'=>$MainCat->id])->get();
        foreach($subCats as $sub)
        {

        }
        if($req->isMethod('post')){
            $data=$req->all();
                    $validateData = $req->validate([
                        'category_name'=>'required|max:18|min:3|string',
                        'category_image'=>'required',
                        'category_url'=>'required|string',
                    ]);
                    $newCat=new Category();
                    $newCat->category_name=$data['category_name'];
                    $newCat->category_url=$data['category_url'];
                    $newCat->category_status=$data['status'];
                    $newCat->parent_id=$sub->parent_id;
                  //upload image
                  if($req->hasFile('category_image')){
                    $image_tmp=$req->file('category_image');
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
                        $newCat->category_image=$filename;
                        $newCat->save();
                        return redirect()->back()->with('flash_message_success','add success');
                   }
               }
}
    return view('categories.add_sub_category')->with(compact('cats','catsAll','categoryName','categoryId','MainCats'));
}else{
    return redirect()->back()->with('flash_message_error','you have not admin auth to enter into this page ');

}
}
public function editParentCategory(Request $req, $id=null){
    $sessionEmailAdmin=Session::get('sessionAdmin');
    $sessionEmailSubAdmin=Session::get('sessionsubAdmin');
    $sessionEditCategory=Session::get('sessionEditCategory');
    if($sessionEmailAdmin||$sessionEmailSubAdmin){
            if($sessionEditCategory){
                if(!empty($id)){
                    $editCatCount=Category::where(['id'=>$id])->count();
                    if($editCatCount>0){
                        $editCat=Category::where(['id'=>$id])->first();
                        $parentsCats=Category::where(['parent_id'=>0])->get();
                        if($req->isMethod('post')){
                            $data=$req->all();    
                            $catNameCount=Category::where(['category_name'=>$data['category_name']])->count();
                        if($catNameCount!==0){
                            $catName=Category::where(['category_name'=>$data['category_name']])->first();
                                $validateData = $req->validate([
                                    'category_url'=>'required|max:100|min:3|string',
                                    'category_image'=>'required|max:100|min:3|string',
                                    'category_name'=>'required|max:100|min:3|string',
                                ]);
                               DB::table('categories')->where('id',$id)->update(['parent_id'=>0,'category_name'=>$data['category_name'],'category_url'=>$data['category_url'],'category_status'=>$data['category_status']]);
                               return redirect()->back()->with('flash_message_success','updated success');
                        }else{
                            $validateData = $req->validate([
                                'category_url'=>'required|max:100|min:3|string',
                                'category_name'=>'required|max:100|min:3|string',
                            ]);  
                           DB::table('categories')->where('id',$id)->update(['parent_id'=>0,'category_name'=>$data['category_name'],'category_url'=>$data['category_url'],'category_status'=>$data['category_status']]);
                           return redirect()->back()->with('flash_message_success','updated success');
                
                        }
                    }
                
                }
                }
            }else {
                return redirect()->back()->with('flash_message_error','you have not admin auth to enter into this page ');

            }  
}else{
    return redirect()->back()->with('flash_message_error','you have not admin auth to enter into this page ');
  
}
    return view('categories.edit_parent_category')->with(compact('editCat','parentsCats'));
}

public function editSubCategory(Request $req, $id=null){
    $sessionAdmin=Session::get('sessionAdmin');
        if($sessionAdmin){
    if(!empty($id)){
        $editCatCount=Category::where(['id'=>$id])->count();
        if($editCatCount>0){
    
            $editCat=Category::where(['id'=>$id])->first();
            $parentsCats=Category::where(['parent_id'=>0])->get();
           // echo '<pre>';print_r($parentsCats);die;
           if($req->isMethod('post')){
        
            $data=$req->all();    
            $catNameCount=Category::where(['category_name'=>$data['category_name']])->count();
        if($catNameCount!==0){
            $catName=Category::where(['category_name'=>$data['category_name']])->first();
                $validateData = $req->validate([
                    'category_url'=>'required|max:100|min:3|string',
                    'category_name'=>'required|max:100|min:3|string',
                ]);
               DB::table('categories')->where('id',$id)->update(['category_name'=>$data['category_name'],'category_image'=>$data['category_image'],'category_url'=>$data['category_url'],'category_status'=>$data['category_status']]);
               return redirect()->back()->with('flash_message_success','updated success');
        }else{
            $validateData = $req->validate([
                'category_url'=>'required|max:100|min:3|string',
                'category_name'=>'required|max:100|min:3|string',
            ]);
              
                
           DB::table('categories')->where('id',$id)->update(['category_name'=>$data['category_name'],'category_url'=>$data['category_url'],'category_status'=>$data['category_status']]);
           return redirect()->back()->with('flash_message_success','updated success');

        }
    }
        }else{
            return redirect()->back()->with('flash_message_error','this id category is not exist');
    
        }
        
    }
        return view('categories.edit_sub_category')->with(compact('editCat','parentsCats'));
}else{
    return redirect()->back()->with('flash_message_error','you have not admin auth to enter into this page ');

}
    }
public function deleteCategory($id=null){
    $sessionAdmin=Session::get('sessionAdmin');
    if($sessionAdmin){
    $deleteCatCount=Category::where(['id'=>$id])->count();
    if($deleteCatCount>0){

        $deleteCat=Category::where(['id'=>$id])->first();
        $deleteCat->delete();
        return redirect('get-main-cats-for-admins');
    }else {
        return redirect()->back()->with('flash_message_error','this id category is not exist');
       
    }

}else {
    return redirect()->back()->with('flash_message_error','you have not admin auth to enter into this page ');

}
}
//////////////////////////users/////////////////////////////////
    public function getMainCatsForUsers(){
            $getMainCatsCount=Category::where(['parent_id'=>0])->count();
        if($getMainCatsCount>0){
        $getMainCats=Category::where(['parent_id'=>0])->get();
   $banners=Banner::where(['banner_status'=>1])->get();
        return view('categories.get_main_cats_for_users')->with(compact('getMainCats','banners'));
    }else{
        return redirect()->back()->with('flash_message_error','sorry, not exsit any main categeries');
    }
    }

    public function getMainCatsForUsersLayout(){
        $sessionEmailUser=Session::get('sessionUser');
        if($sessionEmailUser){
        $getMainCats=Category::where(['parent_id'=>0])->get();
        return view('layout')->with(compact('getMainCats'));
    }else{
        return view('users.login_user');
    }
    }
    public function getSubCatsForUsers($id=null){
        $MainCat=Category::where(['id'=>$id])->first();
     $SubCats=   Category::where(['parent_id'=>$MainCat->id])->get();
     $SubCatsCount=   Category::where(['parent_id'=>$MainCat->id])->count();
          $breadcrumb = "<a href='/home-page' style='  color: #ff00bc;
          text-decoration: none;
          font-size: 19px;'>Home</a> > <a href='/get-sub-cats-for-users/".$MainCat->id."'style='color: #ff00bc;
          text-decoration: none;
          font-size: 19px;
      '>".$MainCat->category_name."</a> ";//when click on this url act will go into this link url means that go into show all products in this cat , which is هي اصلا معروضة في الصفحة اللي انا فيها
        return view('categories.get_sub_cats_for_users')->with(compact('SubCats','SubCatsCount','breadcrumb','MainCat'));

    }

    public function getSubCatsForUsersLayout($id=null){
        $sessionEmailUser=Session::get('sessionUser');
        if($sessionEmailUser){
        $MainCat=Category::where(['id'=>$id])->first();
     $SubCats=   Category::where(['parent_id'=>$MainCat->id])->get();
        return view('layout')->with(compact('SubCats'));
    }else{   
        return view('users.login_user');
    }

    }
}
