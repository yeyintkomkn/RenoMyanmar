<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable=[
        'id','company_name','email','phone','facebook_url','address','description','location','google_map_lat','google_map_lon',
        'type','vision_and_mission','what_we_do','why_join_us','photo'
    ];

}
