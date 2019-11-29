<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleType;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::all();
        return view('admin.sale.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $saleTypes = SaleType::all();
        $categories = Category::getAllCategoryChild();
        $products = Product::all();
        return view('admin.sale.create', compact('saleTypes', 'categories', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (empty($request->name) || empty($request->sale_type_id) || empty($request->value) || empty($request->date_start) || empty($request->date_end)) {
            return back()->withInput()->with('error', 'Vui lòng điền đầy đủ thông tin');
        }
        $data = [
            'name' => $request->name,
            'sale_type_id' => $request->sale_type_id,
            'value' => $request->value,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'status'    => 0
        ];
        $sale = Sale::create($data);
        $products = $request->products;
        if ($products) {
            foreach ($products as $value) {
                $product = Product::find($value);
                $product->sale_id = $sale->id;
                $product->save();
            }
        }
        return redirect()->route('sale.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $saleTypes = SaleType::all();
        $categories = Category::getAllCategoryChild();
        $products = Product::all();
        $sale = Sale::find($id);
        return view('admin.sale.edit', compact('sale', 'saleTypes', 'categories', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (empty($request->name) || empty($request->sale_type_id) || empty($request->value) || empty($request->date_start) || empty($request->date_end)) {
            return back()->withInput()->with('error', 'Vui lòng điền đầy đủ thông tin');
        }
        $data = [
            'name' => $request->name,
            'sale_type_id' => $request->sale_type_id,
            'value' => $request->value,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'status'    => 0
        ];
        Sale::where('id', $id)->update($data);
        $products = $request->products;
        if ($products) {
            foreach ($products as $value) {
                $product = Product::find($value);
                $product->sale_id = $id;
                $product->save();
            }
        }

        return redirect()->route('sale.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->delete();
        $products = Product::where('sale_id', $id)->update(['sale_id' => null]);
        return redirect()->back()->withSuccess('Xóa thành công');
    }
}
