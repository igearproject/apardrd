<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class pengelolaan_rapatController extends Controller
{
    //fungsi untuk menampilkan pemilihan rapat yang akan dikelola
    public function index(){
    	$rapat=DB::table('rapat')
    		->orderBy('tanggal','desc')
    		->get();
    	return view('/dashboard/pengelolaan_rapat/home',['daftarrapat'=>$rapat]);
    }
    //fungsi untuk memilih rapat yang akan dikelola
    public function pilih(Request $request){
    	$rapat=DB::table('rapat')
    		->where('id_rapat',$request->id_rapat)
    		->get();
    	return redirect('/dashboard/pengelolaan_rapat/'.$request->id_rapat);
    }
    public function indexrapat($id_rapat){
    	$rapat=DB::table('rapat')
    		->where('id_rapat',$id_rapat)
    		->get();
    	return view('/dashboard/pengelolaan_rapat/rapat',['datarapatutama'=>$rapat]);
    }
    public function editstatusrapat(Request $request){
    	$waktu_sekarang=date('Y-m-d H:i:s');
    	$perintah=DB::table('rapat')
    	->where('id_rapat',$request->id_rapat)
    	->update([
    		'status'=>$request->status,
    		'updated_at'=>$waktu_sekarang
    	]);
    	if($perintah){
			return redirect('/dashboard/pengelolaan_rapat/'.$request->id_rapat)->with('success','Data Rapat Dengan Topik "'.$request->topik.'" Berhasil di Update !');
		}else{
			return redirect('/dashboard/pengelolaan_rapat/'.$request->id_rapat)->with('danger','Data Rapat Dengan Topik "'.$request->topik.'" Gagal di Update !');
		}
    }
    public function indexpeserta_rapat($id_rapat){
    	$peserta_rapat=DB::table('peserta_rapat')
    		->where('peserta_rapat.id_rapat',$id_rapat)
    		->select('peserta_rapat.*','rapat.id_rapat','rapat.topik','rapat.tanggal','pegawai.*','opd.id_opd','opd.nama_opd')
	    	->join('rapat','peserta_rapat.id_rapat','=','rapat.id_rapat')
	    	->join('pegawai','peserta_rapat.id_pegawai','=','pegawai.id_pegawai')
	    	->join('opd','pegawai.id_opd','=','opd.id_opd')
    		->get();
    	$rapat=DB::table('rapat')
    		->where('id_rapat',$id_rapat)
    		->get();
    	$pegawai=DB::table('pegawai')
	    	->select('pegawai.*','opd.id_opd','opd.nama_opd')
	    	->join('opd','pegawai.id_opd','=','opd.id_opd')
	    	->get();
    	return view('dashboard.pengelolaan_rapat.kelola_peserta_rapat',['datarapatutama'=>$rapat])->with('datapeserta_rapat',$peserta_rapat)->with('datapegawai',$pegawai);
    }
    public function tambahpeserta_rapat(Request $request, $id_rapat){
    	$waktu_sekarang=date('Y-m-d H:i:s');
    	$p=0;
        // dd($request->all());
    	while ( $p< count($request->id_pegawai)) {
    		if (isset($request->tambah_peserta1[$p])&&$request->tambah_peserta1[$p]=='Y') {
	    		$perintah=DB::table('peserta_rapat')->insert([
		    		'id_peserta'=>null,
					'id_pegawai'=>$request->id_pegawai[$p],
					'id_rapat'=>$id_rapat,
					'status'=>'alpa',
					'keterangan'=>'Tidak ada keterangan ...',
					'created_at'=>$waktu_sekarang,
					'updated_at'=>$waktu_sekarang
		    	]);
	    	}
	    	$p++;
    	}
    	if(isset($perintah)&&$perintah){
			return redirect('/dashboard/pengelolaan_rapat/'.$request->id_rapat.'/peserta')->with('success','Data Peserta Rapat Berhasil di Tambahkan !');
		}elseif (!isset($perintah)) {
            return redirect('/dashboard/pengelolaan_rapat/'.$request->id_rapat.'/peserta')->with('danger','Tidak ada Data Peserta Rapat Yang Dipilih!');
        }
        else{
			return redirect('/dashboard/pengelolaan_rapat/'.$request->id_rapat.'/peserta')->with('danger','Data Peserta Rapat Gagal di Tambahkan !');
		}
    	
    }
    public function indexsurat($id_rapat){    		
    	$surat=DB::table('surat')
	    	->where('surat.id_rapat',$id_rapat)
	    	->join('rapat','surat.id_rapat','=','rapat.id_rapat')
	    	->get();
    	$rapat=DB::table('rapat')
    		->where('id_rapat',$id_rapat)
    		->get();
    	return view('dashboard.pengelolaan_rapat.kelola_surat_rapat',['datarapatutama'=>$rapat])->with('datasurat',$surat);
    }
     public function tambahsurat(Request $request, $id_rapat){
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
    		'id_rapat'=>$id_rapat,
			'created_at'=>$waktu_sekarang,
			'updated_at'=>$waktu_sekarang
    	]);
    	if($perintah){
    		$upload_file_surat=$request->file('file')
    		->move('fileSurat/',$waktu_sekarang_name.' '.$request->file('file')->getClientOriginalName());
    		if ($upload_file_surat) {
    			return redirect('/dashboard/pengelolaan_rapat/'.$id_rapat.'/surat')->with('success','Data Surat dengan No Surat '.$request->no_surat.' Berhasil di Inputkan !');
    		}else{
    			return redirect('/dashboard/pengelolaan_rapat/'.$id_rapat.'/surat')->with('danger','Data Surat dengan No Surat '.$request->no_surat.' Berhasil di Inputkan tapi file Gagal di Upload !');
    		}
			
		}else{
			return redirect()->action('suratController@index')->with('danger','Data Surat dengan No Surat '.$request->no_surat.' Gagal di Inputkan !');
		}
    }
    public function indexabsensi($id_rapat){
	    $peserta_rapat=DB::table('peserta_rapat')
    		->select('peserta_rapat.*','rapat.id_rapat','rapat.topik','rapat.tanggal','pegawai.*','opd.id_opd','opd.nama_opd')
    		->where('peserta_rapat.id_rapat',$id_rapat)
	    	->join('rapat','peserta_rapat.id_rapat','=','rapat.id_rapat')
	    	->join('pegawai','peserta_rapat.id_pegawai','=','pegawai.id_pegawai')
	    	->join('opd','pegawai.id_opd','=','opd.id_opd')
	    	->get();
    	$rapat=DB::table('rapat')
    		->where('id_rapat',$id_rapat)
    		->get();
    	return view('dashboard.pengelolaan_rapat.kelola_absensi_rapat',['datarapatutama'=>$rapat])->with('datapeserta_rapat',$peserta_rapat);
    }
    public function editabsensi(Request $request, $id_rapat){
    	$waktu_sekarang=date('Y-m-d H:i:s');
    	$p=0;
    	while ( $p< count($request->id_peserta)) {
    		$perintah=DB::table('peserta_rapat')
    		->where('id_peserta',$request->id_peserta[$p])
    		->update([
				'status'=>$request->status_absensi[$p],
				'keterangan'=>$request->keterangan[$p],
				'updated_at'=>$waktu_sekarang
	    	]);
	    	$p++;
    	}
    	
    	if($perintah){
			return redirect('/dashboard/pengelolaan_rapat/'.$id_rapat.'/absensi')->with('success','Data absensi Berhasil di Update !');
		}else{
			return redirect('/dashboard/pengelolaan_rapat/'.$id_rapat.'/absensi')->with('danger','Data absensi Gagal di Update !');
		}
    }
    public function indexdokumentasi($id_rapat){
        $dokumentasi=DB::table('dokumentasi')
            ->where('dokumentasi.id_rapat',$id_rapat)
            ->join('rapat','dokumentasi.id_rapat','=','rapat.id_rapat')
            ->get();
        $rapat=DB::table('rapat')
            ->where('id_rapat',$id_rapat)
            ->get();
        return view('dashboard.pengelolaan_rapat.kelola_dokumentasi_rapat',['datarapatutama'=>$rapat])->with('datadokumentasi',$dokumentasi);
    }
    //fungsi untuk menambahkan data dokumentasi
    public function tambahdokumentasi(Request $request, $id_rapat){
        $this->validate($request,[
            'gambar'=>'required|file|image|mimes:jpeg,png,gif,jpg,webp|max:2048',
        ]);
        $waktu_sekarang=date('Y-m-d H:i:s');
        $waktu_sekarang_name=date('Y_m_d_His');
        $namafile=$waktu_sekarang_name.' '.$request->file('gambar')->getClientOriginalName();
        $perintah=DB::table('dokumentasi')->insert([
            'id_dokumentasi'=>null,
            'nama'=>$namafile,
            'id_rapat'=>$id_rapat,
            'created_at'=>$waktu_sekarang,
            'updated_at'=>$waktu_sekarang
        ]);
        if($perintah){
            $upload_file_dokumentasi=$request->file('gambar')
                ->move('fotoDokumentasi/',$waktu_sekarang_name.' '.$request
                ->file('gambar')->getClientOriginalName());
            if ($upload_file_dokumentasi) {
                return redirect('/dashboard/pengelolaan_rapat/'.$id_rapat.'/dokumentasi')->with('success','Data Dokumentasi Berhasil di Inputkan !');
            }else{
                return redirect('/dashboard/pengelolaan_rapat/'.$id_rapat.'/dokumentasi')->with('danger','Data Dokumentasi Berhasil di Inputkan tapi file Gagal di Upload !');
            }
        }else{
            return redirect('/dashboard/pengelolaan_rapat/'.$id_rapat.'/dokumentasi')->with('danger','Data Dokumentasi Gagal di Inputkan !');
        }
    }
    public function indexnotulensi($id_rapat){
        $notulensi=
            DB::table('notulen')
            ->where('notulen.id_rapat',$id_rapat)
            ->join('rapat','notulen.id_rapat','=','rapat.id_rapat')
            ->get();
        $rapat=DB::table('rapat')
            ->where('id_rapat',$id_rapat)
            ->get();
        return view('dashboard.pengelolaan_rapat.kelola_notulensi_rapat',['datarapatutama'=>$rapat])->with('datanotulensi',$notulensi);
    }
    public function tambahnotulensi(Request $request, $id_rapat){
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
            'id_rapat'=>$id_rapat,
            'created_at'=>$waktu_sekarang,
            'updated_at'=>$waktu_sekarang
        ]);
        if($perintah){
            $upload_file_surat=$request->file('file_notulen')
                ->move('fileNotulen/',$waktu_sekarang_name.' '.$request
                ->file('file_notulen')->getClientOriginalName());
            if ($upload_file_surat) {
                return redirect('/dashboard/pengelolaan_rapat/'.$id_rapat.'/notulensi')
                ->with('success','Notulen Rapat Yang Di Buat Oleh '.$request->pembuat.' Berhasil di Inputkan !');
            }else{
                return redirect('/dashboard/pengelolaan_rapat/'.$id_rapat.'/notulensi')
                ->with('danger','Notulen Rapat Yang Di Buat Oleh '.$request->pembuat.' Berhasil di Inputkan tapi file Gagal di Upload !');
            }
        }else{
            return redirect('/dashboard/pengelolaan_rapat/'.$id_rapat.'/notulensi')
            ->with('danger','Notulen Rapat Yang Di Buat Oleh '.$request->pembuat.' Gagal di Inputkan !');
        }
    }
    public function kirimemail($id_rapat){
        $peserta=DB::table('peserta_rapat')->where('id_rapat',$id_rapat)
            ->join('pegawai','peserta_rapat.id_pegawai','=','pegawai.id_pegawai')
            ->get();
        $rapat=DB::table('rapat')->where('id_rapat',$id_rapat)->get();
        $statuspengiriman=[];
        $ij=0;
        foreach ($peserta as $datapeserta) {
            $email=$datapeserta->email;
            foreach ($rapat as $datarapat) {
                $datarapat1 = array(
                    'topik' => $datarapat->topik,
                    'tanggal'=>$datarapat->tanggal,
                    'jam'=>$datarapat->jam,
                    'tempat'=>$datarapat->tempat,
                    'status'=>$datarapat->status
                );
                //perintah kirim email
                Mail::send('dashboard/pengelolaan_rapat/templatesuratundangan',$datarapat1,function($mail) use($email){
                    $mail->to($email,'no-reply')
                        ->subject('UNDANGAN RAPAT DRD');
                    //$mail->from('igedearya359@gmail.com','TESTING');
                });
                //menyimpan gagal atau berhasil pengiriman email
                if (Mail::failures()) {
                    $statuspengiriman[$ij][]=$datapeserta->nama;
                    $statuspengiriman[$ij][]=$email;
                    $statuspengiriman[$ij][]='gagal';
                    // $statuspengiriman = array(
                    //     array($datapeserta->nama,$email,'gagal'
                    //     )                        
                    // );
                }else{
                    $statuspengiriman[$ij][]=$datapeserta->nama;
                    $statuspengiriman[$ij][]=$email;
                    $statuspengiriman[$ij][]='berhasil';
                    // $statuspengiriman = array(
                    //     array($datapeserta->nama,$email,'berhasil'
                    //     )
                    // );
                }
            }
            $ij++;
        }
        return redirect('/dashboard/pengelolaan_rapat/'.$id_rapat.'/surat')->with('datapengiriman',$statuspengiriman);

    }
}

