<?php

namespace App\Http\Controllers;
use App\Category;
use App\ProductsAttribute;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Product;
use App\MyFav;
use App\Country;
use App\Pincode;
use Illuminate\Support\Facades\Redirect;
use App\SimilarProduct;
use Auth;
use Illuminate\Support\Facades\Input;
use Image;
use App\Review;
use Mail;
use App\Order;
use App\Delivery;
use App\OrdersProduct;
use App\User;
class ProductsController extends Controller
{
    //////////////////admins//////////////////////////////
//get

public function index() {
    $msg = "This is a simple message.";
    return response()->json(array('msg'=> $msg), 200);
 }
    public function getProductsThisSubCatForAdmins($id=null){
        $sessionEmailAdmin=Session::get('sessionAdmin');
        $sessionEmailSubAdmin=Session::get('sessionSubAdmin');
        $sessionViewProduct=Session::get('sessionViewProduct');
        if($sessionEmailAdmin||$sessionEmailSubAdmin){
            if($sessionViewProduct){
            $categoryThisProd=Category::where(['id'=>$id])->first();
            $productNameInThisCat=$categoryThisProd->category_name;
            $productsThisSubCats=Product::where(['category_id'=>$id])->get();
            $productsThisSubCatsCount=Product::where(['category_id'=>$id])->count();
            if($productsThisSubCatsCount==0){
                return view('products.get_products_for_admins')->with('flash_message_error','there is no any products in this category , you can add it ');
            }
        
            return view('products.get_products_for_admins')->with(compact('productsThisSubCats','productNameInThisCat','productsThisSubCatsCount'));
        }else{
        return redirect()->back()->with('flash_message_error','you have not admin auth to enter into this page ');
       
    }
}else {
    return redirect()->back()->with('flash_message_error','you have not admin auth to enter into this page ');

}
    }
    public function viewSimilarProductsAdmins($product_url=null){
        $sessionEmailAdmin=Session::get('sessionAdmin');
        if($sessionEmailAdmin){
      $products=  Product::where(['product_url'=>$product_url])->first();
        $similarproducts=SimilarProduct::where(['product_id'=>$products->id])->get();
        return view('products.view_similar_products_for_admins')->with(compact('similarproducts'));
    }else{
        return redirect('/login-admin');
    }
    }

    public function viewDetailsProductAdmin($product_id=null){
        $sessionEmailAdmin=Session::get('sessionAdmin');
        if($sessionEmailAdmin){
        $pincodes=Pincode::get();

        $product=ProductsAttribute::where(['product_id'=>$product_id])->get();
        return view('products.view_details_product_for_admins')->with(compact('product','pincodes','productName','sessionEmailAdmin'));
    }else{
        return redirect('/login-admin');
    }
    }
//add-edit-delete
public function addproduct(Request $req){
    $getCountries=Country::get();
    $sessionEmailAdmin=Session::get('sessionAdmin');
    if($sessionEmailAdmin){
    $parentCats = Category::where(['parent_id'=>0])
    ->get();
    $dropdown="<option selected disabled>select</option>";
    foreach($parentCats as $parentCat ){
        $dropdown .= "<option value='".$parentCat->id."' disabled>".$parentCat->category_name."</option>";
        $subsparentCats = Category::where(['parent_id'=>$parentCat->id])->get();
        foreach($subsparentCats as $subsparentCat){
        $dropdown .= "<option value='".       
        $subsparentCat->id."'  >&nbsp;--&nbsp;".$subsparentCat->category_name."</option>";
        //    $parentAndSubCatDropdown=  $dropdown . $subsparentCats;
        }
    }
    if($req->isMethod('post')){
            $data=$req->all();
            $validateData = $req->validate([
                'product_name'=>'required|min:3|string',
                'product_image'=>'required',
            ]);
           
        /////////////////////////
        $newProd=new Product();
        if(empty($data['category_id']) ){

            return redirect()->back()->with('flash_message_error','you must add the sub category that will the product in it ');
        }else{
            $newProd->category_id=$data['category_id'];

        }
      $prodCount=  Product::where(['product_name'=>$data['product_name']])->count();
      if($prodCount!=0){
        return redirect()->back()->with('flash_message_error','you cannt  add this product name because is exsit ');

      }else{

          $newProd->product_name=$data['product_name'];
          $newProd->feature=$data['feature'];
          $newProd->type=$data['type'];
          $newProd->product_status=$data['product_status'];
            //upload image
            if($req->hasFile('product_image')){
              $image_tmp=$req->file('product_image');
             if($image_tmp->isValid()){
                 $extension=$image_tmp->getClientOriginalExtension();
                $filename=rand(111,9999).'.'.$extension;
                 //save in folder
                 $image_path='images/backend_images/products/'.$filename;
                  $small_image_path='images/backend_images/products/small/'.$filename;
                  $medium_image_path='images/backend_images/products/medium/'.$filename;
                  $large_image_path='images/backend_images/products/large/'.$filename;
                  //resize, save
                  Image::make($image_tmp)->resize(300,300)->save(public_path($small_image_path));
                  //store in db
                  $newProd->product_image=$filename;
                  $newProd->save();
                      return redirect()->back()->with('flash_message_success','add success');
             }
         }
      }
    
      
    }

    return view('products.add_product')->with(compact('dropdown','getCountries'));
}else{
    return redirect('/login-admin');
}
}

public function addDetailsProduct(Request $req,$id=null){
    $sessionEmailAdmin=Session::get('sessionAdmin');
    if($sessionEmailAdmin){
        $product=Product::where(['id'=>$id])->first();
        $productName=$product->product_name;
        $productId=$product->id;
        if($req->isMethod('post')){
            $data=$req->all();
                $validateData = $req->validate([
                    'product_name'=>'required|min:3|string',
                    'product_image'=>'required',
                    'product_size'=>'required|string',
                    'product_price'=>'required|integer',
                    'product_color'=>'required|string'
                ]);
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
                $newProdAttr=new ProductsAttribute();
                $newProdAttr->product_id=$id;
                $newProdAttr->product_name=$data['product_name'];
                $newProdAttr->product_size=$data['product_size'];
                $newProdAttr->product_price=$data['product_price'];
                $newProdAttr->product_color=$data['product_color'];
                $newProdAttr->product_image=$filename;
                $newProdAttr->save();
                return redirect()->back()->with('flash_message_success','add success');
         }
       }
    }
    return view('products.add_details_into_product')->with(compact('productName','productId'));
}else{
    return redirect('/login-admin');
}
}

