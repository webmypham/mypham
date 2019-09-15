<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        $menus = Category::getParent();
        $listProduct = [];
        foreach ($menus as $menu) {
            $products = DB::table('products')
                ->where('id', $menu->id)
                ->orderBy('id', 'DESC')
                ->limit(8)
                ->get();
            $listProduct[$menu->id] = $products;
        }
        return view('index', [
            'menus' => $menus,
            'products' => $listProduct
        ]);
    }
}
