<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    protected $table = 'requisitions';
    protected $fillable = ['department','submitted_By','approvedBy','delivery_status','delivered_by'];
}
