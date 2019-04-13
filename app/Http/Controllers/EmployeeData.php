<?php
/**
 * Created by PhpStorm.
 * User: Alintan
 * Date: 22/11/2018
 * Time: 22:22
 */

namespace App\Http\Controllers;


use App\Employee;
use App\Employee_Company;

class EmployeeData
{
    protected $employee_arr;
    protected $company_arr;
    function __construct($id) {
        $this->setEmployeeArr($id);
        $this->setRequestedCompanyArr($id);
    }

    /**
     * @return mixed
     */
    public function getEmployeeArr()
    {
        return $this->employee_arr;
    }

    /**
     * @param mixed $employee_arr
     */
    protected function setEmployeeArr($id)
    {
        $emp_data=Employee::findOrFail($id);
        $emp_data['attach_file']=RenoMyanmar::$domain_url.'upload/employee_upload_file/'.$emp_data->file;
//        $category_arr=$emp_data->category_id_arr;
//        foreach ($category_arr as $data){
//
//        }
        $this->employee_arr = $emp_data;
    }

    /**
     * @return mixed
     */
    public function getRequestedCompanyArr()
    {
        return $this->company_arr;
    }

    /**
     * @param mixed $company_arr
     */
    protected function setRequestedCompanyArr($id)
    {
        $requested_company=Employee_Company::where('employee_id',$id)->get();
        $arr=[];
        foreach ($requested_company as $data){
            $company=new RealCompanyData($data->company_id);
            array_push($arr,$company->getCompanyInfoArr());
        }
        $this->company_arr = $arr;
    }

//    function get_employee_data(){
//        $arr=array('employee_arr'=>$this->company_arr,'company_arr'=>$this->company_arr);
//        return json_encode($this->employee_arr);
//    }




}