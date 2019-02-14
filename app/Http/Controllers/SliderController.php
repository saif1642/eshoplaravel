<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class SliderController extends Controller
{
    public function add_slider(){
        $this->AdminAuthCheck();
        return view('admin.add_slider');
    }
    public function save_slider(Request $request){
        $data = array();
        $data['publication_status'] = $request->publication_status;
        $image = $request->file('slider_image');
        if($image){
            $image_name = str_random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'images/slider_image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path,$image_full_name);
            if($success){
                $data['slider_image'] = $image_url;
               // dd($data);
                DB::table('tbl_slider')->insert($data);
                Session::put('message','Slider Image Added Successfully !!');
                return redirect()->back();
            }
        }
        $data['slider_image'] = "";
        //dd($data);
        DB::table('tbl_slider')->insert($data);
        Session::put('message','Slider Image Added Successfully without image!!');
        return redirect()->back();
      
    }
    
    public function all_slider(){
        $this->AdminAuthCheck();
        $all_slider = DB::table('tbl_slider')->get();
        return view('admin.all_slider')->with('all_slider',$all_slider);
    }
    public function inactive_slider($slider_id){
        DB::table('tbl_slider')->where('slider_id',$slider_id)
                                 ->update(['publication_status'=>0]);
        Session::put('message','Slider Inactivated Successfully !!');
        return redirect()->back();
    }
    public function active_slider($slider_id){
          DB::table('tbl_slider')->where('slider_id',$slider_id)
                                   ->update(['publication_status'=>1]);
          Session::put('message','Slider activated Successfully !!');
          return redirect()->back();
    }
    public function delete_slider($slider_id){
        DB::table('tbl_slider')->where('slider_id',$slider_id)->delete();
        Session::put('message','Slider Deleted Successfully !!');
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