public function editDetailsProduct($id=null,Request $req){
    $sessionEmailAdmin=Session::get('sessionAdmin');
    if($sessionEmailAdmin){
       $editProd=ProductsAttribute::where(['id'=>$id])->first();
    if($req->isMethod('post')){
        $data=$req->all();    
           ProductsAttribute::where(['id'=>$id])->update(['product_name'=>$data['product_name'],'product_image'=>$data['product_image'],'product_size'=>$data['product_size'],'product_size'=>$data['product_size'],'product_price'=>$data['product_price'],'product_color'=>$data['product_color']]);
           return redirect()->back()->with('flash_message_success','updated success'); 
    }
            return view('products.edit_details_product')->with(compact('editProd'));
    }else{
        return redirect('/login-admin');
    }
}
public function deleteDetailsProduct($id=null){
    $sessionEmailAdmin=Session::get('sessionAdmin');
    if($sessionEmailAdmin){
    $deleteProdAtt=ProductsAttribute::where(['id'=>$id])->first();
    $deleteProdAtt->delete();
    return redirect()->back()->with('flash_message_success','deleted success');
}else{
    return redirect('/login-admin');
}
}
public function viewDetailsProductForAdmin($id=null){
    $prodId=$id;
    $detailsThisProductCount=ProductsAttribute::where(['product_id'=>$id])->count();
    if($detailsThisProductCount==0){
        return view('products.view_details_product_admin')->with(compact('prodId'));
    }
        $allProductsForThisProd=   ProductsAttribute::where(['product_id'=>$id])->get();
        $prodName=   ProductsAttribute::where(['product_id'=>$id])->first();
           return view('products.view_details_product_admin')->with(compact('allProductsForThisProd','prodId','detailsThisProductCount','prodName'));
}

