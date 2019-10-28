<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Config;
use DB;

class Receipt extends Model
{
    protected $table = 'receipts';
    protected $perPage = 20;
    protected $dates = ['created_at', 'created_at'];
    protected $fillable = [
        'type',
        'user_id',
        'product_id',
        'supplier',
        'quantity',
        'total_amount'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function product() {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public static function getReceipt($searchData) {
        $query = DB::table('receipts')
            ->select('receipts.*', 'products.name as product_name', 'users.name as user_name')
            ->leftJoin('products', 'products.id', '=','receipts.product_id')
            ->leftJoin('users', 'users.id', '=','receipts.user_id')
            ->orderBy('receipts.created_at', 'DESC');
        if (isset($searchData['product_id'])) {
            $query->where('receipts.product_id', '=', $searchData['product_id']);
        }
        if (isset($searchData['type'])) {
            $query->where('receipts.type', '=', $searchData['type']);
        }
        return $query->paginate();
    }
}
