<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class ManufactureController extends Controller
{
    public function index(){
        return view('admin.add_brand');
    }
    public function save_brand(Request $request){
        $data = array();
        $data['manufacture_name'] = $request->manufacture_name;
        $data['manufacture_description'] = $request->manufacture_description;
        $data['publication_status'] = $request->publication_status;
        $data['created_at'] = date("Y-m-d");
        DB::table('tbl_manufacture')->insert($data);
        Session::put('message','Brand Added Successfully !!');
        return redirect('/add-brand');
     }
     public function all_brand(){
        $all_brand = DB::table('tbl_manufacture')->get();
        //dd($all_brand);
        return view('admin.all_brand')->with('all_brand', $all_brand);
    }
    public function inactive_brand($manufacture_id){
        DB::table('tbl_manufacture')->where('manufacture_id',$manufacture_id)
                                 ->update(['publication_status'=>0]);
        Session::put('message','Brand Inactivated Successfully !!');
        return redirect()->back();
      }
      public function active_brand($manufacture_id){
          DB::table('tbl_manufacture')->where('manufacture_id',$manufacture_id)
                                   ->update(['publication_status'=>1]);
          Session::put('message','Brand activated Successfully !!');
          return redirect()->back();
      }
      public function edit_brand($manufacture_id){
         $brand_info = DB::table('tbl_manufacture')->where('manufacture_id',$manufacture_id)->first();
         return view('admin.edit_brand')->with('brand_info',$brand_info);
     }
     public function update_brand($manufacture_id,Request $request){
        DB::table('tbl_manufacture')->where('manufacture_id',$manufacture_id)
        ->update([
            'manufacture_name' => $request->manufacture_name,
            'manufacture_description' => $request->manufacture_description
        ]);
        Session::put('message','Brand Updated Successfully !!');
        return redirect()->back();
    }
    public function delete_brand($manufacture_id){
        DB::table('tbl_manufacture')->where('manufacture_id',$manufacture_id)
                                 ->delete();
        Session::put('message','Brand Deleted Successfully !!');
        return redirect()->back();
    }
}
