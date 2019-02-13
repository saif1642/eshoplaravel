<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
session_start();
class CategoryController extends Controller
{
    public function index(){
        return view('admin.add_category');
    }
    public function all_category(){
        $all_category = DB::table('tbl_category')->get();
        //dd($all_category);
        return view('admin.all_category')->with('all_category', $all_category);
    }
    public function save_category(Request $request){
       $data = array();
       $data['category_name'] = $request->category_name;
       $data['category_description'] = $request->category_description;
       $data['publication_status'] = $request->publication_status;
       $data['created_at'] = date("Y-m-d");
       DB::table('tbl_category')->insert($data);
       Session::put('message','Category Added Successfully !!');
       return redirect('/add-category');
    }
    public function inactive_category($category_id){
      DB::table('tbl_category')->where('category_id',$category_id)
                               ->update(['publication_status'=>0]);
      Session::put('message','Category Inactivated Successfully !!');
      return redirect()->back();
    }
    public function active_category($category_id){
        DB::table('tbl_category')->where('category_id',$category_id)
                                 ->update(['publication_status'=>1]);
        Session::put('message','Category activated Successfully !!');
        return redirect()->back();
    }
    public function edit_category($category_id){
        $category_info = DB::table('tbl_category')->where('category_id',$category_id)
                                                  ->first();
        return view('admin.edit_category')->with('category_info',$category_info);
    }
    public function update_category($category_id,Request $request){
        DB::table('tbl_category')->where('category_id',$category_id)
        ->update([
            'category_name' => $request->category_name,
            'category_description' => $request->category_description
        ]);
        Session::put('message','Category Updated Successfully !!');
        return redirect()->back();
    }
    public function delete_category($category_id){
        DB::table('tbl_category')->where('category_id',$category_id)
                                 ->delete();
        Session::put('message','Category Deleted Successfully !!');
        return redirect()->back();
    }
}
