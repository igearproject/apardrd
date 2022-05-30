<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class authuserController extends Controller
{
    //menampilkan form login
    public function index(){
    	return view('login');
    }
    //fungsi untuk login ke sistem
    public function login(Request $request){
    	if (Auth::attempt($request->only('email','password'))) {
    		return redirect('/dashboard');
    	}else{
    		return redirect('/login')->with('danger','Email atau password salah');
    	}
    }
    public function logout(){
    	Auth::logout();
    	return redirect('/login');
    }
}
