<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_Company extends Model
{
    protected $fillable=['id','employee_id','company_id'];
}
