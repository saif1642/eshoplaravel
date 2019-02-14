<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class ProductController extends Controller
{
    public function index(){
        $this->AdminAuthCheck();
        $product_categories = DB::table('tbl_category')->where('publication_status',1)->get();
        $product_brands = DB::table('tbl_manufacture')->where('publication_status',1)->get();

        return view('admin.add_product')
                                  ->with('product_categories',$product_categories)
                                  ->with('product_brands',$product_brands);
    }
    public function save_product(Request $request){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['manufacture_id'] = $request->manufacture_id;
        $data['product_short_description'] = $request->product_short_description;
        $data['product_long_description'] = $request->product_long_description;
        $data['product_price'] = $request->product_price;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['publication_status'] = $request->publication_status;

        $image = $request->file('product_image');
        if($image){
            $image_name = str_random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'images/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path,$image_full_name);
            if($success){
                $data['product_image'] = $image_url;
               // dd($data);
                DB::table('tbl_product')->insert($data);
                Session::put('message','Product Added Successfully !!');
                return redirect()->back();
            }
        }
        $data['product_image'] = "";
        //dd($data);
        DB::table('tbl_product')->insert($data);
        Session::put('message','Product Added Successfully without image!!');
        return redirect()->back();

    }
    public function all_product(){
        $this->AdminAuthCheck();
        $all_product = DB::table('tbl_product')
                               ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')
                               ->join('tbl_manufacture','tbl_product.manufacture_id','=','tbl_manufacture.manufacture_id')
                               ->select('tbl_product.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                               ->get();
        //dd($all_product);
        return view('admin.all_product')->with('all_product',$all_product);
    }
    public function inactive_product($product_id){
        //dd($product_id); 
        DB::table('tbl_product')->where('product_id',$product_id)
                                 ->update(['publication_status'=>0]);
        Session::put('message','Product Inactivated Successfully !!');
        return redirect()->back();
    }
    public function active_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)
                                 ->update(['publication_status'=>1]);
        Session::put('message','Product activated Successfully !!');
        return redirect()->back();
    }
    public function delete_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)
        ->delete();
        Session::put('message','Product Deleted Successfully !!');
        return redirect()->back();
    }
    public function edit_product($product_id){
        $this->AdminAuthCheck();
        $product_categories = DB::table('tbl_category')->where('publication_status',1)->get();
        $product_brands = DB::table('tbl_manufacture')->where('publication_status',1)->get();
        $product_details = DB::table('tbl_product')->where('product_id',$product_id)->first();
        return view('admin.edit_product')
                                  ->with('product_categories',$product_categories)
                                  ->with('product_brands',$product_brands)
                                  ->with('product_details',$product_details);
    }
    public function update_product($product_id,Request $request){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['manufacture_id'] = $request->manufacture_id;
        $data['product_short_description'] = $request->product_short_description;
        $data['product_long_description'] = $request->product_long_description;
        $data['product_price'] = $request->product_price;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $image = $request->file('product_image');
        if($image){
            $image_name = str_random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'images/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path,$image_full_name);
            if($success){
                $data['product_image'] = $image_url;
               // dd($data);
               DB::table('tbl_product')->where('product_id',$product_id)
               ->update($data);
                Session::put('message','Product Updated Successfully !!');
                return redirect()->back();
            }
        }
        $data['product_image'] = "";
        DB::table('tbl_product')->where('product_id',$product_id)
        ->update($data);
        Session::put('message','Product Updated Successfully !!');
        return redirect()->back();
    }
    public function AdminAuthCheck(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return;
        }else{
            return redirect('/admin')->send();
        }
    }
}
