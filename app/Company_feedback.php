<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company_feedback extends Model
{
    protected $fillable=['id','company_id','picture','name','description'];
}
