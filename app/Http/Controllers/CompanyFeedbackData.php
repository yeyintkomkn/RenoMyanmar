<?php
/**
 * Created by PhpStorm.
 * User: Alintan
 * Date: 1/3/2019
 * Time: 5:39 PM
 */

namespace App\Http\Controllers;


use App\Company_feedback;

class CompanyFeedbackData extends AdminFeedbackData
{
    function __construct($feedback_id)
    {
//        parent::__construct($feedback_id);
        $data=Company_feedback::findOrFail($feedback_id);
        $this->feedback=$this->set_feedback_data($data);
    }

    protected function set_feedback_data($feedback)
    {
        $feedback_data=array();
        $feedback_data['id']=$feedback->id;
        $feedback_data['photo']=$feedback->picture;
        $feedback_data['photo_url']=RenoMyanmar::$domain_url."upload/company_feedback/".$feedback->picture;
        $feedback_data['name']=$feedback->name;
        $feedback_data['description']=$feedback->description;
        $feedback_data['date']=$feedback->created_at;

        return $feedback_data;
    }


}