public function editproduct($id=null,Request $req){
    $sessionEmailAdmin=Session::get('sessionAdmin');
    if($sessionEmailAdmin){
       $editProd=Product::where(['id'=>$id])->first();
    $parentCats = Category::where(['parent_id'=>0])
    ->get();
    $dropdown="<option selected disabled>select</option>";
    foreach($parentCats as $parentCat ){
        $dropdown .= "<option value='".$parentCat->id."' disabled>".$parentCat->category_name."</option>";
        $subsparentCats = Category::where(['parent_id'=>$parentCat->id])->get();
        foreach($subsparentCats as $subsparentCat){
        $dropdown .= "<option class='form-control' value='".       
        $subsparentCat->id."' @if($subsparentCat->product_name==$editProd->product_name) selected  @endif >&nbsp;--&nbsp;".$subsparentCat->category_name."</option>";
        }
    }

    if($req->isMethod('post')){
        $data=$req->all();    
        $prodNameCount=Product::where(['product_name'=>$data['product_name']])->count();
    if($prodNameCount!==0){
        $prodName=Product::where(['product_name'=>$data['product_name']])->first();
            $validateData = $req->validate([
                'category_id'=>'required',
                'product_name'=>'required|max:100|min:3|string',
                'product_image'=>'required',
            ]);
           DB::table('products')->where('id',$id)->update(['category_id'=>$data['category_id'],'product_name'=>$data['product_name'],'product_image'=>$data['product_image'],'product_status'=>$data['product_status']]);
           return redirect()->back()->with('flash_message_success','updated success');
                    return redirect()->back()->with('flash_message_success','updated success');
    }else{
        $validateData = $req->validate([
            'product_name'=>'required|max:100|min:3|string',
            'category_id'=>'required',
            'product_image'=>'required|max:100|min:3|string',
        ]);
          
           DB::table('products')->where('id',$id)->update(['category_id'=>$data['category_id'],'product_name'=>$data['product_name'],'product_image'=>$data['product_image'],'product_status'=>$data['product_status']]);
           return redirect()->back()->with('flash_message_success','updated success');
    }
}
            return view('products.edit_product')->with(compact('editProd','dropdown'));
    }else{
        return redirect('/login-admin');
    }
}

public function deleteproduct($id=null){
    $sessionEmailAdmin=Session::get('sessionAdmin');
    if($sessionEmailAdmin){
    $deleteProd=Product::where(['id'=>$id])->first();
    $deleteProd->delete();
    return redirect()->back()->with('flash_message_success','deleted success');

}else{
    return redirect('/login-admin');
}
}

    ////////////////////////users////////////////////////
