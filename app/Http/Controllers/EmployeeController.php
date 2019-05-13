<?php

namespace App\Http\Controllers;

use App\Company_Keyword;
use App\CompanyProfile;
use App\Employee;
use App\Employee_Company;
use App\Keyword;
use App\Main_category;
use App\Sub_category;
use App\View_user_company;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    function insert(Request $request){
//        return json_encode($request->all());
        $username=$request->get('username');
        $email=$request->get('email');
        $phone=$request->get('phone');
        $address=$request->get('address');
        $note=$request->get('description');
        $budget_range=$request->get('budget_range');
        $current_situation=$request->get('current_situation');
        $start_date=$request->get('start_date');

        $service_type=$request->get('service_type');
        $project_type=$request->get('project_type');

        $selected_companies=$request->get('selected_companies');

        $employee_id=Employee::create([
            'username'=>$username,
            'email'=>$email,
            'phone'=>$phone,
            'address'=>$address,
            'budget_range'=>$budget_range,
            'category_id_arr'=>json_encode($service_type),
            'project_type_arr'=>json_encode($project_type),
            'start_date'=>$start_date,
            'current_situation'=>$current_situation,
            'note'=>$note
        ])->id;

        if($request->get('file_name')!="no_file"){
            $file_name=$request->get('file_name');

            $new_path = public_path().'/upload/employee_upload_file/'.$file_name;
            $old_path = public_path().'/upload/cache_file/'.$file_name;
            copy($old_path, $new_path);


            Employee::findOrFail($employee_id)->update([
                'file'=>$file_name
            ]);

            if(file_exists($old_path)){
                unlink($old_path);
            }
        }

        foreach ($selected_companies as $company_id) {
            Employee_Company::create([
                'employee_id'=>$employee_id,
                'company_id'=>$company_id
            ]);
        }
        return "Success";

    }

    function show_preview(Request $request){
        $data=$request->all();

        if ($request->hasFile('data_file')) {
            $file = $request->file('data_file');
            $file_name = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/upload/cache_file/', $file_name);
            $data['file_name']=$file_name;
        }
        else{
            $data['file_name']="no_file";
        }
        unset($data['data_file']);

        session(['emp_data'=>$data]);
        $keyword=Keyword::all();
        $main_categories=Main_category::all();
        $sub_categories=Sub_category::all();

        $selected_keywords=$data['project_type'];
        $company_list=[];

        //calculate company keyword and service type(main category)
        foreach ($selected_keywords as $onekeyword){
            $companies=Company_Keyword::where('keyword_id',$onekeyword)->get();

            foreach ($companies as $company) {
                $company_data = new CompanyData($company->company_id);
                $company_categories = $company_data->getCategoriesArr();
                $company_info = $company_data->getCompanyInfoArr();
//              array_push($company_list,$company_info);
//          ******************check company is selected service(category)=>true =>add company list
                if ($company_categories != null){
//                echo json_encode($company_categories)."<hr>";
                    foreach ($company_categories as $category) {
                        $selected_main_category = $data['service_type'];
                        foreach ($selected_main_category as $main_id) {
                            if ($category['main_category_id'] == $main_id) {
//                            echo json_encode($company_info)."<hr>";
                                array_push($company_list, $company_info);
                            }
                        }
                    }
                }
            }
        }
        $company_list=array_unique($company_list);
        $sorted_company=CompanyData::sort_companies_by_companytype($company_list);

        $emp_data=session('emp_data');
        $latest_blog=BlogData::get_latest_new(3);
        $site_profile=CompanyProfile::findOrFail(1);
        return view('user.preview')->with([
            'data'=>$emp_data,
            'main_categories'=>$main_categories,
            'sub_categories'=>$sub_categories,
            'keywords'=>$keyword,
            'company_list'=>$sorted_company,
            'latest_blog'=>$latest_blog,
            'site_profile'=>$site_profile
        ]);
    }

    function delete_employee($id){
        Employee::where('id',$id)->delete();
        Employee_Company::where('id',$id)->delete();
        return redirect('admin/employee');
    }

    function get_employee_byCompany($company_id){
        $employee=Employee_Company::where('company_id',$company_id)->orderBy('id','desc')->get();
        $employee_info=array();
        foreach ($employee as $item) {
            $employee_data=new EmployeeData($item->employee_id);
            array_push($employee_info,$employee_data->getEmployeeArr());
//            echo json_encode($employee_data->employee_arr)."<hr>";
        }
        return json_encode($employee_info);
    }

    function request_employee(){
        $login_company_id=session('login_company_id');
        $data=$this->get_employee_byCompany($login_company_id);
        $employee_list=json_decode($data);
        rsort($employee_list);

        $companies=View_user_company::findOrFail($login_company_id);
        $company_obj=new CompanyData($companies->id);
        $company_data=$company_obj->getCompanyInfoArr();

//        return json_encode($employee_list);
        return view('company_admin.requested_employee')->with([
            'url'=>'dashboard',
            'company_profile'=>$company_data,
            'employee'=>$employee_list
        ]);
    }
    function all_request_employee(){
        $employee=Employee::orderBy('id','desc')->get();
        $arr=[];
        foreach ($employee as $data){
            $emp_data=new EmployeeData($data->id);
            $emp_info=$emp_data->getEmployeeArr();
            $emp_info['requested_companies']=$emp_data->getRequestedCompanyArr();
            array_push($arr,$emp_info);
//            echo json_encode($emp_info['requested_companies'])."<hr>";
        }
        rsort($arr);
        return view('site_admin.employee_list')->with([
            'url'=>'employee',
            'employee'=>$arr
        ]);
    }

    function get_employee_detail($id){
        $emp=Employee::findOrFail($id);
        $emp_data=new EmployeeData($emp->id);
        $emp_arr=$emp_data->getEmployeeArr();
        $emp_arr['requested_companies']=$emp_data->getRequestedCompanyArr();
        $emp_arr['domain_url']=RenoMyanmar::$domain_url;
        return json_encode($emp_arr);
    }

    function get_employee_list(){
        $employee_arr=Employee::all();
        foreach ($employee_arr as $employee){
            $employee=new EmployeeData($employee->id);
            return json_encode($employee->get_employee_data())."<hr>";
        }
//        return $employee_arr[0]->id;
    }

    function delete_employee_from_company($company_id,$employee_id){
        Employee_Company::where('company_id',$company_id)->where('employee_id',$employee_id)->delete();
    }


    function edit_request_quote_data(Request $request){
        if($request->method()=="GET"){
            $emp_data=session('emp_data');
            $keyword=Keyword::all();
            $main_categories=Main_category::all();
            $sub_categories=Sub_category::all();
            $latest_blog=BlogData::get_latest_new(3);
            $site_profile=CompanyProfile::findOrFail(1);
            return view('user.edit_employee_data')->with([
                'data'=>$emp_data,
                'keywords'=>$keyword,
                'main_categories'=>$main_categories,// to show in header
                'sub_categories'=>$sub_categories,
                'latest_blog'=>$latest_blog,
                'site_profile'=>$site_profile
            ]);
        }
        else{

        }
    }
}
