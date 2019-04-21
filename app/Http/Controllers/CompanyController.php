<?php

namespace App\Http\Controllers;

use App\Company;
use App\Company_feedback;
use App\Company_project;
use App\CompanyProfile;
use App\Main_category;
use App\Project;
use App\Sub_category;
use App\Sub_category_company;
use App\Top_company;
use App\User;

use App\View_main_category_company;
use App\View_user_company;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\View\View;
use function PHPSTORM_META\type;

class CompanyController extends Controller
{

//    show company profile page
    function index(){
        $login_company_id=session('login_company_id');

        $company=Company::findOrFail($login_company_id);
        //if not activate
        if($company->verify==0){
            return view('company_admin.not_activate_page');
        }
        else if($company->status==0){
            return 'You Are Banned by Admin';
        }
        else{
            $companies=View_user_company::findOrFail($login_company_id);
            $company_obj=new CompanyData($companies->id);
            $company_data=$company_obj->getCompanyInfoArr();

            return view('company_admin.dashboard')->with([
                'url'=>'dashboard',
                'company_profile'=>$company_data
                ]);
        }

    }

    function register(Request $request){
            $company_name=$request->get('company_name');
            $phone=$request->get('phone');
            $email=$request->get('email');
            $password=$request->get('password');
            $retype_password=$request->get('retype_password');

            if($password==$retype_password){
//                return $company_name.'<br>'.$phone.'<br>'.$email.'<br>'.$password;
                $company=Company::create([
                    'company_name'=>$company_name,
                    'phone'=>$phone,
                    'email'=>$email
                ])->id;

//                $company=Company::where('email',$email)->first();
                //return $company->id;
                User::create([
                    'company_id'=>$company->id,
                    'email'=>$email,
                    'password'=>Hash::make($password)
                ]);
    //            return redirect('/admin/blog/insert')->with('success_msg','Upload Blog Success!');
                return redirect('/')->with('success_msg','Register Success! Please Login!');
            }
            return redirect('/')->with('reg_error_msg','Password Does not Match!');

    }

    function edit_company_profile(Request $request){
        if ($request->isMethod('get')){
            $login_company_id=session('login_company_id');

//            $companies=Company::findOrFail($login_company_id);
            $company_obj=new RealCompanyData($login_company_id);
            $company_data=$company_obj->getCompanyInfoArr();
            $company_category=$company_obj->getCategoriesArr();

            $sub_categories=Sub_category::all();
            $main_categories=Main_category::all();

//            return $company_category;
            return view('company_admin.company_profile')->with([
                'url'=>'company_profile',
                'company_profile'=>$company_data,

                'main_categories'=>$main_categories,
                'sub_categories'=>$sub_categories,
                'company_categories'=>$company_category
            ]);
        }
        else{
            $company_name=$request->get('company_name');
            $email=$request->get('email');
            $phone=$request->get('phone');
            $address=$request->get('address');
            $facebook_url=$request->get('facebook_url');
            $website_url=$request->get('website_url');
            $vision_and_mission=$request->get('vision_and_mission');
            $what_we_do=$request->get('what_we_do');
            $why_join_us=$request->get('why_join_us');
            $location=$request->get('location');

//            $sub_category_id_arr=$request->get('sub_category_id');

            $login_company_id=session('login_company_id');

//            return $sub_category_id;
            Company::where('id',$login_company_id)->update([
                'company_name'=>$company_name,
                'email'=>$email,
                'phone'=>$phone,
                'facebook_url'=>$facebook_url,
                'website_url'=>$website_url,
                'address'=>$address,
                'location'=>$location,
                'vision_and_mission'=>$vision_and_mission,
                'what_we_do'=>$what_we_do,
                'why_join_us'=>$why_join_us,
            ]);

            if ($request->hasFile('logo')){
                $file=$request->file('logo');
                $file_name=uniqid().'_'.$file->getClientOriginalName();
                $file->move(public_path().'/upload/company_logo/',$file_name);

                $company=Company::findOrFail($login_company_id);
                $image_path=public_path().'/upload/company_logo/'.$company->photo;
                if($company->photo!="nologo.png"){
                   if(file_exists($image_path)){
                       unlink($image_path);
                   }
                }
                Company::where('id',$login_company_id)->update([
                    'photo'=>$file_name,
                ]);
            }


            return redirect('company/company_profile')->with('success_msg','Updating Success...');
//            return view('company.edit_company_profile')->with(array('main_categories'=>$main_categories,'sub_categories'=>$sub_categories,'company_profile'=>$company_profile,'selected_category'=>$selected_category));  ;
        }
    }

