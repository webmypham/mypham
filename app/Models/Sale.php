<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sale';
    protected $dates = ['created_at', 'created_at'];
    protected $fillable = ['name', 'value', 'sale_type_id', 'status', 'date_start', 'date_end'];

    public static function getAll() {
        // $result = DB::table('sale')
        //     ->select()
        //     ->join('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
            
    }

    public function saleType() {
        return $this->belongsTo('App\Models\SaleType', 'sale_type_id', 'id');
    }
}
