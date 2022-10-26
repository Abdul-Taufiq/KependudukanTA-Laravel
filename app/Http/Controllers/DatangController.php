<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Datang;
use Illuminate\Http\Request;

class DatangController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function index()
    {
        $data = Datang::all();
        return view ('CRUD Datang.Datang', compact('data'), [
            "tittle" => "Data Datang"
        ],
        [
            'data'=>$data
        ]);
    }

    // CETAK DATA
    public function cetakdatadatang()
    {
        $data = Datang::all()->sortBy('no_datang');
        $pdf = PDF::loadView('CRUD datang.cetak-data-datang', ['cetakdatadatang' => $data]);
        return $pdf->stream('laporan-data-datang.pdf');

    }

    // CETAK DETAIL
    public function cetakdetaildatadatang(Datang $datang)
    {
         // $data = datang::with('penduduk')->find($datang);
       $pdf = PDF::loadView('CRUD Datang.cetak-detail-data-datang', compact('datang'));
       return $pdf->stream('laporan-detail-data-datang.pdf');
    }

     // CETAK Pertanggal
    public function cetakpertanggal($tglawal, $tglakhir)
    {
        $tgl1 = $tglawal;
        $tgl2 = $tglakhir;
        $dateawal = Carbon::createFromFormat('d-m-Y', $tglawal)->format('Y-m-d');
        $dateakhir = Carbon::createFromFormat('d-m-Y', $tglakhir)->format('Y-m-d');

        if ( strtotime($tglakhir) < strtotime($tglawal) ) {
             return redirect('datang')->with('statuserror', 'GAGAL MENCETAK LAPORAN, PASTIKAN TANGGAL AKHIR LEBIH BESAR DARI TANGGAL AWAL!');
        }
        // dd(["Tanggal Awal : ".$tglawal, "Tanggal Akhir : ".$tglakhir]);
        $cetakpertanggal = Datang::with('penduduk')->whereBetween('tgl_datang',[$dateawal, $dateakhir])->get()->sortBy('no_datang');
        // return view('CRUD datang.cetakdatadatang-pertanggal',  compact('cetakpertanggal'));
        $pdf = PDF::loadView('CRUD Datang.cetak-data-datang-pertanggal', 
            ['cetakpertanggal' => $cetakpertanggal, 'tgl1' => $tgl1, 'tgl2' => $tgl2]);
        return $pdf->stream('laporan-datadatang-pertanggal.pdf');
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
        $cek = datang::count();
        if ($cek == 0) {
            $urut = 10001;
            $nomer = 'KL'.$urut;
        
        } else {
            $ambil = datang::all()->last();
            $urut = (int)substr($ambil->no_datang, 7) + 1;
            $nomer = 'DT'.$thn.$urut;
        }

        return view('CRUD Datang.adddatang',compact('nomer'), [
            "tittle" => "Tambah Data Datang"
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
            'no_datang' => 'required|min:3|unique:tb_datang',
            'tgl_datang' => 'required',
            'alamat_lama' => 'required|max:200|min:2',
            'alamat_baru' => 'required|min:2|max:200',
            'alasan' => 'required|min:1|max:200',
        ], [
            // PESAN ERROR
            'no_datang.min' => 'Nomor Datang Harus Memiliki Minimal 3 Karakter!',
            'no_datang.unique' => 'Nomor Datang Sudah Tersedia!',
            'tgl_datang.required' => 'Kolom Tidak Boleh Kosong!',
            'alamat_lama.max' => 'Kolom Maksimal 200 Karakter!',
            'alamat_lama.min' => 'Kolom Minimal 2 Karakter!',
            'alamat_baru.required' => 'Kolom Tidak Boleh Kosong!',
            'alamat_baru.min' => 'Kolom Minimal 2 Karakter!',
            'alamat_baru.max' => 'Kolom Maksimal 200 Karakter!',
            'alasan.max' => 'Kolom Maksimal 200 Karakter!',
            'alasan.min' => 'alasan Minimal 1 Karakter!'
        ]);

        $datang = new Datang;
        $datang->no_datang = $request->no_datang ;
        $datang->tgl_datang =  Carbon::createFromFormat('d-m-Y', $request->tgl_datang)->format('Y-m-d');
        $datang->alamat_lama = $request->alamat_lama ;
        $datang->alamat_baru = $request->alamat_baru ;
        $datang->alasan = $request->alasan ;
        $datang->created_at = now() ;
        $datang->save();

        // \DB::table('tb_datang')->insert([
        //     'no_datang' => $request -> no_datang ,
        //     'tgl_datang' => $request -> tgl_datang ,
        //     'alamat_lama' => $request -> alamat_lama ,
        //     'alamat_baru' => $request -> alamat_baru,
        //     'alasan' => $request -> alasan ,
        //     'created_at' => now(),
        // ]);
        return redirect('datang')->with('status', 'DATA DATANG BERHASIL DITAMBAH!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Datang  $datang
     * @return \Illuminate\Http\Response
     */
    public function show(Datang $datang)
    {
        return view ('CRUD Datang.detaildatang', compact('datang'),
        [
            "tittle" => "Detail Data Datang"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Datang  $datang
     * @return \Illuminate\Http\Response
     */
    public function edit(Datang $datang)
    {
        $data = Datang::all();
        return view ('CRUD Datang.updatedatang', compact('datang', 'data'),
        [
            "tittle" => "Edit Data Datang"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Datang  $datang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Datang $datang)
    {
        // FORM VALIDASI
        $request->validate([
            'no_datang' => 'required|min:3|unique:tb_datang,id_datang',
            'tgl_datang' => 'required',
            'alamat_lama' => 'required|max:200|min:2',
            'alamat_baru' => 'required|min:2|max:200',
            'alasan' => 'required|min:1|max:200',
        ], [
            // PESAN ERROR
            'no_datang.min' => 'Nomor Datang Harus Memiliki Minimal 3 Karakter!',
            'no_datang.unique' => 'Nomor Datang Sudah Tersedia!',
            'tgl_datang.required' => 'Kolom Tidak Boleh Kosong!',
            'alamat_lama.max' => 'Kolom Maksimal 200 Karakter!',
            'alamat_lama.min' => 'Kolom Minimal 2 Karakter!',
            'alamat_baru.required' => 'Kolom Tidak Boleh Kosong!',
            'alamat_baru.min' => 'Kolom Minimal 2 Karakter!',
            'alamat_baru.max' => 'Kolom Maksimal 200 Karakter!',
            'alasan.max' => 'Kolom Maksimal 200 Karakter!',
            'alasan.min' => 'alasan Minimal 1 Karakter!'
        ]);

        $datang->no_datang = $request->no_datang ;
        $datang->tgl_datang =  Carbon::createFromFormat('d-m-Y', $request->tgl_datang)->format('Y-m-d');
        $datang->alamat_lama = $request->alamat_lama ;
        $datang->alamat_baru = $request->alamat_baru ;
        $datang->alasan = $request->alasan ;
        $datang->updated_at = now() ;
        $datang->save();

        // Datang::where('id_datang', $datang->id_datang)
        // ->update([
        //     'no_datang' => $request -> no_datang ,
        //     'tgl_datang' => $request -> tgl_datang ,
        //     'alamat_lama' => $request -> alamat_lama ,
        //     'alamat_baru' => $request -> alamat_baru,
        //     'alasan' => $request -> alasan,
        //     'updated_at' => now(),
        // ]);
        return redirect('datang')->with('status', 'DATA DATANG BERHASIL DIUBAH!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Datang  $datang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Datang $datang)
    {
        $datang->delete();
        return redirect('datang')->with('status', 'DATA DATANG BERHASIL HAPUS!');
    }
}
