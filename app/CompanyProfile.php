<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $fillable=['id','email','phone','address','video','android','ios','facebook',
                        'google','twitter','instagram','about_us','what_we_do','vision_and_mission'];
}
