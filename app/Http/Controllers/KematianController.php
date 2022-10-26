<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Kematian;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use DB;

class KematianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {
        $data = Kematian::all();
        return view('CRUD Kematian.Kematian',compact('data'), [
            'tittle' => 'Data Kematian'
        ],
        [
            'data'=>$data
        ]);
    }

    // CETAK DATA
    public function cetakdatakematian()
    {
        $data = Kematian::all()->sortBy('no_kematian');
        $pdf = PDF::loadView('CRUD Kematian.cetak-data-kematian', ['cetakdatakematian' => $data]);
        return $pdf->stream('laporan-data-kematian.pdf');

    }    

     // CETAK DETAIL
    public function cetakdetaildatakematian(Kematian $kematian)
    {
         // $data = kematian::with('penduduk')->find($kematian);
       $pdf = PDF::loadView('CRUD Kematian.cetak-detail-data-kematian', compact('kematian'));
       return $pdf->stream('laporan-detail-data-kematian.pdf');
    } 

     // CETAK Pertanggal
    public function cetakpertanggal($tglawal, $tglakhir)
    {
        $tgl1 = $tglawal;
        $tgl2 = $tglakhir;
        $dateawal = Carbon::createFromFormat('d-m-Y', $tglawal)->format('Y-m-d');
        $dateakhir = Carbon::createFromFormat('d-m-Y', $tglakhir)->format('Y-m-d');

        if ( strtotime($tglakhir) < strtotime($tglawal) ) {
             return redirect('kematian')->with('statuserror', 'GAGAL MENCETAK LAPORAN, PASTIKAN TANGGAL AKHIR LEBIH BESAR DARI TANGGAL AWAL!');
        }
        // dd(["Tanggal Awal : ".$tglawal, "Tanggal Akhir : ".$tglakhir]);
        $cetakpertanggal = Kematian::with('penduduk')->whereBetween('tgl_kematian',[$dateawal, $dateakhir])->get()->sortBy('no_kematian');
        // return view('CRUD kematian.cetakdatakematian-pertanggal',  compact('cetakpertanggal'));
        $pdf = PDF::loadView('CRUD Kematian.cetak-data-kematian-pertanggal', 
            ['cetakpertanggal' => $cetakpertanggal, 'tgl1' => $tgl1, 'tgl2' => $tgl2]);
        return $pdf->stream('laporan-datakematian-pertanggal.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         // KL2022-
        $now = Carbon::now();
        $thn = $now->year.$now->month;
        $cek = kematian::count();
        if ($cek == 0) {
            $urut = 10001;
            $nomer = 'KL'.$urut;
        
        } else {
            $ambil = kematian::all()->last();
            $urut = (int)substr($ambil->no_kematian, 7) + 1;
            $nomer = 'KM'.$thn.$urut;
        }

        return view('CRUD Kematian.addkematian',compact('nomer'), [
            "tittle" => "Tambah Data Kematian"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // FORM VALIDASI
        $request->validate([
            'no_kematian' => 'required|min:3|unique:tb_kematian',
            'tgl_kematian' => 'required',
            'umur' => 'required|numeric',
            'tempat_kematian' => 'required|min:2|max:200',
            'keterangan' => 'required|min:1|max:200',
        ], [
            // PESAN ERROR
            'no_kematian.min' => 'Nomor Kematian Harus Memiliki 3 Karakter!',
            'no_kematian.unique' => 'Nomor Kematian Sudah Tersedia!',
            'tgl_kematian.required' => 'Nama tgl_kematian Tidak Boleh Kosong!',
            'umur.numeric' => 'Kolom Harus Menggunakan Angka!',
            'tempat_kematian.required' => 'Kolom Tidak Boleh Kosong!',
            'tempat_kematian.min' => 'Kolom Minimal 2 Karakter!',
            'tempat_kematian.max' => 'Kolom Maksimal 200 Karakter!',
            'keterangan.max' => 'Kolom Maksimal 200 Karakter!',
            'keterangan.min' => 'keterangan Minimal 1 Karakter!'
        ]);

        $kematian = new Kematian;
        $kematian->no_kematian = $request->no_kematian ;
        $kematian->tgl_kematian =  Carbon::createFromFormat('d-m-Y', $request->tgl_kematian)->format('Y-m-d');
        $kematian->umur = $request->umur ;
        $kematian->tempat_kematian = $request->tempat_kematian ;
        $kematian->keterangan = $request->keterangan ;
        $kematian->created_at = now() ;
        $kematian->save();

        // \DB::table('tb_kematian')->insert([
        //     'no_kematian' => $request -> no_kematian ,
        //     'tgl_kematian' => $request -> tgl_kematian ,
        //     'umur' => $request -> umur ,
        //     'tempat_kematian' => $request -> tempat_kematian,
        //     'keterangan' => $request -> keterangan ,
        //     'created_at' => now(),
        // ]);
        return redirect('kematian')->with('status', 'DATA KEMATIAN BERHASIL DITAMBAH!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kematian  $kematian
     * @return \Illuminate\Http\Response
     */
    public function show(Kematian $kematian)
    {
        return view ('CRUD Kematian.detailkematian', compact('kematian'),
        [
            "tittle" => "Detail Data Kematian"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kematian  $kematian
     * @return \Illuminate\Http\Response
     */
    public function edit(Kematian $kematian)
    {
        $data = Kematian::all();
        $penduduk = Penduduk::all();
        return view ('CRUD Kematian.updatekematian', compact('kematian', 'data','penduduk'),
            [
                "tittle" => "Edit Data Kematian"
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kematian  $kematian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kematian $kematian)
    {
        // FORM VALIDASI
        $request->validate([
            'no_kematian' => 'required|min:3|unique:tb_kematian,id_kematian',
            'tgl_kematian' => 'required',
            'umur' => 'required|numeric',
            'tempat_kematian' => 'required|min:2|max:200',
            'keterangan' => 'required|min:1|max:200',
        ], [
            // PESAN ERROR
            'no_kematian.min' => 'Nomor Kematian Harus Memiliki 3 Karakter!',
            'no_kematian.unique' => 'Nomor Kematian Sudah Tersedia!',
            'tgl_kematian.required' => 'Nama tgl_kematian Tidak Boleh Kosong!',
            'umur.numeric' => 'Kolom Harus Menggunakan Angka!',
            'tempat_kematian.required' => 'Kolom Tidak Boleh Kosong!',
            'tempat_kematian.min' => 'Kolom Minimal 2 Karakter!',
            'tempat_kematian.max' => 'Kolom Maksimal 200 Karakter!',
            'keterangan.max' => 'Kolom Maksimal 200 Karakter!',
            'keterangan.min' => 'keterangan Minimal 1 Karakter!'
        ]);

        $kematian->no_kematian = $request->no_kematian ;
        $kematian->tgl_kematian =  Carbon::createFromFormat('d-m-Y', $request->tgl_kematian)->format('Y-m-d');
        $kematian->umur = $request->umur ;
        $kematian->tempat_kematian = $request->tempat_kematian ;
        $kematian->keterangan = $request->keterangan ;
        $kematian->updated_at = now() ;
        $kematian->save();

        // Kematian::where('id_kematian', $kematian->id_kematian)
        // ->update([
        //     'no_kematian' => $request -> no_kematian ,
        //     'tgl_kematian' => $request -> tgl_kematian ,
        //     'umur' => $request -> umur ,
        //     'tempat_kematian' => $request -> tempat_kematian,
        //     'keterangan' => $request -> keterangan ,
        //     'updated_at' => now(),
        // ]);
        return redirect('kematian')->with('status', 'DATA KEMATIAN BERHASIL DIUBAH!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kematian  $kematian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kematian $kematian)
    {
        $kematian->delete();
        return redirect('kematian')->with('status', 'DATA KEMATIAN BERHASIL HAPUS!');
    }
}
