<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use File;
use Response;

class notulenController extends Controller
{
    //fungsi untuk menampilkan data notulen
    public function index(){
    	$notulen=DB::table('notulen')
    	->join('rapat','notulen.id_rapat','=','rapat.id_rapat')
    	->get();
    	$rapat=DB::table('rapat')
        ->whereIn('status',['pass','fix'])
    	->orderBy('tanggal','desc')
    	->get();
    	return view('dashboard.notulen.notulen',['datanotulen'=>$notulen])
    	->with('daftarrapat',$rapat);
    }
    //fungsi untuk menambahkan notulen rapat
    public function tambah(Request $request){
    	$this->validate($request,[
    		'file_notulen'=>'required|mimes:pdf|max:2048',
    	]);
    	$waktu_sekarang=date('Y-m-d H:i:s');
    	$waktu_sekarang_name=date('Y_m_d_His');
    	$namafile=$waktu_sekarang_name.' '.$request->file('file_notulen')->getClientOriginalName();
    	$perintah=DB::table('notulen')->insert([
			'id_notulen'=>null,
			'pimpinan'=>$request->pimpinan,
			'pembuat'=>$request->pembuat,
			'kesimpulan'=>$request->kesimpulan,
			'file_notulen'=>$namafile,
			'id_rapat'=>$request->id_rapat,
			'created_at'=>$waktu_sekarang,
			'updated_at'=>$waktu_sekarang
    	]);
    	if($perintah){
    		$upload_file_surat=$request->file('file_notulen')
    			->move('fileNotulen/',$waktu_sekarang_name.' '.$request
    			->file('file_notulen')->getClientOriginalName());
    		if ($upload_file_surat) {
    			return redirect()->action('notulenController@index')->with('success','Notulen Rapat Yang Di Buat Oleh '.$request->pembuat.' Berhasil di Inputkan !');
    		}else{
    			return redirect()->action('notulenController@index')->with('danger','Notulen Rapat Yang Di Buat Oleh '.$request->pembuat.' Berhasil di Inputkan tapi file Gagal di Upload !');
    		}
		}else{
			return redirect()->action('notulenController@index')->with('danger','Notulen Rapat Yang Di Buat Oleh '.$request->pembuat.' Gagal di Inputkan !');
		}
    }
    //fungsi untuk menghapus data notulen
    public function hapus(Request $request){
    	$perintah=DB::table('notulen')->where('id_notulen',Input::get('id'))->delete();
    	if($perintah){
    		$delete_file_surat=File::delete('fileNotulen/'.$request->filenotulen);
    		if ($delete_file_surat) {
    			return redirect()->action('notulenController@index')->with('success','Notulen rapat dengan nama file '.$request->filenotulen.' yang dibuat oleh '.$request->pembuat.' Berhasil di Delete !');
    		}else{
    			return redirect()->action('notulenController@index')->with('danger','Notulen rapat dengan nama file '.$request->filenotulen.' yang dibuat oleh '.$request->pembuat.' Berhasil di Delete tapi file Gagal di Delete !');
    		}
			
		}else{
			return redirect()->action('notulenController@index')->with('danger','Notulen rapat dengan nama file '.$request->filenotulen.' yang dibuat oleh '.$request->pembuat.' Gagal di Delete !');
		}
    }
    //fungsi untuk menampilkan file pdf notulen
    public function showpdf($name){
    	$namafile='fileNotulen/'.$name;
    	return Response::make(file_get_contents($namafile),200,[
    		'Content-Type' => 'application/pdf',
    		'Content-Dispotition' => 'inline, filename="'.$namafile.'"'
    	]);
    }
    //fungsi untuk menampikan data untuk di edit
    public function show($id){
    	$notulen=DB::table('notulen')
        ->whereIn('status',['pass','fix'])
    	->where('id_notulen',$id)
    	->join('rapat','notulen.id_rapat','=','rapat.id_rapat')
    	->get();
    	$rapat=DB::table('rapat')
    	->orderBy('tanggal','desc')
    	->get();
    	return view('dashboard.notulen.editnotulen',['datanotulen'=>$notulen])
    	->with('daftarrapat',$rapat);
    }
    //fungsi untuk edit data notulen
    public function edit(Request $request,$id){
    	$this->validate($request,[
    		'file_notulen'=>'mimes:pdf|max:2048',
    	]);
    	$waktu_sekarang=date('Y-m-d H:i:s');
    	$waktu_sekarang_name=date('Y_m_d_His');
    	if ($request->hasFile('file_notulen')) {
    		$namafile=$waktu_sekarang_name.' '.$request->file('file_notulen')->getClientOriginalName();
    	}else{
    		$namafile=$request->file_notulen1;
    	}
    	$perintah=DB::table('notulen')->where('id_notulen',$id)->update([
			'pimpinan'=>$request->pimpinan,
			'pembuat'=>$request->pembuat,
			'kesimpulan'=>$request->kesimpulan,
			'file_notulen'=>$namafile,
			'id_rapat'=>$request->id_rapat,
			'updated_at'=>$waktu_sekarang
    	]);
    	if($perintah){
    		if ($request->hasFile('file_notulen')) {
    			$upload_file_surat=$request->file('file_notulen')
    			->move('fileNotulen/',$waktu_sekarang_name.' '.$request
    			->file('file_notulen')->getClientOriginalName());
    			File::delete('fileNotulen/'.$request->file_notulen1);
    			if ($upload_file_surat) {
	    			return redirect()->action('notulenController@index')->with('success','Notulen Rapat dengan nama file '.$namafile.' yang di buat oleh '.$request->pembuat.' Berhasil di Update !');
	    		}else{
	    			return redirect()->action('notulenController@index')->with('danger','Notulen Rapat dengan nama file '.$namafile.' yang di buat oleh '.$request->pembuat.' Berhasil di Update tapi file Gagal di Upload !');
	    		}
    		}else{
    			return redirect()->action('notulenController@index')->with('success','Notulen Rapat dengan nama file '.$namafile.' yang di buat oleh '.$request->pembuat.' Berhasil di Update !');
    		}
    		
    		
		}else{
			return redirect()->action('notulenController@index')->with('danger','Notulen Rapat dengan nama file '.$namafile.' yang di buat oleh '.$request->pembuat.' Gagal di Inputkan !');
		}
    }
}
