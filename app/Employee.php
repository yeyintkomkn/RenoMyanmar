<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable=[
        'id',
        'username',
        'email',
        'phone',
        'address',
        'budget_range',
        'category_id_arr',
        'project_type_arr',
        'start_date',
        'current_situation',
        'note',
        'file'
    ];
}
