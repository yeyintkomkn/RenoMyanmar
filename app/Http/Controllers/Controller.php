<?php

namespace App\Http\Controllers;

use App\AdminFeedback;
use App\Blog;
use App\Company;
use App\CompanyProfile;
use App\Contact;
use App\Keyword;
use App\Main_category;
use App\Sub_category;
use App\Top_company;
use App\View_user_company;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

//    function test(){
//        $start_time = Carbon::now()->subHour(24);
//        $end_time=Carbon::now();
//
//        $company=Company::where('verify',0)->where('created_at','>=',$start_time)->where('created_at','<=',$end_time)->get();
//
//       return json_encode($company);
    function update_company_profile(Request $request){
        CompanyProfile::findOrFail(1)->update($request->all());
        return redirect('/admin/company_profile')->with('success_msg','Update Data Success!');
    }

    function show_homepage(){
        //to show categories card
        $sub_categories=Sub_category::all();
        $main_categories=Main_category::all();
        for ($i=0;$i<count($sub_categories);$i++){
            $count=DB::select('SELECT count(id) AS count FROM sub_category_companies WHERE subcategory_id='.$sub_categories[$i]->id);
            $sub_categories[$i]->count=(object)$count[0];
        }

        $top_companies=Top_company::where('id','>',0)->paginate(10);
        $top_companies_data=array();
        foreach ($top_companies as $company){
            $company_id=$company->company_id;
            $company=new CompanyData($company_id);
            $company_info=$company->getCompanyInfoArr();
            $company_categories=$company->getCategoriesArr();//sub category

            if($company_categories!=null){
                $company_info['categories']=$company_categories;
                array_push($top_companies_data,$company_info);
            }
        }
        shuffle($top_companies_data);
        $admin_feedback=AdminFeedback::all();

        $keyword=Keyword::all();

//        $admin_blog=Blog::orderBy('id','desc')->take(3)->get();
//        $blogs=[];
//        foreach($admin_blog as $data){
//            $blog_data=new BlogData($data->id);
//            array_push($blogs,$blog_data->get_blog_data());
//        }
        $blogs=BlogData::get_latest_new(3);

        $company_profile=CompanyProfile::findOrFail(1);

        $ads=new AdsController();
        $area_one_ads=$ads->ads_by_page(1);
        $area_two_ads=$ads->ads_by_page(2);

//        return $top_companies_data;
        return view('user.index')->with([
            'main_categories'=>$main_categories,
            'sub_categories'=>$sub_categories,
            'top_companies'=>$top_companies_data,
            'admin_feedback'=>$admin_feedback,
            'keywords'=>$keyword,

            'latest_blog'=>$blogs,
            'site_profile'=>$company_profile,
            'top_paginate'=>$top_companies,
            'area_one_ads'=>$area_one_ads,
            'area_two_ads'=>$area_two_ads,

        ]);
//        return csrf_field();
    }

    function contact(Request $request){
        $latest_blog=BlogData::get_latest_new(3);
        $main_categories=Main_category::all();
        $sub_categories=Sub_category::all();
        $site_profile=CompanyProfile::findOrFail(1);
        if ($request->getMethod()=="POST"){
            Contact::create($request->all());
            return redirect('message')->with([
                'msg_title'=>'Thank You!',
               'msg'=>'orem Ipsum Dolor Sit Amet, Consectetur Adipisicing Elit, Sed Do Eiusmod Tempor Incididunt Ut Labore Et Dolore Magna Aliqua. Ut Enim Ad Minim Veniam, Quis Nostrud Exercitation Ullamco Laboris Nisi Ut Aliquip Ex Ea Commodo Consequat. Duis Aute Irure Dolor In Reprehenderit In Voluptate Velit Esse Cillum Dolore Eu Fugiat Nulla Pariatur. Excepteur Sint Occaecat Cupidatat Non Proident, Sunt',
            ]);
        }
        else{
            return view('user.contact')->with([
                'main_categories'=>$main_categories,// to show in header
                'sub_categories'=>$sub_categories,
                'latest_blog'=>$latest_blog,
                'site_profile'=>$site_profile
            ]);
        }

    }

    function about(){
        $site_profile=CompanyProfile::findOrFail(1);
        $latest_blog=BlogData::get_latest_new(3);
        $main_categories=Main_category::all();
        $sub_categories=Sub_category::all();
        return view('user.about')->with([
            'main_categories'=>$main_categories,// to show in header
            'sub_categories'=>$sub_categories,
            'latest_blog'=>$latest_blog,
            'site_profile'=>$site_profile
        ]);
    }

    function show_message(){
        $site_profile=CompanyProfile::findOrFail(1);
        $latest_blog=BlogData::get_latest_new(3);
        $main_categories=Main_category::all();
        $sub_categories=Sub_category::all();
        return view('user.show_message')->with([
            'main_categories'=>$main_categories,// to show in header
            'sub_categories'=>$sub_categories,
            'latest_blog'=>$latest_blog,
            'site_profile'=>$site_profile,
//            'msg_title'=>'Thank You!',
//            'msg'=>'orem Ipsum Dolor Sit Amet, Consectetur Adipisicing Elit, Sed Do Eiusmod Tempor Incididunt Ut Labore Et Dolore Magna Aliqua. Ut Enim Ad Minim Veniam, Quis Nostrud Exercitation Ullamco Laboris Nisi Ut Aliquip Ex Ea Commodo Consequat. Duis Aute Irure Dolor In Reprehenderit In Voluptate Velit Esse Cillum Dolore Eu Fugiat Nulla Pariatur. Excepteur Sint Occaecat Cupidatat Non Proident, Sunt',
        ]);
    }


}