    function edit_company_type(Request $request){
        $company_types=$request->get('company_type');
        $login_company_id=session('login_company_id');
        Sub_category_company::where('company_id',$login_company_id)->delete();
//        Sub_category_company::create()
        foreach ($company_types as $data){
            Sub_category_company::create(['company_id'=>$login_company_id,'subcategory_id'=>$data]);
        }
        return redirect('company/company_profile')->with('success_msg','Updating Success...');
    }

    function edit_company_by_admin(Request $request){
        $id=$request->get('id');
        $company_name=$request->get('company_name');
        $company_type=$request->get('company_type');
        $email=$request->get('email');
        $phone=$request->get('phone');
        $address=$request->get('address');
        $description=$request->get('description');
        $facebook_url=$request->get('facebook_url');
        $website_url=$request->get('website_url');
        $vision_and_mission=$request->get('vision_and_mission');
        $what_we_do=$request->get('what_we_do');
        $why_join_us=$request->get('why_join_us');
        $location=$request->get('location');

        if ($request->hasFile('photo')){
            $file=$request->file('photo');
            $image_name=uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/upload/company_logo/',$image_name);

            $company=Company::findOrFail($request->id);
            $image_path=public_path().'/upload/company_logo/'.$company->photo;
            if(file_exists($image_path)){
                unlink($image_path);
            }
            Company::findOrFail($id)->update([
                'photo'=>$image_name
            ]);
        }

        Company::findOrFail($request->id)->update([
            'company_name'=>$company_name,
            'email'=>$email,
            'phone'=>$phone,
            'facebook_url'=>$facebook_url,
            'website_url'=>$website_url,
            'address'=>$address,
            'location'=>$location,
            'vision_and_mission'=>$vision_and_mission,
            'what_we_do'=>$what_we_do,
            'why_join_us'=>$why_join_us,
            'type'=>$company_type,
            'description'=>$description,
        ]);
    }

    function edit_company_category(Request $request){
        $login_company_id=session('login_company_id');
        Sub_category_company::where('company_id',$login_company_id)->delete();

        $sub_category_id_arr=$request->get('sub_category_id');
        for ($i=0;$i<count($sub_category_id_arr);$i++){
            Sub_category_company::create(['company_id'=>$login_company_id,'sub_category_id'=>$sub_category_id_arr[$i]]);
        }
    }

    function main_category_company($main_category_id){
        $company_arr=[];
        $arr=View_main_category_company::where('main_category_id',$main_category_id)->paginate(10);
        foreach ($arr as $data) {
            $company=new CompanyData($data->company_id);
            $company_data=$company->getCompanyInfoArr();
            $company_data['categories']=$company->getCategoriesArr();
            //if company_id is not exit in view_company table
            if($company_data['categories']!=null){
                array_push($company_arr,$company_data);
            }

        }
        $company_arr=array_unique($company_arr);
        $company_data_arr=CompanyData::sort_companies_by_companytype($company_arr);
        $sub_categories=Sub_category::all();
        $main_categories=Main_category::all();

        $ads=new AdsController();
        $category_company_ads=$ads->ads_by_page(3); // 1 is category_company page in page table

        $latest_blog=BlogData::get_latest_new(3);
        $site_profile=CompanyProfile::findOrFail(1);
        return view('user.company_list')->with([
            'companies'=>$company_data_arr,
            'main_categories'=>$main_categories,// to show in header
            'sub_categories'=>$sub_categories,

            'ads'=>$category_company_ads,
            'latest_blog'=>$latest_blog,
            'site_profile'=>$site_profile,
            'paginate'=>$arr

        ]);
    }

