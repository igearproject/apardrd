<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class peserta_rapatController extends Controller
{
    //perintah untuk menampilkan data peserta rapat
    public function index_pilih_rapat(){
        $rapat=DB::table('rapat')
            ->whereNotIn('status',['pass','cancel'])
            ->orderBy('tanggal','desc')
            ->get();
        return view('dashboard.peserta_rapat.pilih_rapat',['daftarrapat'=>$rapat]);
    }
    public function pilih_rapat(Request $request){
        $rapat=DB::table('rapat')
            ->where('id_rapat',$request->id_rapat)
            ->get();
        return redirect('/dashboard/peserta/'.$request->id_rapat);
    }
    public function index($id_rapat){
    	$peserta_rapat=DB::table('peserta_rapat')
    		->select('peserta_rapat.*','rapat.id_rapat','rapat.topik','rapat.tanggal','pegawai.*','opd.id_opd','opd.nama_opd')
            ->where('peserta_rapat.id_rapat',$id_rapat)
	    	->join('rapat','peserta_rapat.id_rapat','=','rapat.id_rapat')
	    	->join('pegawai','peserta_rapat.id_pegawai','=','pegawai.id_pegawai')
	    	->join('opd','pegawai.id_opd','=','opd.id_opd')
	    	->get();
    	$rapat=DB::table('rapat')
    		->orderBy('tanggal','desc')
    		->get();
    	$pegawai=DB::table('pegawai')
    		->join('opd','opd.id_opd','=','pegawai.id_opd')
    		->get();
    	return view('dashboard.peserta_rapat.peserta_rapat',['datapeserta_rapat'=>$peserta_rapat])
	    	->with('daftarrapat',$rapat)
	    	->with('daftarpegawai',$pegawai);
    }
    //perintah untuk menambahkan data peserta rapat
    public function tambah(Request $request, $id_rapat){
    	$waktu_sekarang=date('Y-m-d H:i:s');
    	$perintah=DB::table('peserta_rapat')->insert([
    		'id_peserta'=>null,
			'id_pegawai'=>$request->id_pegawai,
			'id_rapat'=>$id_rapat,
			'status'=>$request->status,
			'keterangan'=>$request->keterangan,
			'created_at'=>$waktu_sekarang,
			'updated_at'=>$waktu_sekarang
    	]);
    	if($perintah){
			return redirect('/dashboard/peserta/'.$id_rapat)->with('success','Peserta baru Berhasil di Inputkan !');
		}else{
			return redirect('/dashboard/peserta/'.$id_rapat)->with('danger','Peserta baru Gagal di Inputkan !');
		}
    }
    //perintah untuk menghapus data rapat
    public function hapus(Request $request, $id_rapat, $id_peserta){
    	$perintah=DB::table('peserta_rapat')->where('id_peserta',$id_peserta)->delete();
    	if($perintah){
			return redirect('/dashboard/peserta/'.$id_rapat)->with('success','Peserta dengan nama '.$request->nama_peserta.' pada rapat '.$request->nama_rapat.' Berhasil di Delete !');
		}else{
			return redirect('/dashboard/peserta/'.$id_rapat)->with('danger','Peserta dengan nama '.$request->nama_peserta.' pada rapat '.$request->nama_rapat.' Gagal di Delete !');
		}
    }
    //perintah untuk menampilkan data peserta yang akan di edit
    public function show($id_rapat, $id){
    	$peserta_rapat=DB::table('peserta_rapat')
            ->where('peserta_rapat.id_rapat',$id_rapat)
    		->where('id_peserta',$id)
    		->select('peserta_rapat.*','rapat.id_rapat','rapat.topik','rapat.tanggal','pegawai.*','opd.id_opd','opd.nama_opd')
	    	->join('rapat','peserta_rapat.id_rapat','=','rapat.id_rapat')
	    	->join('pegawai','peserta_rapat.id_pegawai','=','pegawai.id_pegawai')
	    	->join('opd','pegawai.id_opd','=','opd.id_opd')
	    	->get();
    	$rapat=DB::table('rapat')
    		->orderBy('tanggal','desc')
    		->get();
    	$pegawai=DB::table('pegawai')
    		->join('opd','opd.id_opd','=','pegawai.id_opd')
    		->get();
    	return view('dashboard.peserta_rapat.editpeserta_rapat',['datapeserta_rapat'=>$peserta_rapat])
	    	->with('daftarrapat',$rapat)
	    	->with('daftarpegawai',$pegawai);
    }
    //perintah untuk mengubah data peserta rapat
    public function edit(Request $request, $id_rapat, $id){
    	$waktu_sekarang=date('Y-m-d H:i:s');
    	$perintah=DB::table('peserta_rapat')->where('id_peserta',$id)->update([
    		'id_pegawai'=>$request->id_pegawai,
			'status'=>$request->status,
			'keterangan'=>$request->keterangan,
			'updated_at'=>$waktu_sekarang
    	]);
    	if($perintah){
			return redirect('/dashboard/peserta/'.$id_rapat)->with('success','Peserta Berhasil di Update !');
		}else{
			return redirect('/dashboard/peserta/'.$id_rapat)->with('danger','Peserta Gagal di Update !');
		}
    }
}
