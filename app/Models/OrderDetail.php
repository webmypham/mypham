<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $dates = ['created_at', 'created_at'];
    protected $fillable = [
        'id_order',
        'id_product',
        'quantity',
        'price',
    ];
}
