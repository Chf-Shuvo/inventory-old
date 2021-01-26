<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RqProducts extends Model
{
    protected $table = 'rq_products';
    protected $fillable = ['requisition_id','product_id','quantity'];
}
