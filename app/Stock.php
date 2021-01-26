<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';
    protected $fillable = ['product_code','product_id','vendor','quantity','unit','price','date','storage'];
}
