<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RankingZip extends Model
{
    protected $table = "ranking_zip_files";
    protected $primaryKey = 'id';
    protected $fillable = ['month','year','zip_file','is_extracted'];
}
