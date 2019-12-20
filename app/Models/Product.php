<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class Product extends Model
{
    protected $table = 'products';
    protected $perPage = 20;
    protected $dates = ['created_at', 'created_at'];
    protected $fillable = ['sku', 'name', 'id_category', 'description', 'price', 'detail', 'image', 'quantity', 'sale_id', 'input_price', 'status', 'return_quantity'];

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

    public static function getItemByCategory($id) {
        DB::table('products')
            ->select('products.*', 'sale.value as sale_value', 'sale_type_id')
            ->join('sale', function($join) {
                $join->on('sale.id', '=', 'products.sale_id');
            })
            ->whereDate('sale.date_end', '<', Carbon::now()->format('Y-m-d'))
            ->update(['sale_id' => 0]);
        $category = Category::find($id);
        if ($category->is_parent) {
            $categories = Category::getCategoryChild($id);
            foreach ($categories as $key => $value) {
                $idCategories[] = $value->id;
            }
        } else {
            $idCategories[] = $id;
        }
        $query = DB::table('products')
                ->select('products.*', 'sale.value as sale_value', 'sale_type_id')
                ->leftJoin('sale', function($join) {
                    $join->on('sale.id', '=', 'products.sale_id');
                })
                ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
                ->whereIn('id_category', $idCategories)
                ->orderBy('products.id', 'DESC');
        $products = $query->paginate(16);
        foreach($products as $key => $value) {
            switch ($value->sale_type_id) {
                case 1:
                    $products[$key]->sale = $value->sale_value.'%';
                    $products[$key]->sale_price = $products[$key]->price - $products[$key]->price * $value->sale_value / 100;
                    break;
                case 2:
                    $products[$key]->sale = number_format($value->sale_value, 0).'đ';
                    $products[$key]->sale_price = $products[$key]->price - $products[$key]->sale_value;
                    break;
                default:
                    break;
            }
        }

        return $products;
    }

    public function category() {
        return $this->belongsTo('App\Models\Category', 'id_category', 'id');
    }
}
