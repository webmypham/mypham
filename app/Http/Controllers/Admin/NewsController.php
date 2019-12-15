<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use DateTime;
use Faker\Provider\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchData = $request->all();
        $news = News::getNews($searchData);
        return view('admin.news.index', compact('news', 'searchData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.news.create', compact('categories'));
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
        if (empty($request->title) || empty($request->description) || empty($request->content)) {
            return back()->withInput()->with('error', 'Vui lòng điền đầy đủ thông tin');
        }
        if (!$file) {
            return back()->withInput()->with('error', 'Vui lòng chọn ảnh');
        }
        $newProduct = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content
        ];

        $image = null;
        if ($file) {
            $size = $file->getSize() / 1048576;
            if ($size > 5) {
                return back()->withInput()->with('error', 'File không được lớn hơn 5MB');
            }
            $image = $file->store('uploads/product');
        }
        $newProduct['thumbnail'] = $image;
        News::create($newProduct);
        return redirect()->route('news.index')->with('success','Thêm mới tin tức thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        return view('admin.news.edit', compact('news'));
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
        if (empty($request->title) || empty($request->description) || empty($request->content)) {
            return back()->withInput()->with('error', 'Vui lòng điền đầy đủ thông tin');
        }
        $news = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
        ];
        $file = $request->file('thumbnail');
        $image = null;
        if ($file) {
            $size = $file->getSize() / 1048576;
            if ($size > 5) {
                return back()->withInput()->with('error', 'File không được lớn hơn 5MB');
            }
            $image = $file->store('uploads/product');
            // Storage
            $oldImage = News::find($id)->thumbnail;
            if (file_exists('upload/'.$oldImage)) {
                File::delete('upload/'.$oldImage);
            }
            $news['thumbnail'] = $image;
        }
        News::where('id', $id)->update($news);
        return redirect()->route('news.index')->with('success','Cập nhật sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oldImage = News::find($id)->thumbnail;
        $result = News::where('id', $id)->delete();
        if ($result) {
            if (file_exists('upload/'.$oldImage)) {
                File::delete('upload/'.$oldImage);
            }
            return redirect()->back()->withSuccess( 'Xóa tin tức thành công' );
        } else {
            return redirect()->back()->withErrors( 'Xóa tin tức thất bại' );
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
