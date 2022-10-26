<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Kk;
use Illuminate\Http\Request;

class KkController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {
        $data = Kk::all();
        return view ('CRUD kk.kk', compact('data'), [
            "tittle" => "Data Kartu Keluarga"
        ],
        [
            'data'=>$data
        ]);
    }

    // CETAK DATA
    public function cetakdatakk()
    {
        $data = Kk::all()->sortBy('alamat_klg');
        $pdf = PDF::loadView('CRUD kk.cetakdatakk', ['cetakdatakk' => $data]);
        return $pdf->stream('laporan-data-kk.pdf');

    }    

    // CETAK DETAIL
    public function cetakdetaildatakk(Kk $kk)
    {
         // $data = Kk::with('penduduk')->find($kk);
       $pdf = PDF::loadView('CRUD kk.cetak-detail-datakk', compact('kk'));
       return $pdf->setPaper('A4','landscape')
                    ->stream('laporan-detail-data-kk.pdf');
    }

    // CETAK Pertanggal
    public function cetakpertanggal($tglawal, $tglakhir)
    {
        $tgl1 = $tglawal;
        $tgl2 = $tglakhir;
        $dateawal = Carbon::createFromFormat('d-m-Y', $tglawal)->format('Y-m-d');
        $dateakhir = Carbon::createFromFormat('d-m-Y', $tglakhir)->format('Y-m-d');

        if ( strtotime($tglakhir) < strtotime($tglawal) ) {
             return redirect('kk')->with('statuserror', 'GAGAL MENCETAK LAPORAN, PASTIKAN TANGGAL AKHIR LEBIH BESAR DARI TANGGAL AWAL!');
        }
        // dd(["Tanggal Awal : ".$tglawal, "Tanggal Akhir : ".$tglakhir]);
        $cetakpertanggal = Kk::with('penduduk')->whereBetween('created_at',[$dateawal, $dateakhir])->get()->sortBy('alamat_klg');
        // return view('CRUD kk.cetakdatakk-pertanggal',  compact('cetakpertanggal'));
        $pdf = PDF::loadView('CRUD kk.cetakdatakk-pertanggal', 
            ['cetakpertanggal' => $cetakpertanggal, 'tgl1' => $tgl1, 'tgl2' => $tgl2]);
        return $pdf->stream('laporan-datakk-pertanggal.pdf');
    }


    public function create()
    {
       return view ('CRUD kk.addkk', [
            "tittle" => "Tambah Data Kartu Keluarga"
      ]);
    }


    public function store(Request $request)
    {
        // FORM VALIDASI
        $request->validate([
            'no_kk' => 'required|numeric|min:1111111111111111|max:99999999999999999|unique:tb_kk',
            'alamat_klg' => 'required|min:3|max:100',
            'rt' => 'required|numeric|max:9999',
            'rw' => 'required|numeric|max:9999',
        ], [
            // PESAN ERROR
            'no_kk.min' => 'Nomor KK Harus Memiliki 16 Angka!',
            'no_kk.unique' => 'Nomor KK Sudah Tersedia!',
            'alamat_klg.min' => 'Alamat Keluarga Minimal 3 Karakter!',
            'alamat_klg.max' => 'Alamat Keluarga Maksimal 100 Karakter!',
            'no_kk.numeric' => 'Nomor KK Harus Menggunakan Angka!',
            'rt.numeric' => 'Nomor RT Harus Menggunakan Angka!',
            'rw.numeric' => 'Nomor RW Harus Menggunakan Angka!',
        ]);

        \DB::table('tb_kk')->insert([
            'no_kk' => $request -> no_kk ,
            'alamat_klg' => $request -> alamat_klg ,
            'rt' => $request -> rt ,
            'rw' => $request -> rw ,
            'created_at' => now(),
        ]);
        return redirect('kk')->with('status', 'DATA KARTU KELUARGA BERHASIL DITAMBAH!');

    }


    public function show(Kk $kk)
    {
        // return $kk;
       // $data = Kk::all();
        return view ('CRUD kk.detailkk', compact('kk'),
        [
            "tittle" => "Detail Data Kartu Keluarga"
        ]);
    }


    public function edit(Kk $kk)
    {
       // $kk = \DB::table('tb_kk')->where('id_kk', $id_kk)->first();
       $data = Kk::all();
        return view ('CRUD kk.updatekk', compact('kk', 'data'),
        [
            "tittle" => "Edit Data Kartu Keluarga"
        ]);
    }


    public function update(Request $request, Kk $kk)
    {
        // FORM VALIDASI
        $request->validate([
           'no_kk' => 'required|numeric|min:1111111111111111|max:99999999999999999|unique:tb_kk,id_kk',
            'alamat_klg' => 'required|min:3|max:100',
            'rt' => 'required|numeric|max:9999',
            'rw' => 'required|numeric|max:9999',
        ], [
            // PESAN ERROR
            'no_kk.min' => 'Nomor KK Harus Memiliki 16 Angka!',
            'no_kk.unique' => 'Nomor KK Sudah Tersedia!',
            'alamat_klg.min' => 'Alamat Keluarga Minimal 3 Karakter!',
            'alamat_klg.max' => 'Alamat Keluarga Maksimal 100 Karakter!',
            'no_kk.numeric' => 'Nomor KK Harus Menggunakan Angka!',
            'rt.numeric' => 'Nomor RT Harus Menggunakan Angka!',
            'rw.numeric' => 'Nomor RW Harus Menggunakan Angka!',
        ]);

        Kk::where('id_kk', $kk->id_kk)
        ->update([
                'no_kk' => $request->no_kk,
                'alamat_klg' => $request->alamat_klg,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'updated_at' => now(),
    ]);
        return redirect('kk')->with('status', 'DATA KARTU KELUARGA BERHASIL DIUBAH!');
    }


    public function destroy(Kk $kk)
    {
        $kk->delete();
        return redirect('kk')->with('status', 'DATA KARTU KELUARGA BERHASIL HAPUS!');
    }
}
