<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use DateTime;
use Faker\Provider\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchData = $request->all();
        $users = User::getUsers($searchData);
        return view('admin.users.index', compact('users', 'searchData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('admin.users.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (empty($request->email) || empty($request->password) || empty($request->name) || empty($request->phone) || empty($request->address)) {
            return back()->withInput()->with('error', 'Vui lòng điền đầy đủ thông tin');
        }
        $newUser = [
            'email' => $request->email,
            'password' => $request->password,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'id_role' => $request->role
        ];

        User::create($newUser);
        return redirect()->route('users.index')->with('success','Thêm khách hàng thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $userAdmin = Auth::user();
        return view('admin.users.edit', compact('user', 'userAdmin'));
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
        if (empty($request->email) || empty($request->password) || empty($request->name) || empty($request->phone) || empty($request->address)) {
            return back()->withInput()->with('error', 'Vui lòng điền đầy đủ thông tin');
        }
        $user = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address
        ];
        User::where('id', $id)->update($user);
        return redirect()->route('users.index')->with('success','Cập nhật thông tin khách hàng thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();
        if ($user) {
            return redirect()->back()->withSuccess( 'Xóa khách hàng thành công' );
        } else {
            return redirect()->back()->withErrors( 'Xóa khách hàng thất bại' );
        }
    }
}
