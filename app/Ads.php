<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $fillable=['photo','start_date','end_date','link'];

    function webpage(){
        return $this->hasMany('App\AdsWebpage');
    }
}