    function sub_category_company($sub_category_id){
        $company_arr=[];
        $arr=Sub_category_company::where('subcategory_id',$sub_category_id)->paginate(10);
//        return $arr;
                foreach ($arr as $data) {
            $company=new CompanyData($data->company_id);
            $company_data=$company->getCompanyInfoArr();
            $company_data['categories']=$company->getCategoriesArr();
            //if company_id is not exit in view_company table
            if($company_data['categories']!=null){
                array_push($company_arr,$company_data);
            }

        }
        $company_data_arr=CompanyData::sort_companies_by_companytype($company_arr);
        $sub_categories=Sub_category::all();
        $main_categories=Main_category::all();

        $ads=new AdsController();
        $area_three_ads=$ads->ads_by_page(3); // 1 is category_company page in page table

        $latest_blog=BlogData::get_latest_new(3);
        $site_profile=CompanyProfile::findOrFail(1);
        return view('user.company_list')->with([
            'companies'=>$company_data_arr,
            'main_categories'=>$main_categories,// to show in header
            'sub_categories'=>$sub_categories,

            'ads'=>$area_three_ads,
            'latest_blog'=>$latest_blog,
            'site_profile'=>$site_profile,
            'paginate'=>$arr

        ]);
    }

    function show_category_company(){
        $main_categories=Main_category::all();
        $sub_categories=Sub_category::where('id','>',0)->paginate(8);
        //calculate total company
        for ($i=0;$i<count($sub_categories);$i++){
            $count=DB::select('SELECT count(id) AS count FROM sub_category_companies WHERE subcategory_id='.$sub_categories[$i]->id);
            $sub_categories[$i]->count=(object)$count[0];
        }

        $latest_blog=BlogData::get_latest_new(3);
        $site_profile=CompanyProfile::findOrFail(1);
        return view('user.show_sub_category_company')->with([
            'main_categories'=>$main_categories,// to show in header
            'sub_categories'=>$sub_categories,
            'latest_blog'=>$latest_blog,
            'site_profile'=>$site_profile
        ]);
    }

    function company_insert_or_edit_feedback(Request $request){
        $login_company_id=session('login_company_id');
        if ($request->get('type')=="insert"){
            $name=$request->get('name');
            $description=$request->get('description');
//            $image_name="";
            if ($request->hasFile('photo')){
                $file=$request->file('photo');
                $image_name=uniqid().'_'.$file->getClientOriginalName();
                $file->move(public_path().'/upload/company_feedback/',$image_name);
            }


            Company_feedback::create([
                'company_id'=>$login_company_id,
                'name'=>$name,
                'description'=>$description,
                'picture'=>$image_name
            ]);
            return redirect('company/company_feedback')->with('success_msg','Success Adding New FeedBack');
        }
        else{
            $feedback_id=$request->get('feedback_id');
            $name=$request->get('name');
            $description=$request->get('description');
//            $image_name='';
            if ($request->hasFile('photo')){
                //delete old file form
                $data=Company_feedback::findOrFail($feedback_id);
                $image_path=public_path().'/upload/company_feedback/'.$data->picture;
                if(file_exists($image_path)){
                    unlink($image_path);
                }

                $file=$request->file('photo');
                $image_name=uniqid().'_'.$file->getClientOriginalName();
                $file->move(public_path().'/upload/company_feedback/',$image_name);

                Company_feedback::where('id',$feedback_id)->update([
                    'company_id'=>$login_company_id,
                    'name'=>$name,
                    'picture'=>$image_name,
                    'description'=>$description
                ]);
            }
            else{
                Company_feedback::where('id',$feedback_id)->update([
                    'company_id'=>$login_company_id,
                    'name'=>$name,
                    'description'=>$description
                ]);
            }
            return redirect('company/company_feedback')->with('success_msg','Success Editing FeedBack');
        }
    }

    function company_insert_or_edit_project(Request $request){
        $login_company_id=session('login_company_id');
        if ($request->get('type')=="insert"){
            $project_title=$request->get('title');
            $image_name="";
            if ($request->hasFile('photo')){
                $file=$request->file('photo');
                $image_name=uniqid().'_'.$file->getClientOriginalName();
                $file->move(public_path().'/upload/company_project/',$image_name);
            }
            Company_project::create([
                'company_id'=>$login_company_id,
                'project_title'=>$project_title,
                'photo'=>$image_name
            ]);
            return redirect('company/photo')->with('success_msg','Success Adding New Project');
        }
        else{
            $project_id=$request->get('project_id');
            $project_title=$request->get('title');
//            $image_name='';
            if ($request->hasFile('photo')){
                //delete old file form
                $data=Company_project::findOrFail($project_id);
                $image_path=public_path().'/upload/company_project/'.$data->photo;
                if(file_exists($image_path)){
                    unlink($image_path);
                }

                $file=$request->file('photo');
                $image_name=uniqid().'_'.$file->getClientOriginalName();
                $file->move(public_path().'/upload/company_project/',$image_name);

                Company_project::where('id',$project_id)->update([
                    'company_id'=>$login_company_id,
                    'project_title'=>$project_title,
                    'photo'=>$image_name,
                ]);
            }
            else{
                Company_project::where('id',$project_id)->update([
                    'company_id'=>$login_company_id,
                    'project_title'=>$project_title
                ]);
            }
            return redirect('company/photo')->with('success_msg','Success Editing Project');
        }
    }

