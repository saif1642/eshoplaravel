<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class ProductController extends Controller
{
    public function index(){
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

        $image = $request->file('product_name');
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
}
