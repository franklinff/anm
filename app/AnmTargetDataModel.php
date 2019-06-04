<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnmTargetDataModel extends Model
{
    use SoftDeletes;
    protected $table = "anm_target_data";
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    public $timestamps = false;

    public function block(){
    	return $this->hasOne('App\Block', 'id', 'block');
    }

    public function district()
    {
    	return $this->hasOne('App\District', 'id', 'district');
    }
}
