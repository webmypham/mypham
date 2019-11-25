<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use DateTime;
use Faker\Provider\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchData = $request->all();
        $comments = Comment::getComment($searchData);
        return view('admin.comment.index', compact('comments', 'searchData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $users = User::where('id_role', 2)->get();
        return view('admin.comment.create', compact('products', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (empty($request->id_product) || empty($request->user_name) || empty($request->content)) {
            return back()->withInput()->with('error', 'Vui lòng điền đầy đủ thông tin');
        }
        $newComment = [
            'id_product' => $request->id_product,
            'user_name' => $request->user_name,
            'content' => $request->content
        ];
        Comment::create($newComment);
        return redirect()->route('comments.index')->with('success','Thêm mới bình luận thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::find($id);
        return view('admin.comment.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        $products = Product::all();
        $users = User::where('id_role', 2)->get();
        return view('admin.comment.edit', compact('comment', 'products', 'users'));
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
        if (empty($request->reply)) {
            return back()->withInput()->with('error', 'Vui lòng điền đầy đủ thông tin');
        }
        $comment = [
            'reply' => $request->reply,
        ];
        Comment::where('id', $id)->update($comment);
        return redirect()->route('comments.index')->with('success','Trả lời bình luận thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::where('id', $id)->delete();
        if ($comment) {
            return redirect()->back()->withSuccess( 'Xóa bình luận thành công' );
        } else {
            return redirect()->back()->withErrors( 'Xóa bình luận thất bại' );
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
