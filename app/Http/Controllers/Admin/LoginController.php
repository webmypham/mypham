<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
// use App\Http\Models\User;

class LoginController extends Controller
{

		public function getLogin(){
			if(!Auth::check()){
				return view('admin.auth.login');
			}
			else{
				return redirect()->route('products.index');
			}
		}

		public function postLogin(Request $request){
			$login = [
				'email'=>$request->email,
				'password'=>$request->password
			];

            $user = User::where('email', $request->email)->first();
            if ($user) {
                if ($user->id_role != 0 && $user->id_role != 1) {
                    return back()->withInput()->with('error', 'Tài khoản không không có quyền truy cập');
                }
            }
			if(Auth::attempt($login)){
				return redirect()->route('products.index');
			}
			else{
                return back()->withInput()->with('error', 'Tài khoản hoặc mật khẩu không chính xác');
			}
		}

		public function getLogout()
		{
			Auth::logout();
			return redirect()->route('getLogin');
		}
}
