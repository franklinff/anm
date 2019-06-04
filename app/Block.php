<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $table = "master_block";
    public $timestamps = false;

    public function district()
    {
    	return $this->belongsTo('App\District', 'district_id', 'id');
    }
}
