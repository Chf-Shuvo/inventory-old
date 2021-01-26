<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisition_Temp extends Model
{
    protected $table = 'requisition__temps';
    protected $fillable = ['department','submittedBy'];
}
