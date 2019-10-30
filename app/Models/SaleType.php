<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleType extends Model
{
    protected $table = 'sale_type';
    protected $dates = ['created_at', 'created_at'];
    protected $fillable = ['id', 'type_name'];
}
