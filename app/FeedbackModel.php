<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedbackModel extends Model
{
    protected $table = "patient_feedback";
    protected $primaryKey = 'id';
    public $timestamps = false;
}
