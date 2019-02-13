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
        return view('pages.home')->with('all_category',$all_category)
                                 ->with('all_brand',$all_brand);
    }
}
