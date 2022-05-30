<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use File;
class dokumentasiController extends Controller
{
    //fungsi untuk melihat data pada tabel dokumentasi
    public function index(){
    	$dokumentasi=DB::table('dokumentasi')
    	->join('rapat','dokumentasi.id_rapat','=','rapat.id_rapat')
    	->orderBy('dokumentasi.id_rapat','asc')
    	->get();
    	$rapat=DB::table('rapat')->whereIn('status',['pass','fix'])->orderBy('tanggal','desc')->get();
    	return view('dashboard.dokumentasi.dokumentasi',['datadokumentasi'=>$dokumentasi])
    	->with('daftarrapat',$rapat);
    }
    //fungsi untuk menambahkan data dokumentasi
    public function tambah(Request $request){
    	$this->validate($request,[
    		'gambar'=>'required|file|image|mimes:jpeg,png,gif,jpg,webp|max:2048',
    	]);
    	$waktu_sekarang=date('Y-m-d H:i:s');
    	$waktu_sekarang_name=date('Y_m_d_His');
    	$namafile=$waktu_sekarang_name.' '.$request->file('gambar')->getClientOriginalName();
    	$perintah=DB::table('dokumentasi')->insert([
    		'id_dokumentasi'=>null,
			'nama'=>$namafile,
			'id_rapat'=>$request->id_rapat,
			'created_at'=>$waktu_sekarang,
			'updated_at'=>$waktu_sekarang
    	]);
    	if($perintah){
    		$upload_file_dokumentasi=$request->file('gambar')
    			->move('fotoDokumentasi/',$waktu_sekarang_name.' '.$request
    			->file('gambar')->getClientOriginalName());
    		if ($upload_file_dokumentasi) {
    			return redirect()->action('dokumentasiController@index')->with('success','Data Dokumentasi Berhasil di Inputkan !');
    		}else{
    			return redirect()->action('dokumentasiController@index')->with('danger','Data Dokumentasi Berhasil di Inputkan tapi file Gagal di Upload !');
    		}
		}else{
			return redirect()->action('dokumentasiController@index')->with('danger','Data Dokumentasi Gagal di Inputkan !');
		}
    }
    //fungsi untuk menghapus data dokumentasi
    public function hapus(Request $request){
    	$perintah=DB::table('dokumentasi')->where('id_dokumentasi',Input::get('id'))->delete();
    	if($perintah){
    		$delete_file_surat=File::delete('fotoDokumentasi/'.$request->nama);
    		if ($delete_file_surat) {
    			return redirect()->action('dokumentasiController@index')->with('success','Data Dokumentasi dengan nama gambar : '.$request->nama.' Berhasil di Delete !');
    		}else{
    			return redirect()->action('dokumentasiController@index')->with('danger','Data Dokumentasi dengan nama gambar : '.$request->nama.' Berhasil di Delete tapi file Gagal di Delete !');
    		}
			
		}else{
			return redirect()->action('dokumentasiController@index')->with('danger','Data Dokumentasi dengan nama gambar : '.$request->nama.' Gagal di Delete !');
		}
    }
    //perintah untuk menampilkan satu data dokumentasi yang akan diubah
    public function show($id){
    	$dokumentasi=DB::table('dokumentasi')
    	->where('id_dokumentasi',$id)
    	->join('rapat','dokumentasi.id_rapat','=','rapat.id_rapat')
    	->orderBy('dokumentasi.id_rapat','asc')
    	->get();
    	$rapat=DB::table('rapat')->whereIn('status',['pass','fix'])->orderBy('tanggal','desc')->get();
    	return view('dashboard.dokumentasi.editdokumentasi',['datadokumentasi'=>$dokumentasi])
    	->with('daftarrapat',$rapat);
    }
    //perintah untuk mengupdate data dokumentasi
    public function edit(Request $request, $id){
    	$this->validate($request,[
    		'gambar'=>'file|image|mimes:jpeg,png,gif,jpg,webp|max:2048',
    	]);
    	$waktu_sekarang=date('Y-m-d H:i:s');
    	$waktu_sekarang_name=date('Y_m_d_His');
    	if ($request->hasFile('gambar')) {
    		$namafile=$waktu_sekarang_name.' '.$request->file('gambar')->getClientOriginalName();
    	}else{
    		$namafile=$request->gambar1;
    	}
    	$perintah=DB::table('dokumentasi')->where('id_dokumentasi',$id)->update([
    		'nama'=>$namafile,
			'id_rapat'=>$request->id_rapat,
			'updated_at'=>$waktu_sekarang
    	]);
    	if($perintah){
    		if ($request->hasFile('gambar')) {
    			$upload_file_dokumentasi=$request->file('gambar')
    			->move('fotoDokumentasi/',$waktu_sekarang_name.' '.$request
    			->file('gambar')->getClientOriginalName());
    			File::delete('fotoDokumentasi/'.$request->gambar1);
    			if ($upload_file_dokumentasi) {
	    			return redirect()->action('dokumentasiController@index')->with('success','Data Dokumentasi dengan nama gambar : '.$namafile.' Berhasil di Update !');
	    		}else{
	    			return redirect()->action('dokumentasiController@index')->with('danger','Data Dokumentasi dengan nama gambar : '.$namafile.' Berhasil di Update tapi file Gagal di Upload !');
	    		}
			}else{
				return redirect()->action('dokumentasiController@index')->with('success','Data Dokumentasi dengan nama gambar : '.$namafile.' Berhasil di Update !');
			}
    		
		}else{
			return redirect()->action('notulenController@index')->with('danger','Data Dokumentasi dengan nama gambar : '.$namafile.' Gagal di Update !');
		}
    	
    }

}
