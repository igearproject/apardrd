<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use File;

class pegawaiController extends Controller
{
    //fungsi untuk melihat data pegawai
    public function index(){
    	$pegawai=DB::table('pegawai')
    	->select('pegawai.*','opd.id_opd','opd.nama_opd')
    	->join('opd','pegawai.id_opd','=','opd.id_opd')
    	->get();
    	$opd=DB::table('opd')->get();
    	return view('dashboard.pegawai.pegawai',['datapegawai'=>$pegawai])->with('daftaropd',$opd);
    }
    public function tambah(Request $request){
    	//validasi data request
    	$this->validate($request,[
    		'foto'=>'file|image|mimes:jpeg,png,gif,jpg,webp|max:2048',
            'nip'=>'required|numeric',
            'no_hp'=>'required|numeric',
    	]);

    	//dd($request->all());
    	$waktu_sekarang=date('Y-m-d H:i:s');
    	$waktu_sekarang_name=date('Y_m_d His');
    	if($request->hasFile('foto')){
    		$request->file('foto')->move('foto/',$waktu_sekarang_name.' '.$request->file('foto')->getClientOriginalName());
    		$nama_foto=$waktu_sekarang_name.' '.$request->file('foto')->getClientOriginalName();
    	}else{
    		$nama_foto='default.png';
    	}
    	$perintah=DB::table('pegawai')->insert([
    		'id_pegawai'=>null,
    		'nama'=>$request->nama,
            'nip'=>$request->nip,
			'jabatan'=>$request->jabatan,
			'jenis_kelamin'=>$request->jenis_kelamin,
			'no_hp'=>$request->no_hp,
			'email'=>$request->email,
			'agama'=>$request->agama,
			'tanggal_lahir'=>$request->tanggal_lahir,
			'foto'=>$nama_foto,
			'alamat'=>$request->alamat,
            'status_pegawai'=>$request->status_pegawai,
			'id_opd'=>$request->id_opd,
			'created_at'=>$waktu_sekarang,
			'updated_at'=>$waktu_sekarang
		]);
		if($perintah){
			return redirect()->action('pegawaiController@index')->with('success','Data Pegawai '.$request->nama.' Berhasil di Inputkan !');
		}else{
			return redirect()->action('pegawaiController@index')->with('danger','Data Pegawai '.$request->nama.' Gagal di Inputkan !');
		}
    }
    public function hapus(Request $request){
    	$id=Input::get('id');
    	$perintah=DB::table('pegawai')->where('id_pegawai',$id)->delete();
    	if($perintah){
    		File::delete('foto/'.$request->foto);
    		return redirect()->action('pegawaiController@index')->with('success','Data Pegawai '.$request->nama_pegawai.' Berhasil Dihapus !');
    	}else{
    		return redirect()->action('pegawaiController@index')->with('danger','Data Pegawai '.$request->nama_pegawai.' Gagal Dihapus !');
    	}
    	
    }
    public function show($id){
    	$pegawai=DB::table('pegawai')
    	->where('id_pegawai',$id)
    	->get();
    	$opd=DB::table('opd')->get();
    	return view('dashboard.pegawai.editpegawai',['datapegawai'=>$pegawai])->with('daftaropd',$opd);
    }
    public function edit(Request $request,$id){
    	$this->validate($request,[
    		'foto'=>'file|image|mimes:jpeg,png,gif,jpg,webp|max:2048',
            'nip'=>'required|numeric',
            'no_hp'=>'required|numeric',
    	]);
    	$waktu_sekarang=date('Y-m-d H:i:s');
    	$waktu_sekarang_name=date('Y_m_d_His');
    	if($request->hasFile('foto')){
    		$request->file('foto')->move('foto/',$waktu_sekarang_name.' '.$request->file('foto')->getClientOriginalName());
    		$nama_foto=$waktu_sekarang_name.' '.$request->file('foto')->getClientOriginalName();

    	}else{
    		$nama_foto=$request->foto1;
    	}
    	$perintah=DB::table('pegawai')
    	->where('id_pegawai',$id)
    	->update([
    		'nama'=>$request->nama,
            'nip'=>$request->nip,
			'jabatan'=>$request->jabatan,
			'jenis_kelamin'=>$request->jenis_kelamin,
			'no_hp'=>$request->no_hp,
			'email'=>$request->email,
			'agama'=>$request->agama,
			'tanggal_lahir'=>$request->tanggal_lahir,
			'foto'=>$nama_foto,
			'alamat'=>$request->alamat,
            'status_pegawai'=>$request->status_pegawai,
			'id_opd'=>$request->id_opd,
			'updated_at'=>$waktu_sekarang
    	]);
    	if($perintah){
    		if($request->foto1!='default.png'&&$request->hasFile('foto')){
    			File::delete('foto/'.$request->foto1);
    		}
			return redirect()->action('pegawaiController@index')->with('success','Data Pegawai '.$request->nama.' Berhasil di Edit !');
		}else{
			return redirect()->action('pegawaiController@index')->with('danger','Data Pegawai '.$request->nama.' Gagal di Edit !');
		}
    }

}
