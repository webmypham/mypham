<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'products';
    protected $perPage = 20;
    protected $dates = ['created_at', 'created_at'];
    protected $fillable = ['name', 'id_category', 'description', 'price', 'detail', 'image', 'quantity'];

    public static function getProducts($searchData) {
        $query = DB::table('products')
            ->select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'categories.id', '=','products.id_category')
            ->orderBy('products.id', 'DESC');
        if (isset($searchData['name'])) {
            $query->where('products.name', 'LIKE', '%'.$searchData['name'].'%');
        }
        if (isset($searchData['id_category'])) {
            $query->where('products.id_category', '=', $searchData['id_category']);
        }
        return $query->paginate();
    }
}
