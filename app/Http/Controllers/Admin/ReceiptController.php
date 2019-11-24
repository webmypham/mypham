<?php

namespace App\Http\Controllers\Admin;

use App\Models\Receipt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use DateTime;
use Faker\Provider\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchData = $request->all();
        $receipts = Receipt::getReceipt($searchData);
        $products = Product::all();
        return view('admin.receipt.index', compact('receipts', 'searchData', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('admin.receipt.create', compact('categories', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (empty($request->type) || empty($request->product_id) || empty($request->quantity) || empty($request->total_amount) || empty($request->supplier)) {
            return back()->withInput()->with('error', 'Vui lòng điền đầy đủ thông tin');
        }
        $newProduct = [
            'type' => $request->type,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'user_id' => Auth::user()->id,
            'supplier' => $request->supplier,
            'total_amount' => $request->total_amount
        ];

        Receipt::create($newProduct);
        $product = Product::find($request->product_id);
        $oldQuantity = $product->quantity;
        if ($request->type == 'in') {
            $newQuantity = $oldQuantity + $request->quantity;
        } else {
            $newQuantity = $oldQuantity - $request->quantity;
        }
        if ($newQuantity < 0) {
            $newQuantity = 0;
        }


        $input_price = strval($request->input_price);
        $price = strval($request->input_price) + (strval($request->input_price) * 10 / 100);
        $product->update(['quantity' => $newQuantity, 'input_price' => $input_price, 'price' => $price, 'status' => 1]);
        return redirect()->route('receipts.index')->with('success','Tạo phiếu thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $receipt = Receipt::find($id);
        return view('admin.receipt.show', compact('receipt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $receipt = Receipt::find($id);
        $products = Product::all();
        return view('admin.receipt.edit', compact('receipt', 'products'));
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
        if (empty($request->type) || empty($request->product_id) || empty($request->quantity) || empty($request->total_amount) || empty($request->supplier)) {
            return back()->withInput()->with('error', 'Vui lòng điền đầy đủ thông tin');
        }
        $newReceipt = [
            'type' => $request->type,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'user_id' => Auth::user()->id,
            'supplier' => $request->supplier,
            'total_amount' => $request->total_amount
        ];
        $receipt = Receipt::find($id);

        $product = Product::find($receipt->product_id);
        $oldQuantity = $product->quantity;
        $oldType = $receipt->type;

        if ($oldType == 'in') {
            $newQuantity = $oldQuantity - $receipt->quantity;
        } else {
            $newQuantity = $oldQuantity + $receipt->quantity;
        }

        if ($request->type == 'in') {
            $newQuantity = $newQuantity + $request->quantity;
        } else {
            $newQuantity = $newQuantity - $request->quantity;
        }

        $receipt->update($newReceipt);
        $input_price = strval($request->input_price);
        $price = strval($request->input_price) + (strval($request->input_price) * 10 / 100);
        $product->update(['quantity' => $newQuantity, 'input_price' => $input_price, 'price' => $price, 'status' => 1]);
        return redirect()->route('receipts.index')->with('success','Cập nhật phiếu thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Receipt::where('id', $id);

        $product = Product::find($result->product_id);
        $oldQuantity = $product->quantity;
        if ($result->type == 'in') {
            $newQuantity = $oldQuantity - $result->quantity;
        } else {
            $newQuantity = $oldQuantity + $result->quantity;
        }

        if ($newQuantity < 0) {
            $newQuantity = 0;
        }

        $result->delete();
        $product->update(['quantity' => $newQuantity]);

        if ($result) {
            return redirect()->back()->withSuccess( 'Xóa phiếu thành công' );
        } else {
            return redirect()->back()->withErrors( 'Xóa phiếu thất bại' );
        }
    }
}
