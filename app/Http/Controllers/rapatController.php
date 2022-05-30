<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class rapatController extends Controller
{
    public function index(){
    	$rapat=DB::table('rapat')->get();
    	return view('dashboard.rapat.rapat',['datarapat'=>$rapat]);
    }
    public function tambah(Request $request){
    	$waktu_sekarang=date('Y-m-d H:i:s');
    	$perintah=DB::table('rapat')->insert([
    		'id_rapat'=>null,
    		'topik'=>$request->topik,
    		'tanggal'=>$request->tanggal,
    		'jam'=>$request->jam,
    		'tempat'=>$request->tempat,
    		'status'=>$request->status,
    		'deskripsi'=>$request->deskripsi,
    		'created_at'=>$waktu_sekarang,
    		'updated_at'=>$waktu_sekarang
    	]);
    	if($perintah){
			return redirect()->action('rapatController@index')->with('success','Data Rapat Dengan Topik "'.$request->topik.'" Berhasil di Inputkan !');
		}else{
			return redirect()->action('rapatController@index')->with('danger','Data Rapat Dengan Topik "'.$request->topik.'" Gagal di Inputkan !');
		}
    }
    public function hapus(Request $request){
    	$perintah=DB::table('rapat')
    	->where('id_rapat',Input::get('id'))
    	->delete();
    	if($perintah){
			return redirect()->action('rapatController@index')->with('success','Data Rapat Dengan Topik "'.$request->topik.'" Berhasil di Hapus !');
		}else{
			return redirect()->action('rapatController@index')->with('danger','Data Rapat Dengan Topik "'.$request->topik.'" Gagal di Hapus !');
		}
    }
    public function show($id){
    	$rapat=DB::table('rapat')->where('id_rapat',$id)->get();
    	return view('dashboard.rapat.editrapat',['datarapat'=>$rapat]);
    }
    public function edit(Request $request, $id){
    	$waktu_sekarang=date('Y-m-d H:i:s');
    	$perintah=DB::table('rapat')
    	->where('id_rapat',$id)
    	->update([
    		'topik'=>$request->topik,
    		'tanggal'=>$request->tanggal,
    		'jam'=>$request->jam,
    		'tempat'=>$request->tempat,
    		'status'=>$request->status,
    		'deskripsi'=>$request->deskripsi,
    		'updated_at'=>$waktu_sekarang
    	]);
    	if($perintah){
			return redirect()->action('rapatController@index')->with('success','Data Rapat Dengan Topik "'.$request->topik.'" Berhasil di Update !');
		}else{
			return redirect()->action('rapatController@index')->with('danger','Data Rapat Dengan Topik "'.$request->topik.'" Gagal di Update !');
		}
    }
    public function indexhome(){
        $id_pegawai=auth()->user()->id_pegawai;
        $tanggal_sekarang=date('Y-m-d');
        $rapat=DB::table('rapat')
            ->select('rapat.*')
            ->where('id_pegawai',$id_pegawai)
            ->whereIn('rapat.status',['fix','cancel'])
            ->whereDate('tanggal','>=',$tanggal_sekarang)
            ->join('peserta_rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
            ->get();
        return view('dashboard',['datarapat'=>$rapat]);

    }
    public function detailrapat($id_rapat){
        $id_pegawai=auth()->user()->id_pegawai;
        $tanggal_sekarang=date('Y-m-d H:i:s');
        $perintah=DB::table('peserta_rapat')
        ->where('id_pegawai',$id_pegawai)
        ->where('id_rapat',$id_rapat)
        ->update([
            'dilihat_pada'=>$tanggal_sekarang
        ]);
        $peserta_rapat=DB::table('peserta_rapat')
            ->where('peserta_rapat.id_rapat',$id_rapat)
            ->where('peserta_rapat.id_pegawai',$id_pegawai)
            ->select('peserta_rapat.*','rapat.id_rapat','rapat.topik','rapat.tanggal','pegawai.*','opd.id_opd','opd.nama_opd')
            ->join('rapat','peserta_rapat.id_rapat','=','rapat.id_rapat')
            ->join('pegawai','peserta_rapat.id_pegawai','=','pegawai.id_pegawai')
            ->join('opd','pegawai.id_opd','=','opd.id_opd')
            ->get();
        $pegawai=DB::table('pegawai')
            ->where('id_pegawai',$id_pegawai)
            ->join('opd','opd.id_opd','=','pegawai.id_opd')
            ->get();
        $rapat=DB::table('rapat')->where('id_rapat',$id_rapat)->get();
        $surat=DB::table('surat')->where('id_rapat',$id_rapat)->get();
        return view('dashboard.rapat.detailrapat',['datarapat'=>$rapat,'surat'=>$surat, 'datapeserta_rapat'=>$peserta_rapat, 'daftarpegawai'=>$pegawai]);
    }
    public function konfirmasikehadiran(Request $request, $id_rapat){
        $id_pegawai=auth()->user()->id_pegawai;
        $waktu_sekarang=date('Y-m-d H:i:s');
        $perintah=DB::table('peserta_rapat')->where('id_pegawai',$id_pegawai)
        ->where('id_rapat',$id_rapat)->update([
            'status'=>$request->status,
            'keterangan'=>$request->keterangan,
            'updated_at'=>$waktu_sekarang
        ]);
        if($perintah){
            return redirect('/dashboard/detail_rapat/'.$id_rapat)->with('success','Status Kehadiran Berhasil di Update !');
        }else{
            return redirect('/dashboard/detail_rapat/'.$id_rapat)->with('danger','Status Kehadiran Gagal di Update !');
        }
    }
    public function indexrapat_sebelumnya(){
        $id_pegawai=auth()->user()->id_pegawai;
        $tanggal_sekarang=date('Y-m-d');
        $rapat=DB::table('rapat')
            ->select('rapat.*')
            ->where('id_pegawai',$id_pegawai)
            ->whereIn('rapat.status',['pass','cancel'])
            ->whereDate('tanggal','<',$tanggal_sekarang)
            ->join('peserta_rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
            ->get();
        return view('dashboard.rapat.rapat_sebelumnya',['datarapat'=>$rapat]);
    }
    public function detailrapat_sebelumnya($id_rapat){
        $id_pegawai=auth()->user()->id_pegawai;
        $pegawai=DB::table('pegawai')
            ->where('id_pegawai',$id_pegawai)
            ->join('opd','opd.id_opd','=','pegawai.id_opd')
            ->get();
        $peserta_rapat=DB::table('peserta_rapat')
            ->where('id_rapat',$id_rapat)
            ->where('id_pegawai',$id_pegawai)->get();
        $rapat=DB::table('rapat')->where('id_rapat',$id_rapat)->get();
        $surat=DB::table('surat')->where('id_rapat',$id_rapat)->get();
        $dokumentasi=DB::table('dokumentasi')->where('id_rapat',$id_rapat)->get();
        $notulen=DB::table('notulen')->where('id_rapat',$id_rapat)->get();
        return view('dashboard.rapat.detailrapat_sebelumnya',['datarapat'=>$rapat,'surat'=>$surat, 'datapeserta_rapat'=>$peserta_rapat, 'daftarpegawai'=>$pegawai, 'dokumentasi'=>$dokumentasi, 'notulen'=>$notulen]);
    }
}
