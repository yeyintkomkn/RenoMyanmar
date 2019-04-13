<?php

namespace App\Http\Controllers;

use App\Admin;
use App\AdminFeedback;
use App\Company;
use App\Main_category;
use App\Sub_category;
use App\Top_company;
use App\User;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function login(Request $request){
        if ($request->isMethod('get')){
            return view('login');
        }
        else{
           $email=$request->get('email');
           $password=$request->get('password');
//            $user=User::where('email',$email)->where('password',$password)->get();
//            if(count($user)!=0){
//                return redirect('admin/dashboard');
//            }
            //****************if company account
            if(Auth::attempt(['email'=>$email,'password'=>$password])){
                $user = Auth::user();
                $id=$user->company_id;
//                if admin
                if($id===0){
                    session(['login_admin'=>$id]);
                    return redirect('/admin/');
                }
                else {
                    session(['login_company_id'=>$id]);
                    $company=new RealCompanyData($id);
                    $company_data=$company->getCompanyInfoArr();

//                    echo json_encode($company_data['verify']);
                    if($company_data['verify']===0){
                        return redirect('message')->with([
                            'msg_title'=>'Sorry!',
                            'msg'=>'lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem',
                        ]);
                    }
                    else{
                        return redirect('/company/company_dashboard');
                    }
                }
            }
            else{
//                echo 'haha';
                return redirect('/')->with('error_msg','Account Does not Match!');
            }
        }
    }

    function login_company_account($company_id){
        session(['login_company_id'=>$company_id]);

            $company=new RealCompanyData($company_id);
            $company_data=$company->getCompanyInfoArr();

//                    echo json_encode($company_data['verify']);
            if($company_data['verify']===0){
                return redirect('not_active_company');
            }
            else{
                return redirect('/company/company_dashboard');
            }
    }



    function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/')->with('success_msg','Logout Success');
    }

    //to delete
    function create_top_company(Request $request){
        if($request->isMethod('get')){
//            return 'aa';
//            $top_company=Top_company::all();
//            return view('admin.create_top_company')->with('top_company',$top_company);
            $company=Company::all();

            return view('admin.create_top_company')->with('companies',$company);
        }
        else{
            $arr=$request->get('company_id');

            for ($i=0;$i<count($arr);$i++){
                Top_company::create(['company_id'=>$arr[$i]]);
            }
//            return $arr;
//            return 'AAA';
        }
    }

    function create_or_edit_admin_feedback(Request $request){
        $name=$request->get('name');
        $description=$request->get('description');
        $id=$request->get('feedback_id');
        //create
        if($id==0){
            if ($request->hasFile('photo')){
                $file=$request->file('photo');
                $image_name=uniqid().'_'.$file->getClientOriginalName();
                $file->move(public_path().'/upload/admin_feedback/',$image_name);
            }
            AdminFeedback::create([
                'name'=>$name,
                'description'=>$description,
                'picture'=>$image_name
            ]);
        }
        else{
            AdminFeedback::findOrFail($id)->update([
                'name'=>$name,
                'description'=>$description
            ]);
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $image_name = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path() . '/upload/admin_feedback/', $image_name);
                $feedback=AdminFeedback::findOrFail($id);
                $image_path=public_path().'/upload/admin_feedback/'.$feedback->picture;
                if(file_exists($image_path)){
                    unlink($image_path);
                }

                AdminFeedback::findOrFail($id)->update([
                    'picture'=>$image_name
                ]);
            }
        }



    }

    function delete_feedback($id){
        AdminFeedback::findOrFail($id)->delete();
    }

    function get_admin_feedback(){
        $feedback=AdminFeedback::all();
        $arr=[];
        foreach ($feedback as $data){
            $feedback_data=new AdminFeedbackData($data->id);
            array_push($arr,$feedback_data->get_feedback_data());
        }
        return json_encode($arr);
    }

    function show_dashboard(){
        $active_company_count=DB::select('SELECT count(id) AS count FROM view_user_companies');
        $free_company_count=DB::select("SELECT count(id) AS count FROM view_user_companies WHERE type='free'");
        $paid_company_count=DB::select("SELECT count(id) AS count FROM view_user_companies WHERE type='paid'");
        $pending_company_count=DB::select("SELECT count(id) AS count FROM companies WHERE verify=0");
        $ban_company_count=DB::select("SELECT count(id) AS count FROM companies WHERE status=0");
        $top_company_count=DB::select("SELECT count(id) AS count FROM top_companies");
        $total_employee_count=DB::select("SELECT count(id) AS count FROM employees");
//
//        for chart

//        return json_encode($sub_categories);
        return view('site_admin.dashboard')->with([
            'url' => 'dashboard',
            'total_employee_count'=>$total_employee_count[0]->count,
            'active_company_count'=>$active_company_count[0]->count,
            'free_company_count'=>$free_company_count[0]->count,
            'paid_company_count'=>$paid_company_count[0]->count,
            'ban_company_count'=>$ban_company_count[0]->count,
            'top_company_count'=>$top_company_count[0]->count,
            'pending_company_count'=>$pending_company_count[0]->count,

        ]);
    }

    function company_by_sub_category(){
        $sub_categories=Sub_category::all();
        $sub_categories_name_arr=[];
        $sub_categories_count_arr=[];
        foreach ($sub_categories as $data){
            array_push($sub_categories_name_arr,$data['category_name']);

            $id=$data['id'];
            $count=DB::select("SELECT count(subcategory_id) AS count FROM sub_category_companies WHERE subcategory_id=$id");
            array_push($sub_categories_count_arr,$count[0]->count);

        }
        $company_by_sub_category=[$sub_categories_name_arr,$sub_categories_count_arr];

        return json_encode($company_by_sub_category);
    }

    function company_by_main_category(){
        $main_category=Main_category::all();
        $category_name=[];
        $category_count=[];
        $category_percent=[];
        foreach ($main_category as $category){
            $subcategories=Sub_category::where('main_category_id',$category->id)->get();
            $main_category_count=0;
            foreach ($subcategories as $data){
                $id=$data['id'];
                $count=DB::select("SELECT count(subcategory_id) AS count FROM sub_category_companies WHERE subcategory_id=$id");

                $main_category_count+=$count[0]->count;
            }
            $total=DB::select("SELECT count(id) AS total FROM sub_category_companies");
            array_push($category_name,$category->category_name);
            array_push($category_count,$main_category_count);
            array_push($category_percent,($main_category_count/$total[0]->total)*100);
        }
        $arr=[$category_name,$category_count,$category_percent];
        echo json_encode($arr);

    }




}
