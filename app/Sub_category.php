<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub_category extends Model
{
    protected $fillable=[
        'id','main_category_id','category_name'
    ];

    //not found where used
    public function sub_category_companies(){
        return $this->hasMany('App\Sub_category_company');
    }

    public function main_category(){
        return $this->belongsTo('App\Main_category');
    }
}
