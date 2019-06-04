<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MoicRanking extends Model
{
    use SoftDeletes;
    protected $table = "moic_ranking";
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    protected $fillable = ['block','phc_en','phc_hin','dr_name_en','dr_name_hin','mobile','email','scenerio','uploaded_file','ranking_pdf'];
}
