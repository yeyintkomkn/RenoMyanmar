<?php

namespace App\Http\Controllers;

use App\Blog;
//use App\Http\CustomClass;
use App\CompanyProfile;
use App\Main_category;
use App\Sub_category;
use Illuminate\Http\Request;
class BlogController extends Controller
{
    function create_or_edit_admin_blog(Request $request){
        $title=$request->get('title');
        $description=$request->get('description');
        $id=$request->get("blog_id");
        if($id==0){
            if ($request->hasFile('photo')){
                $file=$request->file('photo');
                $image_name=uniqid().'_'.$file->getClientOriginalName();
                $file->move(public_path().'/upload/blog/',$image_name);
            }
            Blog::create([
                'title'=>$title,
                'description'=>$description,
                'photo'=>$image_name
            ]);
        }
        else{
            Blog::findOrFail($id)->update([
                'title'=>$title,
                'description'=>$description
            ]);
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $image_name = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path() . '/upload/blog/', $image_name);
                $blog=Blog::findOrFail($id);
                $image_path=public_path().'/upload/blog/'.$blog->photo;
                if(file_exists($image_path)){
                    unlink($image_path);
                }

                Blog::findOrFail($id)->update([
                    'photo'=>$image_name
                ]);
            }
        }

    }

    function get_all_blog(){
        $data=Blog::all();
        $arr=[];
        foreach ($data as $blog){
            $blog_data=new BlogData($blog->id);
            array_push($arr,$blog_data->get_blog_data());
        }
        return json_encode($arr);
    }

    function get_latest_news(){
        $blogs=BlogData::get_latest_new(5);
        return json_encode($blogs);
    }

    function delete($id){
        $blog=Blog::findOrFail($id);
        $image_path=public_path().'/upload/blog/'.$blog->photo;
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $blog->delete();
    }

    function get_blog_detail($id){
//        $blog=Blog::findOrFail($id);
//        return json_encode($blog);
        $blog=new BlogData($id);
        return json_encode($blog->get_blog_data());
    }

    function show_blog_detail($id){
        $blog=new BlogData($id);
        $blog_data=$blog->get_blog_data();

        $latest_blog=BlogData::get_latest_new(10);
        $main_categories=Main_category::all();
        $sub_categories=Sub_category::all();
        $site_profile=CompanyProfile::findOrFail(1);

        return view('user.blog_detail')->with([
            'main_categories'=>$main_categories,// to show in header
            'sub_categories'=>$sub_categories,

            'blog_data'=>$blog_data,
            'latest_blog'=>$latest_blog,
            'site_profile'=>$site_profile
        ]);
    }

    function show_all_blog(){
        $all_blog=Blog::orderBy('id','desc')->paginate(10);
        $all_blogs=[];
        foreach($all_blog as $data){
            $blog_obj=new BlogData($data->id);
            array_push($all_blogs,$blog_obj->get_blog_data());
        }



        $latest_blog=BlogData::get_latest_new(3);

        $main_categories=Main_category::all();
        $sub_categories=Sub_category::all();
        $site_profile=CompanyProfile::findOrFail(1);

        $ads=new AdsController();
        $area_four_ads=$ads->ads_by_page(4);


        return view('user.blog')->with([
            'main_categories'=>$main_categories,// to show in header
            'sub_categories'=>$sub_categories,

            'all_blogs'=>$all_blogs,
            'latest_blog'=>$latest_blog,
            'paginate'=>$all_blog,
            'site_profile'=>$site_profile,
            'area_four_ads'=>$area_four_ads
        ]);
    }


}
