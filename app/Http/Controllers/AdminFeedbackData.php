<?php
/**
 * Created by PhpStorm.
 * User: Alintan
 * Date: 12/21/2018
 * Time: 3:00 PM
 */

namespace App\Http\Controllers;


use App\AdminFeedback;

class AdminFeedbackData
{
    protected $feedback;
    function __construct($feedback_id) {
        $data=AdminFeedback::findOrFail($feedback_id);
        $this->feedback=$this->set_feedback_data($data);
    }

    protected function set_feedback_data($feedback){
        $feedback_data=array();
        $feedback_data['id']=$feedback->id;
        $feedback_data['photo']=$feedback->picture;
        $feedback_data['photo_url']=RenoMyanmar::$domain_url."upload/admin_feedback/".$feedback->picture;
        $feedback_data['name']=$feedback->name;
        $feedback_data['description']=$feedback->description;
        $feedback_data['date']=$feedback->created_at;

        return $feedback_data;
    }

    public function get_feedback_data(){
        return $this->feedback;
    }
}