    function company_feedback_detail($id){
        $feedback=Company_feedback::find($id);
        $data=new CompanyFeedbackData($feedback->id);
        return json_encode($data->get_feedback_data());
    }

    function get_company_project($id){
        $project=Company_project::find($id);
        $project['photo_url']=RenoMyanmar::$domain_url.'upload/company_project/'.$project['photo'];
        return json_encode($project);
    }

    function company_photo(Request $request){
        if ($request->isMethod('get')){
            $login_company_id=session('login_company_id');
//            table name is project*****************
            $projects=Company_project::where('company_id',$login_company_id)->get();

            $companies=View_user_company::findOrFail($login_company_id);
            $company_obj=new CompanyData($companies->id);
            $company_data=$company_obj->getCompanyInfoArr();

            return view('company_admin.company_photo')->with([
                'url'=>'photo',
                'company_profile'=>$company_data,
                'company_project'=>$projects
            ]);
        }
        else{

        }
    }

    function company_feedback(){
        $login_company_id=session('login_company_id');

        $feedback=Company_feedback::where('company_id',$login_company_id)->get();
        $arr=[];
        foreach ($feedback as $data){
            $company_feedback=new CompanyFeedbackData($data->id);
            array_push($arr,$company_feedback->get_feedback_data());
        }

        $companies=View_user_company::findOrFail($login_company_id);
        $company_obj=new CompanyData($companies->id);
        $company_data=$company_obj->getCompanyInfoArr();
        return view('company_admin.company_feedback')->with([
            'url'=>'feedback',
            'company_profile'=>$company_data,
            'company_feedback'=>$arr
        ]);
    }
//    function insert_update(Request $request){
//        $login_company_id=session('login_company_id');
//        $name=$request->get('name');
//        $description=$request->get('description');
//
//        if ($request->hasFile('photo')){
//            $file=$request->file('photo');
//            $image_name=uniqid().'_'.$file->getClientOriginalName();
//            $file->move(public_path().'/upload/feedback/',$image_name);
//        }
//
//
//        Company_feedback::create([
//            'company_id'=>$login_company_id,
//            'name'=>$name,'description'=>$description,
//            'picture'=>$image_name
//        ]);
//        return redirect('company_feedback')->with('success_msg','Success Adding New FeedBack');
//    }



    function get_24hr_pending_company(){
        $start_time = Carbon::now()->subHour(24);
        $end_time=Carbon::now();

        $company=Company::where('verify',0)->where('created_at','>=',$start_time)->where('created_at','<=',$end_time)->get();

        return json_encode($company);
    }

    function get_pending_company(){
        $company=Company::where('verify',false)->get();
        foreach ($company as $data){
            $data['photo_url']=RenoMyanmar::$domain_url."upload/company_logo/".$data->photo;
        }
        return json_encode($company);
        //##########cannot use companydata class##########
        //##########This class is only for activate company##########
    }

    function get_all_activated_company(){
        $company=Company::where('verify',1)->get();
        $arr=[];
        foreach ($company as $data){
            $company_data=new RealCompanyData($data->id);
            array_push($arr,$company_data->getCompanyInfoArr());
        }
        return json_encode($arr);
    }

    function get_top_company(){
        $top_companies=Top_company::all();
        $top_companies_data=array();
        foreach ($top_companies as $company){
            $company_id=$company->company_id;
            $company=new CompanyData($company_id);
            $company_info=$company->getCompanyInfoArr();
            $company_categories=$company->getCategoriesArr();//sub category

            $company_info['categories']=$company_categories;

            array_push($top_companies_data,$company_info);
        }
        return json_encode($top_companies_data);
    }

