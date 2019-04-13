<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminFeedback extends Model
{
    protected $fillable=['id','picture','name','description'];
}
