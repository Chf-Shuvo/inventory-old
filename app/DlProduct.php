<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DlProduct extends Model
{
    protected $table = 'dl_products';
    protected $fillable = ['requisition_id','department','product_id','quantity'];
}
