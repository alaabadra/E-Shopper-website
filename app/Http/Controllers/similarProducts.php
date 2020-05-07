<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SimilarProduct;
use DB;
class similarProducts extends Controller
{
    //

    //
    public function getSimilarProducts(){
        $getAllSimProd=SimilarProduct::get();

        return view('Similarproducts.get_similar_products')->with(compact('getAllSimProd'));
    }
    public function addSimilarProduct(Request $req){
        if($req->isMethod('post')){
            $data=$req->all();
            DB::table('similar_products')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'product_image'=>$data['product_image'],'product_status'=>$data['product_status']]);
        }
        return view('Similarproducts.add_similar_products');
    }
    public function editSimilarProduct(Request $req,$id=null){
        if(!empty($id)){
            $editSimProd=SimilarProduct::where(['id'=>$id])->first();
            if($req->isMethod('post')){
                $data=$req->all();    
                DB::table('similar_products')->where('id',$id)->update(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'product_image'=>$data['product_image'],'product_status'=>$data['product_status']]);

            }
        }
        return view('Similarproducts.edit_similar_product')->with(compact('editSimProd'));
    }
    public function deleteSimilarProduct(){
        return redirect('Similarproducts.get_similar_products');
    }
}
