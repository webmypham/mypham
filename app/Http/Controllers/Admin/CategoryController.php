<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchData = $request->all();
        $categories = Category::getCategories($searchData);
        $categoriesParent = Category::getParent();
        return  view('admin.category.index', compact('categories', 'searchData','categoriesParent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoriesParent = Category::getParent();
        return view('admin.category.create', compact('categoriesParent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newCategory = [
            'name' => $request->name,
            'is_parent' => 1
        ];
        if($request->id_parent){
            $newCategory['id_parent'] = $request->id_parent;
            $newCategory['is_parent'] = 0;
        }
        Category::create($newCategory);
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::getCategory($id);
        $categoriesParent = Category::getParent();
        return view('admin.category.show', compact('category', 'categoriesParent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $categoriesParent = Category::getParent();
        return view('admin.category.edit', compact('category', 'categoriesParent'));
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
        $newCategory = [
            'name' => $request->name,
            'is_parent' => 1
        ];
        if($request->id_parent){
            $newCategory['id_parent'] = $request->id_parent;
            $newCategory['is_parent'] = 0;
        }
        Category::where('id', $id)->update($newCategory);
        return redirect()->route('categories.index');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::where('id', $id);
        if (!$category) {
            return redirect()->back()->withErrors( 'Danh mục không tồn tại');
        }
        $category->delete();
        return redirect()->back()->withSuccess('Xóa danh mục thành công');
    }
}
