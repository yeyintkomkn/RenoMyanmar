<?php

namespace App\Http\Controllers;

use App\Main_category;
use App\Sub_category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    function add_main_category(Request $request){
            $category_name=$request->get('category_name');
            Main_category::create(['category_name'=>$category_name]);
            return redirect('admin/company_profile')->with('success_msg','Success Adding New Main Category');

    }


    function add_sub_category(Request $request){
            $main_category_id=$request->get('main_category_id');
            $category_name=$request->get('category_name');
            $logo=$request->get('logo');
            Sub_category::create([
                'main_category_id'=>$main_category_id,
                'category_name'=>$category_name,
                'logo'=>$logo
            ]);
            return redirect('admin/company_profile')->with('success_msg','Success Adding New Sub Category');

    }

    function get_main_category(){
        $data=Main_category::all();
        return json_encode($data);
    }

    function get_sub_category($main_category_id){
        $subcategories=Sub_category::where('main_category_id',$main_category_id)->get();
        foreach ($subcategories as $data){
            $data['main_category_data']=$data->main_category;
        }
        return json_encode($subcategories);
    }

    function delete_main_category($id){
        Main_category::findOrFail($id)->delete();
        Sub_category::where('main_category_id',$id)->delete();
    }

    function delete_sub_category($id){
        Sub_category::findOrFail($id)->delete();
    }


}
