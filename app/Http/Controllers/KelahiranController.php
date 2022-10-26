<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use App\Models\Kelahiran;
use App\Models\Penduduk;

class KelahiranController extends Controller
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
        $data = Kelahiran::all();
        return view ('CRUD Kelahiran.kelahiran', [
             'data'=>$data   
        ],
        [
           "tittle" => "Data Kelahiran"
        ]);
    }

    // CETAK DATA
    public function cetakdatakelahiran()
    {
        $data = Kelahiran::all()->sortBy('no_kelahiran');
        $pdf = PDF::loadView('CRUD Kelahiran.cetak-data-kelahiran', ['cetakdatakelahiran' => $data]);
        return $pdf->stream('laporan-data-kelahiran.pdf');

    }

    // CETAK DETAIL
    public function cetakdetaildatakelahiran(Kelahiran $kelahiran)
    {
         // $data = kelahiran::with('penduduk')->find($kelahiran);
       $pdf = PDF::loadView('CRUD Kelahiran.cetak-detail-data-kelahiran', compact('kelahiran'));
       return $pdf->stream('laporan-detail-data-kelahiran.pdf');
    }

     // CETAK Pertanggal
    public function cetakpertanggal($tglawal, $tglakhir)
    {
        $tgl1 = $tglawal;
        $tgl2 = $tglakhir;
        $dateawal = Carbon::createFromFormat('d-m-Y', $tglawal)->format('Y-m-d');
        $dateakhir = Carbon::createFromFormat('d-m-Y', $tglakhir)->format('Y-m-d');

        if ( strtotime($tglakhir) < strtotime($tglawal) ) {
             return redirect('kelahiran')->with('statuserror', 'GAGAL MENCETAK LAPORAN, PASTIKAN TANGGAL AKHIR LEBIH BESAR DARI TANGGAL AWAL!');
        }
        // dd(["Tanggal Awal : ".$tglawal, "Tanggal Akhir : ".$tglakhir]);
        $cetakpertanggal = Kelahiran::with('penduduk')->whereBetween('created_at',[$dateawal, $dateakhir])->get()->sortBy('no_kelahiran');
        // return view('CRUD Kelahiran.cetakdataKelahiran-pertanggal',  compact('cetakpertanggal'));
        $pdf = PDF::loadView('CRUD Kelahiran.cetak-data-kelahiran-pertanggal', 
            ['cetakpertanggal' => $cetakpertanggal, 'tgl1' => $tgl1, 'tgl2' => $tgl2]);
        return $pdf->stream('laporan-datakelahiran-pertanggal.pdf');
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penduduk = Penduduk::all();

        // KL2022-
        $now = Carbon::now();
        $thn = $now->year;
        $cek = Kelahiran::count();
        if ($cek == 0) {
            $urut = 10001;
            $nomer = 'KL'.$urut;
        
        } else {
            $ambil = Kelahiran::all()->last();
            $urut = (int)substr($ambil->no_kelahiran, 6) + 1;
            $nomer = 'KL'.$thn.$urut;
        }


        return view('CRUD Kelahiran.addkelahiran', compact('penduduk', 'nomer'), [
            "tittle" => "Tambah Data Kelahiran"
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
            'no_kelahiran' => 'required|min:3|unique:tb_kelahiran',
            'ayah' => 'required|min:2',
            'ibu' => 'required|min:2',
            'anak_ke' => 'required|numeric|min:1|max:9999',
            'penolong' => 'required|min:2',
        ], [
            // PESAN ERROR
            'no_kelahiran.min' => 'Nomor Kelahiran Harus Memiliki 3 Karakter!',
            'no_kelahiran.unique' => 'Nomor Kelahiran Sudah Tersedia!',
            'ayah.min' => 'Nama Ayah Minimal 2 Karakter!',
            'ayah.required' => 'Nama Ayah Tidak Boleh Kosong!',
            'ibu.min' => 'Nama Ibu Minimal 2 Karakter!',
            'anak_ke.required' => 'Kolom Tidak Boleh Kosong!',
            'anak_ke.numeric' => 'Kolom Harus Menggunakan Angka!',
            'anak_ke.min' => 'Kolom Minimal Angka 1!',
            'anak_ke.max' => 'Kolom Maksimal angka 9999!',
            'penolong.min' => 'Penolong Minimal 2 Karakter!'
        ]);

        \DB::table('tb_kelahiran')->insert([
            'no_kelahiran' => $request -> no_kelahiran ,
            'ayah' => $request -> ayah ,
            'ibu' => $request -> ibu ,
            'anak_ke' => $request -> anak_ke,
            'penolong' => $request -> penolong ,
            'created_at' => now(),
        ]);
        return redirect('kelahiran')->with('status', 'DATA KELAHIRAN BERHASIL DITAMBAH!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kelahiran $kelahiran)
    {
        // $penduduk = Penduduk::all();
        // $data = Kelahiran::all();
        return view ('CRUD Kelahiran.detailkelahiran', compact('kelahiran'),
        [
            "tittle" => "Detail Data Kelahiran"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelahiran $kelahiran)
    {
        $penduduk = Penduduk::all();
        $data = Kelahiran::all();
        return view ('CRUD Kelahiran.updatekelahiran', compact('kelahiran', 'penduduk', 'data'),
        [
            "tittle" => "Edit Data Kelahiran"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelahiran $kelahiran)
    {
        // FORM VALIDASI
        $request->validate([
            'no_kelahiran' => 'required|min:3|unique:tb_kelahiran,id_kelahiran',
            'ayah' => 'required',
            'ibu' => 'required',
            'anak_ke' => 'required|numeric|min:1|max:9999',
            'penolong' => 'required|min:2',
        ], [
            // PESAN ERROR
            'no_kelahiran.min' => 'Nomor Kelahiran Harus Memiliki 3 Karakter!',
            'no_kelahiran.unique' => 'Nomor Kelahiran Sudah Tersedia!',
            'ayah.required' => 'Nama Ayah Tidak Boleh Kosong!',
            'ibu.required' => 'Nama Ibu Tidak Boleh Kosong!',
            'anak_ke.required' => 'Kolom Tidak Boleh Kosong!',
            'anak_ke.numeric' => 'Kolom Harus Menggunakan Angka!',
            'anak_ke.min' => 'Kolom Minimal Angka 1!',
            'anak_ke.max' => 'Kolom Maksimal angka 9999!',
            'penolong.min' => 'Penolong Minimal 2 Karakter!'
        ]);

        Kelahiran::where('id_kelahiran', $kelahiran->id_kelahiran)
        ->update([
                'no_kelahiran' => $request -> no_kelahiran ,
                'ayah' => $request -> ayah ,
                'ibu' => $request -> ibu ,
                'anak_ke' => $request -> anak_ke,
                'penolong' => $request -> penolong ,
                'updated_at' => now(),
        ]);
        return redirect('kelahiran')->with('status', 'DATA KELAHIRAN BERHASIL DIUBAH!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelahiran $kelahiran)
    {
        $kelahiran->delete();
        return redirect('kelahiran')->with('status', 'DATA KELAHIRAN BERHASIL HAPUS!');
    }
}
