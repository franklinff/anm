<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NudgeModel extends Model
{
    use SoftDeletes;
    protected $table = "nudges";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $dates = ['deleted_at'];

}
