<?php

namespace App\Http\Controllers\Admin;

use App\Models\Receipt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;

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
        $type = $request->type;
        $receipts = Receipt::getReceipt($searchData);
        $month = $request->month;
        $year = $request->year;
        $now = Carbon::now();
        if (empty($month)) {
            $month = $now->month;
        }
        if (empty($year)) {
            $year = $now->year;
        }

        $in = Receipt::where('type', 'in')->whereMonth('created_at', $month)->whereYear('created_at', $year);
        if (!empty($request->product_id)) {
           $in = $in->where('product_id', $request->product_id);
        }

        $out = Receipt::where('type', 'out')->whereMonth('created_at', $month)->whereYear('created_at', $year);
        if (!empty($request->product_id)) {
            $out = $out->where('product_id', $request->product_id);
        }

        $inQuantity = $in->sum('quantity');
        $outQuantity = $out->sum('quantity');
        $inAmount = $in->sum('total_amount');
        $outAmount = $out->sum('total_amount');

        $products = Product::all();
        return view('admin.receipt.index', compact('receipts', 'searchData', 'products', 'inQuantity', 'outQuantity', 'inAmount', 'outAmount', 'type', 'month', 'year'));
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

        $product = Product::find($request->product_id);
        $oldQuantity = $product->quantity;
        if ($request->type == 'out' && strval($request->quantity) > $oldQuantity) {
            return back()->withInput()->with('error', 'Số lương sản phẩm còn lại không đủ để xuất hàng');
        }

        Receipt::create($newProduct);
        if ($request->type == 'in') {
            $newQuantity = $oldQuantity + $request->quantity;
        } else {
            $newQuantity = $oldQuantity - $request->quantity;
        }

        if ($newQuantity < 0) {
            $newQuantity = 0;
            return back()->withInput()->with('error', 'Số lương sản phẩm còn lại không đủ để xuất hàng');
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
        if (Auth::user()->id_role != 0) {
            return redirect()->back();
        }
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
        if (empty($request->quantity) || empty($request->total_amount) || empty($request->supplier)) {
            return back()->withInput()->with('error', 'Vui lòng điền đầy đủ thông tin');
        }
        $newReceipt = [
            'quantity' => $request->quantity,
            'user_id' => Auth::user()->id,
            'supplier' => $request->supplier,
            'total_amount' => $request->total_amount
        ];


        $receipt = Receipt::find($id);
        $product = Product::find($receipt->product_id);
        if ($product) {
            $oldQuantity = $product->quantity;
            $oldType = $receipt->type;

            if ($oldType == 'in') {
                $newQuantity = $oldQuantity - $receipt->quantity;
            } else {
                $newQuantity = $oldQuantity + $receipt->quantity;
            }

            if ($receipt->type == 'out' && strval($request->quantity) > $newQuantity) {
                return back()->withInput()->with('error', 'Số lương sản phẩm còn lại không đủ để xuất hàng');
            }

            if ($request->type == 'in') {
                $newQuantity = $newQuantity + $request->quantity;
            } else {
                $newQuantity = $newQuantity - $request->quantity;

            }

            if ($newQuantity < 0) {
                return back()->withInput()->with('error', 'Số lương sản phẩm còn lại không đủ');
            }

            $input_price = strval($request->input_price);
            $price = strval($request->input_price) + (strval($request->input_price) * 10 / 100);
            $product->update(['quantity' => $newQuantity, 'input_price' => $input_price, 'price' => $price, 'status' => 1]);
        }


        $receipt->update($newReceipt);
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
        $result = Receipt::where('id', $id)->first();
        $product = Product::find($result->product_id);

        if ($product) {
            $oldQuantity = $product->quantity;
            if ($result->type == 'in') {
                $newQuantity = $oldQuantity - $result->quantity;
            } else {
                $newQuantity = $oldQuantity + $result->quantity;
            }

            if ($newQuantity < 0) {
                $newQuantity = 0;
            }
            $product->update(['quantity' => $newQuantity]);
        }
        $result->delete();
        if ($result) {
            return redirect()->back()->withSuccess( 'Xóa phiếu thành công' );
        } else {
            return redirect()->back()->withErrors( 'Xóa phiếu thất bại' );
        }
    }

    public function printReceipt(Request $request) {
        $id = $request->id;
        $receipt = Receipt::find($id);
        $templateProcessor = new TemplateProcessor(public_path('/template/template_receipt.docx'));
        $templateProcessor->setValue('title', $receipt->type == 'in' ? 'Phiếu nhập hàng': 'Phiếu xuất hàng');
        $templateProcessor->setValue('receipt_id', $receipt->id);
        $templateProcessor->setValue('created_by', $receipt->user->name ?? '');
        $templateProcessor->setValue('created_at', Carbon::parse($receipt->created_at)->format('d/m/Y'));
        $templateProcessor->setValue('product_name', $receipt->product->name ?? '');
        $templateProcessor->setValue('quantity', $receipt->quantity);
        $templateProcessor->setValue('price', number_format($receipt->product->input_price, 0));
        $templateProcessor->setValue('total_amount', number_format($receipt->total_amount, 0));
        $templateProcessor->setValue('supplier', $receipt->product->name ?? '');

        $templateProcessor->setImageValue('comLogo', public_path('/images/logo.png'));

        $fileName = 'receipt_' . $receipt->id . '_' . Auth::user()->id . '.docx';
        $templateProcessor->saveAs($fileName);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$fileName);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fileName));
        flush();
        readfile($fileName);
        unlink($fileName);
    }
}
