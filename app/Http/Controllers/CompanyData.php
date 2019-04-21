<?php
/**
 * Created by PhpStorm.
 * User: Alintan
 * Date: 13/11/2018
 * Time: 23:26
 */

namespace App\Http\Controllers;


use App\Company;
use App\Company_feedback;
use App\Company_project;
use App\Employee_Company;
use App\Main_category;
use App\Sub_category;
use App\Sub_category_company;
use App\Top_company;
use App\View_user_company;

class CompanyData
{
   // var $id,$company_name,$email,$phone,$facebook_url,$address,$description,$location,$google_map_lat,$google_map_lon,$type,$vision_and_mission,$what_we_do,$why_join_us,$verify,$photo;
    protected $feedback_arr;
    protected $categories_arr;
    protected $company_info_arr;
    protected $project_arr;
    protected $requested_employee_arr;
    protected $suggest_company_arr;
    function __construct($id) {
//        $company=Company::findOrFail($id);
        $company=View_user_company::find($id);
        if($company!=null){
            $this->setCompanyInfoArr($company);
            $this->setCategoriesArr($company->id);
            $this->setFeedbackArr($company->id);
            $this->setProjectArr($company->id);
            $this->setRequestedEmployeeArr($company->id);
            $this->setSuggestCompanyArr();
        }
    }



    /**
     * @return mixed
     */
    public function getRequestedEmployeeArr()
    {
        return $this->requested_employee_arr;
    }



    /**
     * @return mixed
     */
    public function getFeedbackArr()
    {
        return $this->feedback_arr;
    }

    /**
     * @return array
     */
    public function getCategoriesArr()
    {
        return $this->categories_arr;
    }

    /**
     * @return mixed
     */
    public function getCompanyInfoArr()
    {
        return $this->company_info_arr;
    }

    /**
     * @return mixed
     */
    public function getProjectArr()
    {
        return $this->project_arr;
    }

    /**
     * @return mixed
     */
    public function getSuggestCompanyArr()
    {
        return $this->suggest_company_arr;
    }



//****************************************************************
    /**
     * @param mixed $requested_employee_arr
     */
    protected function setRequestedEmployeeArr($company_id)
    {
        $arr=Employee_Company::where('company_id',$company_id)->get();
        $this->requested_employee_arr = $arr;
    }
    /**
     * @param mixed $suggest_company_arr
     */
    protected function setSuggestCompanyArr()
    {
        $company_id_arr=array();
        foreach ($this->categories_arr as $category){
            $sub_category_id=$category['sub_category_id'];
            $subcategory_companies=Sub_category_company::where('subcategory_id',$sub_category_id)->get();
            foreach ($subcategory_companies as $subcategory_company){
                $companyId=$subcategory_company['company_id'];
                $company_data=Company::find($companyId);
                if ($company_data!=null){
                    if($company_data->verify==1 && $company_data->status==1){
                        array_push($company_id_arr,$companyId);
                    }
                }
            }
        }
        $company_id_arr = array_unique($company_id_arr);
        $suggest_arr=array();
        foreach ($company_id_arr as $company_id){
            $suggest_company=View_user_company::findOrFail($company_id);
            array_push($suggest_arr,$suggest_company);
        }
        $result = array_unique($suggest_arr);
        $result_array=[];
        if(count($result)>5){
            for ($i=0;$i<5;$i++){
                array_push($result_array,$result[$i]);
            }
        }
        else{
            $result_array=$result;
        }
//        return $result;
        $this->suggest_company_arr = $result_array;
    }
    /**
     * @param mixed $feedback_arr
     */
    protected function setFeedbackArr($company_id)
    {
        $arr=Company_feedback::where('company_id',$company_id)->get();
        $this->feedback_arr = $arr;
    }