    function get_paid_company(){
        $companies=View_user_company::where('type','paid')->get();
//        $company=Company::where('verify',1)->where('type','paid')->get();
        $arr=array();
        foreach ($companies as $company){
            $company_id=$company->id;
            $company=new CompanyData($company_id);
            $company_info=$company->getCompanyInfoArr();
            $company_categories=$company->getCategoriesArr();//sub category

            $company_info['categories']=$company_categories;

            array_push($arr,$company_info);
        }
        return json_encode($arr);
    }

    function get_free_company(){
//        $companies=View_user_company::all();
        $companies=View_user_company::where('type','free')->get();
        $arr=array();
        foreach ($companies as $company){
            $company=new CompanyData($company->id);
            $company_info=$company->getCompanyInfoArr();
            $company_categories=$company->getCategoriesArr();//sub category
            $company_info['categories']=$company_categories;

            array_push($arr,$company_info);
        }
        return json_encode($arr);
    }

    function get_ban_company(){
//        $companies=View_user_company::all();
//        $companies=View_user_company::where('status',0)->get();
        $companies=Company::where('status',0)->where('verify',1)->get();
        $arr=array();
        foreach ($companies as $company){
            $company=new RealCompanyData($company->id);
            $company_info=$company->getCompanyInfoArr();
            $company_categories=$company->getCategoriesArr();//sub category
            $company_info['categories']=$company_categories;

            array_push($arr,$company_info);
        }
        return json_encode($arr);
    }

    function delete_company($id){
//        Company::where('id',$id)->update(['verify'=>true]);
        Company::findOrFail($id)->delete();

        // $company=Company::findOrFail($id);
        // $image_path=public_path().'/upload/company_logo/'.$company->photo;
        // if(file_exists($image_path)){
        //     unlink($image_path);
        // }
    }

    function activate_pending($id){
        Company::where('id',$id)->update(['verify'=>true]);
    }

    function ban_company($id,$type){
        Company::where('id',$id)->update(['status'=>$type]);
    }

    function top_company($id,$type){

//        add to top
        if($type==0){
            Top_company::create([
                'company_id'=>$id
            ]);
            return "insert";
        }
//        delete from top
        else{
            Top_company::where('company_id',$id)->delete();
            return "delete";
        }
    }

    function get_all_company_order_by_name(){
        $company=Company::orderBy('company_name')->get();
        return json_encode($company);
    }

    function upgrade_company_type($company_id,$type){
        Company::where('id',$company_id)->update(['type'=>$type]);
        return "Success";
    }

    function search_company(Request $request){
//        $company_name='hacker';
//        $main_category_id=1;
//        $location='Yangon';
        $company_name=$request->get('company_name');
        $main_category_id=$request->get('main_category');
        $location=$request->get('location');
//        echo json_encode($request->all())."<hr><br><br>";

        if(isset($company_name) && isset($main_category_id) && isset($location)){
//            echo "name , main_category , location";
            $company=View_user_company::where('company_name', 'like', '%'.$company_name.'%')->where('location',$location)->paginate(10);
            $company_arr=CompanyData::sort_companies_by_companytype($company);
            $company_data=$this->get_company_data($company_arr,$main_category_id);
        }
        else if(isset($company_name) && isset($main_category_id)){
//            echo "name , main_category ";
            $company=View_user_company::where('company_name', 'like', '%'.$company_name.'%')->paginate(10);
            $company_arr=CompanyData::sort_companies_by_companytype($company);
            $company_data=$this->get_company_data($company_arr,$main_category_id);
        }
        else if(isset($main_category_id) && isset($location)){
//            echo " main_category , location";
            $company=View_user_company::where('location',$location)->paginate(10);
            $company_arr=CompanyData::sort_companies_by_companytype($company);
            $company_data=$this->get_company_data($company_arr,$main_category_id);
        }
        else if(isset($company_name) && isset($location)){
//            echo "name , location";
            $company=View_user_company::where('company_name', 'like', '%'.$company_name.'%')->where('location',$location)->paginate(10);
            $company_arr=CompanyData::sort_companies_by_companytype($company);
            $company_data=$this->get_company_data($company_arr,$main_category_id);
        }
        else if(isset($main_category_id)){
//            echo " main_category";
            $company=View_user_company::paginate(10);
            $company_arr=CompanyData::sort_companies_by_companytype($company);
            $company_data=$this->get_company_data($company_arr,$main_category_id);
        }
        else if(isset($company_name)){
//            echo "name";
            $company=View_user_company::where('company_name', 'like', '%'.$company_name.'%')->paginate(10);
            $company_arr=CompanyData::sort_companies_by_companytype($company);
            $company_data=$this->get_company_data($company_arr,$main_category_id);
        }
        else if(isset($location)){
//            echo " location";
//            $paid_company=View_user_company::where('type','paid')->where('location',$location)->get();
//
//            $free_company=View_user_company::where('type','free')->where('location',$location)->get();
//
//            $company_data=$this->get_company_data($paid_company,$free_company,$main_category_id);
            $company=View_user_company::where('location',$location)->paginate(10);
            $company_arr=CompanyData::sort_companies_by_companytype($company);
            $company_data=$this->get_company_data($company_arr,$main_category_id);

//            return $company_data;
        }
        else{
//            echo "nothing";
            $company=View_user_company::paginate(10);
            $company_arr=CompanyData::sort_companies_by_companytype($company);
            $company_data=$this->get_company_data($company_arr,$main_category_id);


        }
//        return "<br><br>".json_encode($company_data);
        $sub_categories=Sub_category::all();
        $main_categories=Main_category::all();
        $site_profile=CompanyProfile::findOrFail(1);
        $ads=new AdsController();
        $home_ads=$ads->ads_by_page(1); // 1 is home page in page table

        $latest_blog=BlogData::get_latest_new(3);
        return view('user.company_list')->with([
            'companies'=>$company_data,
            'main_categories'=>$main_categories,// to show in header
            'sub_categories'=>$sub_categories,
            'ads'=>$home_ads,
            'latest_blog'=>$latest_blog,
            'site_profile'=>$site_profile,
            'paginate'=>$company
        ]);
    }

