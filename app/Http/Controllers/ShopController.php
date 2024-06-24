<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function responeJson($status,$data){
        $respone=[
            'status' =>$status,
            'data'=>$data
        ];
        return response($respone);
    }
    public function getAllShop(){
        $shop=Shop::query()
            ->orderBy('id','DESC')
            ->get();
            return $this->responeJson(200,$shop);
    }

   public function getShop(){
        return $this->responeJson(200,'OK');
   }

   public function addProduct(Request $request){
        $input=$request->all();
        if($filename=$request->file('thumbnail')){
            $image=time().''.$filename->getClientOriginalName();
            $path='image';
            $filename->move($path,$image);
            $input['thumbnail']=url('image/',$image);
        }
        // $input['created_at']->date('Y-m-d H:i:s');
        // $input['updated_at_at']->date('Y-m-d H:i:s');
        $res=Shop::create($input);
        $res->save();
        if($res){
            return $this->responeJson(201,'created');
        }
   }
   public function EditProduct(Request $request,Shop $shop){
        // $input=$request->all();
        $input =$request->all();
        if($filename=$request->file('thumbnail')){
            $image=time().''.$filename->getClientOriginalName();
            $path='image';
            $filename->move($path,$image);
            $input['thumbnail']=url('image/',$image);
        }
        $shop->update($input);
        $shop->save();
        if($shop){
            return $this->responeJson(200,'Updated');
        }

    }
    public function DeleteProduct($id){

        $res=Shop::query()->where('id',$id)->delete();
        if($res){
            return $this->responeJson(200,'Deleted');
        }
    }
    public function GetLimit($limit){
        $res=Shop::query()
        ->limit($limit)
        ->orderBy('id','DESC')
        ->get();
        if($res){
            return $this->responeJson(200,$res);
        }
    }
    public function GetProductByCategories($categories){
        $product=Shop::query()
                    ->where('categories',$categories)
                    ->orderBy('id','DESC')
                    ->get();
        if($product){
            return $this->responeJson(200,$product);
        }
    }

}
