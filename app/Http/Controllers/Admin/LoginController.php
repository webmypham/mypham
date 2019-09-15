<?php

namespace App\Http\Controllers\admin;

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

			if(Auth::attempt($login)){
				return redirect()->route('products.index');
			}
			else{
				return redirect()->back();
			}
		}

		public function getLogout()
		{
			Auth::logout();
			return redirect()->route('getLogin');
		}
}
