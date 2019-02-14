<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
{
    public function index(){
        $all_category = DB::table('tbl_category')->get();
        //dd($all_category);
        $all_brand = DB::table('tbl_manufacture')->get();
        $all_product = DB::table('tbl_product')
                                ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')
                                ->join('tbl_manufacture','tbl_product.manufacture_id','=','tbl_manufacture.manufacture_id')
                                ->where('tbl_product.publication_status',1)
                                ->select('tbl_product.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                                ->get();
        return view('pages.home')->with('all_category',$all_category)
                                 ->with('all_brand',$all_brand)
                                 ->with('all_product',$all_product);
    }
}
