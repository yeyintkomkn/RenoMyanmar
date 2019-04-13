<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company_project extends Model
{
    protected $fillable=['id','company_id','project_title','photo'];
}
