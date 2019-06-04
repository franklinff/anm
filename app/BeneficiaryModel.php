<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BeneficiaryModel extends Model
{
    protected $table = "beneficary_details";
    protected $primaryKey = 'id';
    public $timestamps = false;
}
