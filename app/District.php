<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    
    protected $table = "master_district";
    public $timestamps = false;

    public function blocks()
    {
    	return $this->hasMany('App\Block', 'district_id', 'id');
    }
}
