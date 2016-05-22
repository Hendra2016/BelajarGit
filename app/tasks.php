<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tasks extends Model
{
public $timestamps = false;
	protected $fillable = ['id','user_id','list_name','list_date'];
    //
}
