<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IStorage extends Model
{
    protected $table = 'storages';
    protected $fillable = ['name','location','product_category'];
}