//get
    public function getProductsThisSubCatForUser(Request $req, $id=null,$catUrl=null){
        $productsThisSubCats=Product::where(['category_id'=>$id])->get();
            $categoryThisProd=Category::where(['id'=>$id])->first();
            $productNameInThisCat=$categoryThisProd->category_name;
            $productsThisSubCatsFirst=Product::where(['category_id'=>$id])->first();
            $productsThisSubCatsCount=Product::where(['category_id'=>$id])->count();
                $productsUrlInThisCat= Category::where(['category_url'=>$catUrl])->first();
                $mainCategory = Category::where('id',$productsUrlInThisCat->parent_id)->first();
                $breadcrumb = "<a href='/home-page'style='  color: #ff00bc;
                text-decoration: none;
                font-size: 19px;'>Home</a> > <a href='/get-sub-cats-for-users/".$mainCategory->id."'style='  color: #ff00bc;
                text-decoration: none;
                font-size: 19px;'>".$mainCategory->category_name."</a> > <a href='/get-products-for-users/".$productsUrlInThisCat->id."/".$productsUrlInThisCat->category_url."'style='  color: #ff00bc;
                text-decoration: none;
                font-size: 19px;'>".$productsUrlInThisCat->category_name."</a>";//when click on this url act will go into this link url means that go into show all products in this cat , which is هي اصلا معروضة في الصفحة اللي انا فيها
                $getAllProds=Product::get();
                foreach($getAllProds as $prod){
        
                    $catThisProd=Category::where(['id'=>$prod->category_id]);
                    $productName=$prod->product_name;
                }
            $data=$req->all();
            
            if(!empty($_GET['color'])){
                $colorArray=explode('-',$_GET['color']);
                $productsThisSubCats=$getAllProds->whereIn('product_color',$colorArray);
            }
            if(!empty($_GET['size'])){
                $sizeArray=explode('-',$_GET['size']);
                $productsThisSubCats=$getAllProds->whereIn('product_size',$sizeArray);
            }
            if(!empty($_GET['price'])){
                $priceArray=explode('-',$_GET['price']);
                $productsThisSubCats=$getAllProds->whereIn('product_price',$priceArray);
            }
            if(!empty($_GET['sleeve'])){
                $sleeveArray=explode('-',$_GET['sleeve']);
                
                $prods=$prods->whereIn('sleeve',$sleeveArray);
            }
            
            $colors=Product::select('product_color')->groupBy('product_color')->get();
            $sizes=Product::select('product_size')->groupBy('product_size')->get();
            $prices=Product::select('product_price')->groupBy('product_price')->get();
            return view('products.get_products_for_users')->with(compact('productsUrlInThisCat','productsThisSubCatsFirst','productsThisSubCats','productsThisSubCatsCount','productNameInThisCat','colors','catUrl','catThisProd','categoryThisProd','sizes','prices','breadcrumb','SubCats'));
    }
    public function viewDetailsProduct($product_id=null,$catId=null){
            $productsUrlInThisCat= Category::where(['id'=>$catId])->first();
            $parentId= $productsUrlInThisCat->parent_id;
            $productName=ProductsAttribute::where(['product_id'=>$product_id])->first();
            $mainCategory = Category::where('id',$parentId)->first();
            $mainCategoryCount = Category::where('id',$productsUrlInThisCat->parent_id)->count();
            if($productName && $mainCategory){

                $breadcrumb = "<a href='/home-page' style='  color: #ff00bc;
                text-decoration: none;
                font-size: 15px;'>Home</a> > <a href='/get-sub-cats-for-users/".$mainCategory->id."'style='  color: #ff00bc;
                text-decoration: none;
                font-size: 15px;'>".$mainCategory->category_name."</a> > <a href='/get-products-for-users/".$productsUrlInThisCat->id."/".$productsUrlInThisCat->category_url."'style='  color: #ff00bc;
                text-decoration: none;
                font-size: 15px;'>".$productsUrlInThisCat->category_name."</a>  > <a href='/view-details-product/".$product_id."/".$productsUrlInThisCat->id."'style='  color: #ff00bc;
                text-decoration: none;
                font-size: 15px;'>".$productName->product_name."</a> ";//when click on this url act will go into this link url means that go into show all products in this cat , which is هي اصلا معروضة في الصفحة اللي انا فيها
            }
            $pincodes=Pincode::get();
            
            $product=ProductsAttribute::where(['product_id'=>$product_id])->get();
            $productName=ProductsAttribute::where(['product_id'=>$product_id])->first();
            $colors=ProductsAttribute::select('product_color')->groupBy('product_color')->get();
        if(!empty($_GET['color']))
        {
            $colorsarr=explode('-',$_GET['color']);
            $product=  $product->whereIn('product_color',$colorsarr);//
        }
        $sizes=ProductsAttribute::select('product_size')->groupBy('product_size')->get();
        if(!empty($_GET['size']))
        {
        $sizesarr=explode('-',$_GET['size']);
        $product=  $product->whereIn('product_size',$sizesarr);//
        }
        

        $prices=ProductsAttribute::select('product_price')->groupBy('product_price')->get();
        if(!empty($_GET['price']))
        {
        $pricesarr=explode('-',$_GET['price']);
        $product=  $product->whereIn('product_price',$pricesarr);//
        }
        return view('products.view_details_product_for_users')->with(compact('productsUrlInThisCat','mainCategoryCount','product','pincodes','productName','sessionEmailUser','product_id','colors','sizes','prices','breadcrumb'));
    }



    public function viewDetailsProductAttr($product_Attr_id=null){
        $pincodes=Pincode::get();
        $product=ProductsAttribute::where(['id'=>$product_Attr_id])->get();
        $productName=ProductsAttribute::where(['id'=>$product_Attr_id])->first();
        $colors=ProductsAttribute::select('product_color')->groupBy('product_color')->get();
        if(!empty($_GET['color']))
        {
        $colorsarr=explode('-',$_GET['color']);
        $product=  $product->whereIn('product_color',$colorsarr);//
        }


        $sizes=ProductsAttribute::select('product_size')->groupBy('product_size')->get();
        if(!empty($_GET['size']))
        {
        $sizesarr=explode('-',$_GET['size']);
        $product=  $product->whereIn('product_size',$sizesarr);//
        }
        

        $prices=ProductsAttribute::select('product_price')->groupBy('product_price')->get();
        if(!empty($_GET['price']))
        {
        $pricesarr=explode('-',$_GET['price']);
        $product=  $product->whereIn('product_price',$pricesarr);//
        }
        return view('products.view_details_product_attr_for_users')->with(compact('product','pincodes','productName','sessionEmailUser','product_Attr_id','colors','sizes','prices'));
    }
    public function viewSimilarProducts($product_url=null){
        $sessionEmailUser=Session::get('sessionUser');
        if($sessionEmailUser){
      $products=  Product::where(['product_url'=>$product_url])->first();
        $similarproducts=SimilarProduct::where(['product_id'=>$products->id])->get();
        return view('products.view_similar_products_for_users')->with(compact('similarproducts'));
    }else{
        return redirect('/login-user');
    }

    }

    public function getProdutForThisCategory($url=null){//هادا الروات عشان تظهر صفحة الفتلر وابعت معها رابط الفئة اللي هو اسم المنتج
        $productsUrlInThisCat= Category::where(['category_url'=>$url])->first();
        $catUrl=$productsUrlInThisCat->category_url;
        $productsNameInThisCat=  Product::where(['category_id'=>$productsUrlInThisCat->id])->get();
        $catName=$productsUrlInThisCat->category_name;
        $colors=Product::select('product_color')->groupBy('product_color')->get();
        $colors=array_flatten(json_decode(json_encode($colors),true));
            if(!empty($_GET['color']))
            {

            $colorArray=explode('-',$_GET['color']);
            $productsNameInThisCat=  $productsNameInThisCat->whereIn('product_color',$colorArray);//
            }
        $mainCategory = Category::where('id',$productsUrlInThisCat->parent_id)->first();
        $breadcrumb = "<a href='/'>home</a>/ <a href='".$mainCategory->category_url."'>".$mainCategory->category_name."</a> / <a href='".$productsUrlInThisCat->category_url."'>".$productsUrlInThisCat->category_name."</a>";//when click on this url act will go into this link url means that go into show all products in this cat , which is هي اصلا معروضة في الصفحة اللي انا فيها
        return view ('products.get_products_for_this_cat')->with(compact('productsThisCat','catName','breadcrumb','catUrl','productsNameInThisCat','colors'));

    }
    public function checkPincodeProduct(Request $req){
            if($req->isMethod('post')){
             $data = $req->all();
             $pincodeCount = DB::table('pincodes')->where('pincode',$data['pincode'])->count();
             if($pincodeCount>0){
                echo 'exist';
             }else{
                 $pincodeInsert=Pincode::insert(['pincode'=>$data['pincode']]);
                 echo 'not exsit';

             }
        }

    }

    public function addProductToMyFavourite(Request $req,$product_id=null,$product_name=null,$size=null,$price=null){
        $sessionEmailUser=Session::get('sessionUser');
        if($sessionEmailUser){
            $favsCount=DB::table('my_fav')->where(['user_email'=>$sessionEmailUser,'product_name'=>$product_name,'product_id'=>$product_id,'size'=>$size,'price'=>$price])->count();
           if($favsCount==0){
               DB::table('my_fav')->insert(['product_id'=>$product_id,'product_name'=>$product_name,'user_email'=>$sessionEmailUser,'size'=>$size,'price'=>$price]);
               return redirect()->back()->with('flash_message_success','add this product in your fav');
           }
           else{
            return redirect()->back()->with('flash_message_error','you added it before time');

           }
        }
        else{
            return redirect()->back()->with('flash_message_error','you havent access in this page ,you can go into login-user now');

        }
    }
    public function viewMyFavourites(){
        $sessionEmailUser=Session::get('sessionUser');
        $favs=DB::table('my_fav')->where(['user_email'=>$sessionEmailUser])->get();
        $favsCount=DB::table('my_fav')->where(['user_email'=>$sessionEmailUser])->count();
        if($favsCount==0){
            return view('favs.view_my_favs')->with('flash_message_error','there is no any products in your favs  now , so you must add product into your fav');
           }
        return view('favs.view_my_favs')->with(compact('favs'));
    }
    public function deleteFromMyFavourites($id=null){
      $prodFav=  DB::table('my_fav')->where(['id'=>$id]);
        $prodFav->delete();
        return redirect()->back()->with('flash_message_success','deleted success');
    }
    public function productsFilter(Request $req){// هادا عشان الريكسوت اخد منه واعمل الشغلات حسب هادا الريكسوزت بحيث انو بعد م اعهمل الشغلات هادي بدي اوديه ع راوت اللي هو المفروض هو عبارة عن عرض لتنفيذ هاي الشغلات
        $getAllProds=Product::get();
        foreach($getAllProds as $prod){
            $catThisProd=Category::where(['id'=>$prod->category_id]);
            $productName=$prod->product_name;
        }
        $data=$req->all();
        $colorUrl="";
        if(!empty($data['colorFilter'])){
            foreach($data['colorFilter'] as $color){
                if(empty($colorUrl)){
                    
                    $colorUrl='&color='.$color;//the first loop 
                    
                }else{
                    $colorUrl.='-'.$color;
                    
                }
            }
        }
        $finalUrl="get-products-for-users/".$data['id']."/".$data['url']."?".$colorUrl;
        return redirect::to($finalUrl);
        
      
            }

            public function productsFilterForViewDetails(Request $req){// هادا عشان الريكسوت اخد منه واعمل الشغلات حسب هادا الريكسوزت بحيث انو بعد م اعهمل الشغلات هادي بدي اوديه ع راوت اللي هو المفروض هو عبارة عن عرض لتنفيذ هاي الشغلات
                $getAllProds=Product::get();
                foreach($getAllProds as $prod){
        
                    $catThisProd=Category::where(['id'=>$prod->category_id]);
                    $productName=$prod->product_name;
                }
                $data=$req->all();
                $colorUrl="";
                if(!empty($data['colorFilter'])){
                    foreach($data['colorFilter'] as $color){
                        if(empty($colorUrl)){
                            
                            $colorUrl='&color='.$color;//the first loop 
                            
                        }else{
                            $colorUrl.='-'.$color;
                            
                        }
                    }
                }
                $finalUrl="view-details-product/".$data['id']."/".$data['url']."?".$colorUrl;
                return redirect::to($finalUrl);
                    }

                    public function productsFilterSizeForViewDetails(Request $req){// هادا عشان الريكسوت اخد منه واعمل الشغلات حسب هادا الريكسوزت بحيث انو بعد م اعهمل الشغلات هادي بدي اوديه ع راوت اللي هو المفروض هو عبارة عن عرض لتنفيذ هاي الشغلات
                        $getAllProds=Product::get();
                        foreach($getAllProds as $prod){
                
                            $catThisProd=Category::where(['id'=>$prod->category_id]);
                            $productName=$prod->product_name;
                        }
                        $data=$req->all();
                        $sizeUrl="";
                        if(!empty($data['sizeFilter'])){
                            foreach($data['sizeFilter'] as $size){
                                if(empty($sizeUrl)){
                                    
                                    $sizeUrl='&size='.$size;//the first loop 
                                    
                                }else{
                                    $sizeUrl.='-'.$size;
                                    
                                }
                            }
                        }
                        $finalUrl="view-details-product/".$data['id']."/".$data['url']."?".$sizeUrl;
                        return redirect::to($finalUrl);
                        
                      
                            }
                    
                            public function productsPriceFilterForViewDetails(Request $req){// هادا عشان الريكسوت اخد منه واعمل الشغلات حسب هادا الريكسوزت بحيث انو بعد م اعهمل الشغلات هادي بدي اوديه ع راوت اللي هو المفروض هو عبارة عن عرض لتنفيذ هاي الشغلات
                                $getAllProds=Product::get();
                                foreach($getAllProds as $prod){
                        
                                    $catThisProd=Category::where(['id'=>$prod->category_id]);
                                    $productName=$prod->product_name;
                                }
                                $data=$req->all();
                                $priceUrl="";
                                if(!empty($data['priceFilter'])){
                                    foreach($data['priceFilter'] as $price){
                                        if(empty($priceUrl)){
                                            
                                            $priceUrl='&price='.$price;//the first loop 
                                            
                                        }else{
                                            $priceUrl.='-'.$price;
                                            
                                        }
                                    }
                                }
                                $finalUrl="view-details-product/".$data['id']."/".$data['url']."?".$priceUrl;
                                return redirect::to($finalUrl);
                                    }
            
        public function productsFilterPrice(Request $req){
            $getAllProds=Product::get();
            foreach($getAllProds as $prod){
    
                $catThisProd=Category::where(['id'=>$prod->category_id]);
                $productName=$prod->product_name;
            }
            $data=$req->all();
            $priceUrl="";
            if(!empty($data['priceFilter'])){
                foreach($data['priceFilter'] as $price){
                    if(empty($priceUrl)){
                        
                        $priceUrl='&price='.$price;//the first loop 
                        
                    }else{
                        $priceUrl.='-'.$price;
                        
                    }
                }
            }
            
            $finalUrl="get-products-for-users/".$data['id']."/".$data['url']."?".$priceUrl;
            return redirect::to($finalUrl);
            }

        public function searchProducts(Request $req){
       if($req->isMethod('post')){
                $data=$req->all();
                if($data['product_name']=='dress'||$data['product_name']=='t-shirt'||$data['product_name']=='bags'||$data['product_name']=='shoes'||$data['product_name']=='makeup'){
                    $searchProd=Product::where(['type'=>$data['product_name']])->get();
                    $searchProdCount=Product::where(['type'=>$data['product_name']])->count();
                }else{
                    
                 $searchProd=Product::where(['product_name'=>$data['product_name']])->get();
                 $searchProdCount=Product::where(['product_name'=>$data['product_name']])->count();

               }
                return view('products.search_products')->with(compact('searchProd','searchProdCount'));
            }
            return redirect()->back()->with('flash_message_error','please, you cannt open this page from here , only from hom-page you can search on your products');

            
        }
        public function searchProduct(Request $req){
            if($req->isMethod('post')){
                     $data=$req->all();
                      $searchProd=Product::where(['product_name'=>$data['product_name']])->get();
                      $searchProdCount=Product::where(['product_name'=>$data['product_name']])->count();
                     return view('products.search_product')->with(compact('searchProd','searchProdCount'));
                 }
                 return redirect()->back()->with('flash_message_error','please, you cannt open this page from here , only from hom-page you can search on your products');
     
                 
             }
     
        // show pages for home page//
        public function viewTShirts(){
            $prodsTshirt=Product::where(['product_status'=>1,'type'=>'t-shirt'])->get();
            return view('products.view_tshirts')->with(compact('prodsTshirt'));
        }
        public function viewHeelMakeups(){
            $prodsMakeups=Product::where(['product_status'=>1,'type'=>'makeup'])->get();
            return view('products.view_makeups')->with(compact('prodsMakeups'));
        }
        public function viewHeelShoes(){
            $prodsShoesHeel=Product::where(['product_status'=>1,'type'=>'shoes','type_shoes'=>'normal'])->get();
            return view('products.view_shoes_heel')->with(compact('prodsShoesHeel'));
        }
        public function viewNormalShoes(){
            $prodsShoesNormal=Product::where(['product_status'=>1,'type'=>'shoes','type_shoes'=>'normal'])->get();
            return view('products.view_shoes_normal')->with(compact('prodsShoesNormal'));
        }
        public function viewDress(){
            $prodsDress=Product::where(['product_status'=>1,'type'=>'dress'])->get();
            return view('products.view_dress')->with(compact('prodsDress'));
        }
        public function viewBags(){
            $prodsBags=Product::where(['product_status'=>1,'type'=>'bags'])->get();
            return view('products.view_bags')->with(compact('prodsBags'));
        }
        public function viewMostWanted(){
            $prodsWanted=Product::where('product_quantity','>',8)->get();
            return view('products.view_most_wanted')->with(compact('prodsWanted'));
        }
        public function viewHighPrice(){
            $prodsHighPrice=Product::where('product_price','>',8)->get();
            return view('products.view_high_price')->with(compact('prodsHighPrice'));
        }
        public function viewHighFeature(){
            $prodsHighFeature=Product::where('feature','>',4)->get();
            return view('products.view_feature')->with(compact('prodsHighFeature'));
        }
        public function viewHighModern(){
            $prodsHighModern=Product::where('created_at','>',"2020-03-28")->get();
            return view('products.view_modern')->with(compact('prodsHighModern'));
        }

        public function addMyReview(Request $req,$product_att_id=null){
        $sessionEmailUser=Session::get('sessionUser');
        if($sessionEmailUser){
            $productAttr=ProductsAttribute::where(['id'=>$product_att_id])->first();
            $product_Attr_id=$product_att_id;
            $prodId=$productAttr->product_id;
            $prodName=$productAttr->product_name;
            $prodPrice=$productAttr->product_price;
            $prodSize=$productAttr->product_size;
            if($req->isMethod('post')){
                       $req->validate([
            'review_desc'=>'required',
            ]);
                $data=$req->all();

               $emailReviewCount= Review::where(['user_email'=>$sessionEmailUser,'product_Attr_id'=>$product_Attr_id
               ])->count();
               if($emailReviewCount==0){
                      $newReview=new Review();
                      $newReview->product_Attr_id=$product_Attr_id;
                      $newReview->product_id=$prodId;
                      $newReview->product_name=$prodName;
                      $newReview->review_desc=$data['review_desc'];
                      $newReview->product_price=$prodPrice;
                      $newReview->product_size=$productAttr->product_size;
                      $newReview->user_email=$sessionEmailUser;
                      $newReview->rank_review=$data['nums_review'];
                      $newReview->save();
                     return redirect()->back()->with('flash_message_success','added your review success');

               }else{
            $editReview= Review::where(['user_email'=>$sessionEmailUser,'product_Attr_id'=>$product_Attr_id])->first();
            $re= $editReview->product_Attr_id;
            $sessionEmailUser=Session::get('sessionUser');
            return redirect("/edit-my-review/$re");
               }
            }
            return view('products.add_my_review')->with(compact('productAttr','prodName','sessionEmailUser') );
        }else{
            return redirect()->back()->with('flash_message_error','you havent access in this page ,you can go into login-user now');
        }
        }

        public function editMyReview($rev_id=null, Request $req,$product_att_id=null){
            $productAttr=ProductsAttribute::where(['id'=>$product_att_id])->first();
            $productName=$productAttr->product_name;
            $productId=$productAttr->product_id;
            $editReview= Review::where(['id'=>$rev_id])->first();
         $rev_id=   $editReview->id;
            if($req->isMethod('post')){
                $data=$req->all();
                    $editReview->product_Attr_id=$editReview->product_Attr_id;
                    $editReview->product_id=$productAttr->product_id;
                    $editReview->product_name=$productAttr->product_name;
                    $editReview->review_desc=$data['review_desc'];
                    $editReview->product_price=$productAttr->product_price;
                    $editReview->product_size=$productAttr->product_size;
                    $editReview->user_email=Session::get('sessionUser');
                    $editReview->rank_review=$data['nums_review'];
                    $editReview->save();
                    return redirect()->back()->with('flash_message_success','edited your review success');
            }
            return view('products.edit_my_review')->with(compact('editReview','rev_id','productId','productAttr','productName'));
        }

        public function deleteMyReview($rev_id=null){
        $deleteReview=Review::where(['id'=>$rev_id])->first();
        $deleteReview->delete();
        return redirect()->back()->with('flash_message_success','deleted succss');
        }
        public function ShowReviewers($product_Attr_id=null){
        $revs=Review::where(['product_Attr_id'=>$product_Attr_id])->get();
        $revsCount=Review::where(['product_Attr_id'=>$product_Attr_id])->count();
            return view('products.show_reviewers')->with(compact('revs','revsCount','product_Attr_id'));
        }

        public function ShowReviewersForViewPages($product_id=null){
            $product=Product::where(['id'=>$product_id])->get();
            $productsCount=Product::where(['product_id'=>$product_id])->get();
            
                return view('products.show_reviewers__for_view_pages')->with(compact('product_id'));
        }
        
        public function filterProduct(Request $req){
            $data=$req->all();
           echo '<pre>';print_r($data);die;
       
        
        }
        public function paypal(Request $req){
            return view('emails.paypal');
        }
        public function paypalThanks(){
            return view('emails.paypal_thanks');
        }
        public function paypalCancel(){
            return view('emails.paypal_cancel'); 
        }
        public function ipnPaypal(Request $req){
            $data=$req->all();
            if($data['payment_status']=='Completed'){
                //we will send email to user/admin
                //will change order status is payment captured
                $orderId=Session::get('sessionOrderId');
                Order::where('id',$orderId)->update(['order_status'=>'Payment Captured']);
                //////////code for order email
                $productsInOrder=OrdersProduct::where(['order_id'=>$orderId])->get();
                foreach($productsInOrder as $productInOrder){
                  
                  $productsId=$productInOrder->product_id;
                  $productDetails=Product::where(['id'=>$productsId])->first();
                }
                $orderDetails=Order::where(['order_id'=>$orderId])->first();
                //
                $orderDetails=Order::where('id',$orderId)->first();
                $orderDetails=json_decode(json_encode($orderDetails));
                $userEmail=$orderDetails->user_email;
                $userId=Auth::user()->id;
                $shippingUserDetails=Delivery::where('user_email',$orderDetails->user_email)->first();
                $userName=$shippingDetails->name;
                $messageData=[
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
            }
            return view('order.papal_ipn');
        }
        public function placeOrder(Request $req){
            if($req->isMethod('post')){
                $data=$req->all();
                if($data['payment_method']=='Payumoney'){
                    //Payumenoy redirect user to payumony page after saving order
                    return redirect('/payumoney');
                }elseif($data['payment_method']=='COD'){//send to email and redirect user to thanks page after saving order
                $orderId=Session::get('sessionOrderId');
                    $orderDetails=Order::where('id',$orderId)->first();
                    $orderDetails=json_decode(json_encode($orderDetails));
                    $order=OrdersProduct::where(['order_id'=>$orderId])->get();
                    $emailUser=$orderDetails->user_email;
                    $shippingUserDetails=Delivery::where('email',$orderDetails->user_email)->first();
                    $billingUser=  User::where(['email'=>Session::get('sessionUser')])->first();//billing
                    $userName=$shippingUserDetails->name;
                    $userDetails=User::where('id',Session::get('sessionUser'));
                    $userDetails=json_decode(json_encode($userDetails),true);
                    $messageData=['type_your_payment'=>$data['payment_method'],'name'=>$userName,'orderId'=>$orderId,'order'=>$order,'userDetails'=>$userDetails,'shippingUserDetails'=>$shippingUserDetails,'billingUser'=>$billingUser];//هو اللي حاخد الداتا منه وابعت للي فوق
                    Mail::send('emails.order',$messageData,function($message) use ($emailUser){
                        $message->to($emailUser)->subject('order placed - e-shopping website');
                    });

                    return redirect('/cdo/thanks');
                }else{
                    return redirect('/paypal');
                }
            }
        }
      
        public function cdoThanks(){
            return view('emails.cdo_thanks');
        }
        public function cdoCancel(){
            return view('emails.cdo_cancel');
        }
}