    //called in search_company
    function get_company_data($company_arr,$main_category_id){
        if(!isset($main_category_id)){
            $main_category_id=0;
        }
        $company=CompanyData::sort_companies_by_companytype($company_arr);
        $company_data=[];
        foreach ($company as $data){
            $company=new CompanyData($data['id']);
            $company_info=$company->getCompanyInfoArr();
            $category=$company->getCategoriesArr();
            $company_info['domain_url']=RenoMyanmar::$domain_url;
//            echo json_encode(count($category))."<hr>";
            if(count($category)!=0){
                if($main_category_id==0){
                    $company_info['categories']=$category;
//                    echo json_encode($company_info);
                    array_push($company_data,$company_info);
                }
                else if($category[0]['main_category_id']==$main_category_id){
                    $company_info['categories']=$category;
//                    echo json_encode($company_info);
                    array_push($company_data,$company_info);
                }
            }
//
        }
//        echo json_encode($company_data);


        return $company_data;
    }





    function show_company_profile($id){
        $company=new CompanyData($id);
        $company_info=$company->getCompanyInfoArr();
        $company_feedbacks=$company->getFeedbackArr();
        $company_categories=$company->getCategoriesArr();//sub category
        $company_project=$company->getProjectArr();
        $suggest_company=$company->getSuggestCompanyArr();


        $company_info['categories']=$company_categories;
        $suggest_company_data=[];
        foreach ($suggest_company as $data){
            $company_suggest=new CompanyData($data->id);
            $suggest_company_info=$company_suggest->getCompanyInfoArr();
            $suggest_company_info['categories']=$company_suggest->getCategoriesArr();
            array_push($suggest_company_data,$suggest_company_info);
        }
        $suggest_arr=CompanyData::sort_companies_by_companytype($suggest_company_data);
        $main_categories=Main_category::all();
        $sub_categories=Sub_category::all();
        $latest_blog=BlogData::get_latest_new(3);
        $site_profile=CompanyProfile::findOrFail(1);
        return view('user.company_profile')->with([
            'company_info'=>$company_info,
            'company_feedbacks'=>$company_feedbacks,
            'company_project'=>$company_project,
            'suggest_company'=>$suggest_arr,

            'main_categories'=>$main_categories,// to show in header
            'sub_categories'=>$sub_categories,
            'latest_blog'=>$latest_blog,
            'site_profile'=>$site_profile
            ]);
//        return view('user.company_profile')->with(['company_data'=>$company_data,'suggest_company'=>$suggest_company]);
    }

    function get_company($id){
        $company=new RealCompanyData($id);
        $company_data=$company->getCompanyInfoArr();
        $company_data['categories']=$company->getCategoriesArr();
        return json_encode($company_data);
    }

}
