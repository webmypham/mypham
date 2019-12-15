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
use App\Models\Slide;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $slides = Slide::all();
        return view('admin.slide.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slide.create', compact('categories', 'products'));
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
        if (empty($request->name) || empty($request->order) || !$file) {
            return back()->withInput()->with('error', 'Vui lòng điền đầy đủ thông tin');
        }
        $newSlide = [
            'name' => $request->name,
            'order' => $request->order,
        ];

        $image = null;
        if ($file) {
            $size = $file->getSize() / 1048576;
            if ($size > 5) {
                return back()->withInput()->with('error', 'File không được lớn hơn 5MB');
            }
            $image = $file->store('uploads/slides');
        }
        $newSlide['image'] = $image;
        Slide::create($newSlide);


        return redirect()->route('slides.index')->with('success','Tạo slide');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slide = Slide::find($id);
        return view('admin.slide.show', compact('slide'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slide = Slide::find($id);
        return view('admin.slide.edit', compact('slide'));
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
        $file = $request->file('image');
        if (empty($request->name) || empty($request->order)) {
            return back()->withInput()->with('error', 'Vui lòng điền đầy đủ thông tin');
        }
        $newSlide = [
            'name' => $request->name,
            'order' => $request->order,
        ];
        $image = null;
        if ($file) {
            $size = $file->getSize() / 1048576;
            if ($size > 5) {
                return back()->withInput()->with('error', 'File không được lớn hơn 5MB');
            }
            $image = $file->store('uploads/slides');
            // Storage
            $oldImage = Slide::find($id)->image;
            if (file_exists('upload/'.$oldImage)) {
                File::delete('upload/'.$oldImage);
            }
            $newSlide['image'] = $image;
        }
        Slide::where('id', $id)->update($newSlide);
        return redirect()->route('slides.index')->with('success','Cập nhật phiếu thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Slide::where('id', $id)->delete();
        if ($result) {
            return redirect()->back()->withSuccess( 'Xóa slide thành công' );
        } else {
            return redirect()->back()->withErrors( 'Xóa slide thất bại' );
        }
    }
}
