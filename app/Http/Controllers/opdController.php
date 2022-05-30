<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class opdController extends Controller
{
	
    public function all(Request $request){
    	$opd=DB::table('opd')->get();
    	return view('dashboard/opd/opd',['dataopd'=>$opd]);

    }
    public function show($id){
    	$dataopdm=DB::table('opd')->where('id_opd',$id)->get();
    	return view('dashboard/opd/editopd',['dataopdedit'=>$dataopdm]);
    
    }
    
    public function hapus(){
    	$id=Input::get('id');
    	$perintah=DB::table('opd')->where('id_opd',$id)->delete();
    	if($perintah){
    		return redirect()->action('opdController@all')->with("success","Data OPD ".Input::get('nama_opd')." Berhasil di Hapus !");
    	}else{
    		return redirect()->action('opdController@all')->with("danger","Data OPD ".Input::get('nama_opd')." Gagal di Hapus !");
    	}
    	
    	
    }
    public function tambah(Request $request){
    	$waktu_sekarang=date('Y-m-d H:i:s');
		$perintah=DB::table('opd')->insert([
			'id_opd'=>null,
			'nama_opd'=>$request->nama_opd,
			'alamat'=>$request->alamat,
			'email'=>$request->email,
			'website'=>$request->website,
			'deskripsi'=>$request->deskripsi,
			'created_at'=>$waktu_sekarang,
			'updated_at'=>$waktu_sekarang
		]);
		if($perintah){
    		return redirect()->action('opdController@all')->with("success","Data OPD ".$request->nama_opd." Berhasil di Inputkan !");  	
    	}else{
    		return redirect()->action('opdController@all')->with("danger","Data OPD ".$request->nama_opd." Gagal di Inputkan !");
    	}		
		
		
		
    }
    public function edit(Request $request){
    	$waktu_sekarang=date('Y-m-d H:i:s');
		$perintah=DB::table('opd')->where('id_opd',$request->id_opd)->update([
			'nama_opd'=>$request->nama_opd,
			'alamat'=>$request->alamat,
			'email'=>$request->email,
			'website'=>$request->website,
			'deskripsi'=>$request->deskripsi,
			'updated_at'=>$waktu_sekarang
		]);
		if($perintah){
    		return redirect('/dashboard/opd')->with("success","Data OPD ".$request->nama_opd." Berhasil di Ubah !");  	
    	}else{
    		return redirect('/dashboard/opd')->with("danger","Data OPD ".$request->nama_opd." Gagal di Ubah !");
    	}	
		
		
    }
    
}