    /**
     * @param array $categories_arr
     */
    protected function setCategoriesArr($company_id)
    {
        $arr=Sub_category_company::where('company_id',$company_id)->get();
        $sub_category=array();
        foreach ($arr as $data){
            $sub_category_id=$data['subcategory_id'];
            $sub_category_name=Sub_category::findOrFail($sub_category_id)['category_name'];
            $main_category_id=Sub_category::findOrFail($sub_category_id)['main_category_id'];
            $main_category_name=Main_category::findOrFail($main_category_id)['category_name'];

            $sub_arr=array(
                'sub_category_id'=>$sub_category_id,
                'sub_category_name'=>$sub_category_name,
                'main_category_id'=>$main_category_id,
                'main_category_name'=>$main_category_name
            );
            array_push($sub_category,$sub_arr);
        }
//        return $sub_category;
        $this->categories_arr = $sub_category;
    }

    /**
     * @param mixed $company_info_arr
     */
    protected function setCompanyInfoArr($company_info_arr)
    {
        if ($company_info_arr->photo=="nologo.png"){
            $company_info_arr['photo_url']=RenoMyanmar::$domain_url."upload/no_image_default.png";
        }
        else{
            $company_info_arr['photo_url']=RenoMyanmar::$domain_url."upload/company_logo/".$company_info_arr->photo;
        }


        $company_id=$company_info_arr['id'];
        $arr=Top_company::where('company_id',$company_id)->get();
        if(count($arr)==0){
            $company_info_arr['is_top_company']=false;
        }
        else{
            $company_info_arr['is_top_company']=true;
        }

        $this->company_info_arr = $company_info_arr;
    }

    /**
     * @param mixed $project_arr
     */
    protected function setProjectArr($company_id)
    {
        $arr=Company_project::where('company_id',$company_id)->get();
        $this->project_arr = $arr;
    }



//sort by free/paid
    public static function sort_companies_by_companytype($companies_arr){
        $free_company=[];
        $paid_company=[];
        foreach ($companies_arr as $company){
            if($company['type']=="paid"){
                array_push($paid_company,$company);
            }
            else{
                array_push($free_company,$company);
            }
        }
        shuffle($free_company);
        shuffle($paid_company);
        $arr=array_merge($paid_company,$free_company);
        return $arr;
    }











    public function get_categories($company_id){
        $arr=Sub_category_company::where('company_id',$company_id)->get();
        $sub_category=array();
        foreach ($arr as $data){
            $sub_category_id=$data['subcategory_id'];
            $sub_category_name=Sub_category::findOrFail($sub_category_id)['category_name'];
            $main_category_id=Sub_category::findOrFail($sub_category_id)['main_category_id'];
            $main_category_name=Main_category::findOrFail($main_category_id)['category_name'];

            $sub_arr=array('sub_category_id'=>$sub_category_id,'sub_category_name'=>$sub_category_name,'main_category_id'=>$main_category_id,'main_category_name'=>$main_category_name);
            array_push($sub_category,$sub_arr);
        }
        return $sub_category;
    }



    public function get_feedback($company_id){
        $arr=Company_feedback::where('company_id',$company_id)->get();
        return $arr;
    }

    public function get_project($company_id){
        $arr=Company_project::where('company_id',$company_id)->get();
        return $arr;
    }

    public function get_company_data(){
       $arr=array(
           'company_info_arr'=>$this->company_info_arr,
           'project_arr'=>$this->project_arr,
           'categories_arr'=>$this->categories_arr,
           'feedback_arr'=>$this->feedback_arr
       );
       return $arr;
    }

    public function get_suggest_company(){
        $company_id_arr=array();
        foreach ($this->categories_arr as $category){
            $sub_category_id=$category['sub_category_id'];
            $subcategory_companies=Sub_category_company::where('subcategory_id',$sub_category_id)->get();
            foreach ($subcategory_companies as $subcategory_company){
                $companyId_arr=$subcategory_company['company_id'];
                array_push($company_id_arr,$companyId_arr);
            }
        }
        $suggest_arr=array();
        foreach ($company_id_arr as $company_id){
            $suggest_company=View_user_company::findOrFail($company_id);
            array_push($suggest_arr,$suggest_company);
        }
        $result = array_unique($suggest_arr);
        return $result;
    }




}