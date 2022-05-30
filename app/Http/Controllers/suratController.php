<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use File;
use Response;

class suratController extends Controller
{
    public function index(){
    	$surat=DB::table('surat')
    	->join('rapat','surat.id_rapat','=','rapat.id_rapat')
    	->get();
    	$rapat=DB::table('rapat')
    	->orderBy('tanggal','desc')
    	->get();
    	return view('dashboard.surat.surat',['datasurat'=>$surat])->with('daftarrapat',$rapat);
    }
    public function tambah(Request $request){
    	//validasi data request
    	$this->validate($request,[
    		'file'=>'required|mimes:pdf|max:2048',
    	]);
    	$waktu_sekarang=date('Y-m-d H:i:s');
    	$waktu_sekarang_name=date('Y_m_d_His');
    	$nama_file=$waktu_sekarang_name.' '.$request->file('file')->getClientOriginalName();
    	$perintah=DB::table('surat')->insert([
    		'id_surat'=>null,
    		'no_surat'=>$request->no_surat,
    		'tanggal_pembuatan'=>$request->tanggal_pembuatan,
    		'tempat_pembuatan'=>$request->tempat_pembuatan,
    		'perihal'=>$request->perihal,
    		'file'=>$nama_file,
    		'id_rapat'=>$request->id_rapat,
			'created_at'=>$waktu_sekarang,
			'updated_at'=>$waktu_sekarang
    	]);
    	if($perintah){
    		$upload_file_surat=$request->file('file')
    		->move('fileSurat/',$waktu_sekarang_name.' '.$request->file('file')->getClientOriginalName());
    		if ($upload_file_surat) {
    			return redirect()->action('suratController@index')->with('success','Data Surat dengan No Surat '.$request->no_surat.' Berhasil di Inputkan !');
    		}else{
    			return redirect()->action('suratController@index')->with('danger','Data Surat dengan No Surat '.$request->no_surat.' Berhasil di Inputkan tapi file Gagal di Upload !');
    		}
			
		}else{
			return redirect()->action('suratController@index')->with('danger','Data Surat dengan No Surat '.$request->no_surat.' Gagal di Inputkan !');
		}
    }
    public function hapus(Request $request){
    	$perintah=DB::table('surat')->where('id_surat',Input::get('id'))->delete();
    	if($perintah){
    		$delete_file_surat=File::delete('fileSurat/'.$request->filesurat);
    		if ($delete_file_surat) {
    			return redirect()->action('suratController@index')->with('success','Data Surat dengan No Surat '.$request->no_surat.' Berhasil di Delete !');
    		}else{
    			return redirect()->action('suratController@index')->with('danger','Data Surat dengan No Surat '.$request->no_surat.' Berhasil di Delete tapi file Gagal di Delete !');
    		}
			
		}else{
			return redirect()->action('suratController@index')->with('danger','Data Surat dengan No Surat '.$request->no_surat.' Gagal di Delete !');
		}
    }
    public function showpdf($name){
    	$namafile='fileSurat/'.$name;
    	return Response::make(file_get_contents($namafile),200,[
    		'Content-Type' => 'application/pdf',
    		'Content-Dispotition' => 'inline, filename="'.$namafile.'"'
    	]);
    	//skrip di bawah juga bisa untuk menampilkan pdf
    	// $file=File::get('fileSurat/'.$name);
    	// $response=Response::make($file,200);
    	// $response->header('Content-Type','application/pdf');
    	// return $response;


    }
    public function show($id){
    	$surat=DB::table('surat')
    	->join('rapat','surat.id_rapat','=','rapat.id_rapat')
    	->where('id_surat',$id)
    	->get();
    	$rapat=DB::table('rapat')
    	->orderBy('tanggal','desc')
    	->get();
    	return view('dashboard.surat.editsurat',['datasurat'=>$surat])->with('daftarrapat',$rapat);
    }
    public function edit(Request $request,$id){
    	$this->validate($request,[
    		'file'=>'mimes:pdf|max:2048',
    	]);
    	$waktu_sekarang=date('Y-m-d H:i:s');
    	$waktu_sekarang_name=date('Y_m_d_His');
    	if ($request->hasFile('file')) {
    		$nama_file=$waktu_sekarang_name.' '.$request->file('file')->getClientOriginalName();
    	}else{
    		$nama_file=$request->file1;
    	}
    	
    	$perintah=DB::table('surat')->where('id_surat',$id)->update([
    		'no_surat'=>$request->no_surat,
    		'tanggal_pembuatan'=>$request->tanggal_pembuatan,
    		'tempat_pembuatan'=>$request->tempat_pembuatan,
    		'perihal'=>$request->perihal,
    		'file'=>$nama_file,
			'updated_at'=>$waktu_sekarang
    	]);
    	if($perintah){
    		if ($request->hasFile('file')) {
    			$upload_file_surat=$request->file('file')
	    		->move('fileSurat/',$waktu_sekarang_name.' '.$request->file('file')->getClientOriginalName());
	    		File::delete('fileSurat/'.$request->file1);
	    		if ($upload_file_surat) {
	    			return redirect()->action('suratController@index')->with('success','Data Surat dengan No Surat '.$request->no_surat.' Berhasil di Edit !');
	    		}else{
	    			return redirect()->action('suratController@index')->with('danger','Data Surat dengan No Surat '.$request->no_surat.' Berhasil di Edit tapi file Gagal di Upload !');
	    		}
    			
    		}else{
    			return redirect()->action('suratController@index')->with('success','Data Surat dengan No Surat '.$request->no_surat.' Berhasil di Edit !');
    		}
    		
			
		}else{
			return redirect()->action('suratController@index')->with('danger','Data Surat dengan No Surat '.$request->no_surat.' Gagal di Edit !');
		}
    }
}
