<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use DateTime;
use Faker\Provider\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchData = $request->all();
        $categories = Category::all();
        $products = Product::getProducts($searchData);
        return view('admin.product.index', compact('products', 'categories', 'searchData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $sales = Sale::whereDate('sale.date_start', '<=', Carbon::now()->format('Y-m-d'))
            ->whereDate('sale.date_end', '>=', Carbon::now()->format('Y-m-d'))->get();
        return view('admin.product.create', compact('categories', 'sales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('image');
        if (empty($request->sku) || empty($request->name) || empty($request->id_category) || empty($request->description) || empty($request->detail)) {
            return back()->withInput()->with('error', 'Vui lòng điền đầy đủ thông tin');
        }
        if (!$file) {
            return back()->withInput()->with('error', 'Vui lòng chọn ảnh sản phẩm');
        }
        $newProduct = [
            'sku' => $request->sku,
            'name' => $request->name,
            'id_category' => $request->id_category,
            'description' => $request->description,
            'quantity' => 0,
            'price' => $request->price,
            'detail' => $request->detail,
            'sale_id' => $request->sale_id,
        ];

        $image = null;
        if ($file) {
            $image = $file->store('uploads/product');
        }
        $newProduct['image'] = $image;
        Product::create($newProduct);

        return redirect()->route('products.index')->with('success','Thêm mới sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $sales = Sale::all();
        return view('admin.product.show', compact('product', 'categories', 'sales'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $sales = Sale::whereDate('sale.date_start', '<=', Carbon::now()->format('Y-m-d'))
            ->whereDate('sale.date_end', '>=', Carbon::now()->format('Y-m-d'))->get();
        return view('admin.product.edit', compact('product', 'categories', 'sales'));
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
        if (empty($request->name) || empty($request->id_category) || empty($request->description) || empty($request->detail)) {
            return back()->withInput()->with('error', 'Vui lòng điền đầy đủ thông tin');
        }
        $newProduct = [
            'name' => $request->name,
            'id_category' => $request->id_category,
            'description' => $request->description,
            'price' => $request->price,
            'detail' => $request->detail,
            'sale_id' => $request->sale_id,
            'cost' => $request->cost
        ];
        $file = $request->file('image');
        $image = null;
        if ($file) {
            $image = $file->store('uploads/product');
            // Storage
            $oldImage = Product::find($id)->image;
            if (file_exists('upload/'.$oldImage)) {
                File::delete('upload/'.$oldImage);
            }
            $newProduct['image'] = $image;
        }
        Product::where('id', $id)->update($newProduct);
        return redirect()->route('products.index')->with('success','Cập nhật sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oldImage = Product::find($id)->image;
        $result = Product::where('id', $id)->delete();
        if ($result) {
            if (file_exists('upload/'.$oldImage)) {
                File::delete('upload/'.$oldImage);
            }
            return redirect()->back()->withSuccess( 'Xóa sản phẩm thành công' );
        } else {
            return redirect()->back()->withErrors( 'Xóa sản phẩm thất bại' );
        }
    }

    /**
     * Change file name
     * 
     * @param $fileName
     * @return $newFileName
     */
    public function renameFile($fileName) {
        $date = new DateTime();
        return $date->getTimestamp().'_'.$fileName;
    }
}
