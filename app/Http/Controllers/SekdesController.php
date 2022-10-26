<?php

namespace App\Http\Controllers;

use PDF;
use DB;
use Carbon\Carbon;
use App\Models\Sekdes;
use Illuminate\Http\Request;

class sekdesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function index()
    {
        $data = Sekdes::all();
        return view ('CRUD Sekdes.Sekdes', compact('data'), [
            "tittle" => "Data Sekdes"
        ],
        [
            'data'=>$data
        ]);
    }

    // CETAK DATA
    public function cetakdatasekdes()
    {
        $data = Sekdes::all()->sortBy('nama');
        $pdf = PDF::loadView('CRUD Sekdes.cetak-data-sekdes', ['cetakdatasekdes' => $data]);
        return $pdf->setPaper('A4','landscape')
                    ->stream('laporan-data-sekdes.pdf');

    }    

    // CETAK Pertanggal
    public function cetakpertanggal($tglawal, $tglakhir)
    {
        $tgl1 = $tglawal;
        $tgl2 = $tglakhir;
        $dateawal = Carbon::createFromFormat('d-m-Y', $tglawal)->format('Y-m-d');
        $dateakhir = Carbon::createFromFormat('d-m-Y', $tglakhir)->format('Y-m-d');

        if ( strtotime($tglakhir) < strtotime($tglawal) ) {
             return redirect('sekdes')->with('statuserror', 'GAGAL MENCETAK LAPORAN, PASTIKAN TANGGAL AKHIR LEBIH BESAR DARI TANGGAL AWAL!');
        }
        // dd(["Tanggal Awal : ".$tglawal, "Tanggal Akhir : ".$tglakhir]);
        $cetakpertanggal = DB::table('tb_sekdes')->whereBetween('tgl_lahir',[$dateawal, $dateakhir])->get()->sortBy('nama');
        $pdf = PDF::loadView('CRUD Sekdes.cetak-data-sekdes-pertanggal', 
            ['cetakpertanggal' => $cetakpertanggal, 'tgl1' => $tgl1, 'tgl2' => $tgl2]);
        return $pdf->setPaper('A4','landscape')
                    ->stream('laporan-data-sekdes-pertanggal.pdf');
    }


    public function create()
    {
        return view ('CRUD Sekdes.addsekdes', [
            "tittle" => "Tambah Data Sekdes"
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
            'nik' => 'numeric|min:1111111111111111|max:99999999999999999|unique:tb_sekdes',
            'nip' => 'numeric|min:1111111111111111|max:99999999999999999|unique:tb_sekdes',
            'nama' => 'max:200',
            'alamat' => 'max:100',
            'tempat_lahir' => 'max:15',
            'pekerjaan' => 'max:20',
            'alamat' => 'max:25',
            'rt' => 'numeric|max:9999',
            'rw' => 'numeric|max:9999',
        ], [
            // PESAN ERROR
            'nik.min' => 'Nomor KK Harus Memiliki 16 Angka!',
            'nik.unique' => 'Nomor KK Sudah Tersedia!',
            'nik.numeric' => 'Nomor KK Harus Menggunakan Angka!',
            'nip.min' => 'Nomor KK Harus Memiliki 16 Angka!',
            'nip.unique' => 'Nomor KK Sudah Tersedia!',
            'nip.numeric' => 'Nomor KK Harus Menggunakan Angka!',
            'nama.max' => 'Nama Melebihi Batasan Maksimal!',
            'alamat.max' => 'Alamat Melebihi Batasan Maksimal!',
            'tempat_lahir.max' => 'Tempat Lahir Melebihi Batasan Maksimal!',
            'pekerjaan.max' => 'Pekerjaan Melebihi Batasan Maksimal!',
            'alamat.min' => 'Alamat Keluarga Minimal 3 Karakter!',
            'alamat.max' => 'Alamat Keluarga Maksimal 100 Karakter!',
        ]);

        $sekdes = new Sekdes;
        $sekdes->nik = $request->nik ;
        $sekdes->nip = $request->nip ;
        $sekdes->nama = $request->nama ;
        $sekdes->jabatan = $request->jabatan ;
        $sekdes->alamat = $request->alamat ;
        $sekdes->jns_kelamin = $request->jns_kelamin ;
        $sekdes->tempat_lahir = $request->tempat_lahir ;
        $sekdes->tgl_lahir =  Carbon::createFromFormat('d-m-Y', $request->tgl_lahir)->format('Y-m-d');
        $sekdes->agama = $request->agama ;
        $sekdes->pendidikan = $request->pendidikan ;
        $sekdes->created_at = now() ;
        $sekdes->save();

        return redirect('sekdes')->with('status', 'DATA SEKRETARIS DESA BERHASIL DITAMBAH!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sekdes  $sekdes
     * @return \Illuminate\Http\Response
     */
    public function edit($id_sekdes)
    { 
        $sekdes = DB::table('tb_sekdes')->where('id_sekdes', $id_sekdes)->first();
        // dd($sekdes);
        return view ('CRUD Sekdes.updatesekdes', compact('sekdes'),
            [
                "tittle" => "Edit Data Sekdes"
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sekdes  $sekdes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_sekdes)
    {
        // FORM VALIDASI
        $request->validate([
            'nik' => 'numeric|min:1111111111111111|max:99999999999999999|unique:tb_sekdes,id_sekdes',
            'nip' => 'numeric|min:1111111111111111|max:99999999999999999|unique:tb_sekdes,id_sekdes',
            'nama' => 'max:200',
            'alamat' => 'max:100',
            'tempat_lahir' => 'max:15',
            'pekerjaan' => 'max:20',
            'alamat' => 'max:25',
            'rt' => 'numeric|max:9999',
            'rw' => 'numeric|max:9999',
        ], [
            // PESAN ERROR
            'nik.min' => 'Nomor KK Harus Memiliki 16 Angka!',
            'nik.unique' => 'Nomor KK Sudah Tersedia!',
            'nik.numeric' => 'Nomor KK Harus Menggunakan Angka!',
            'nip.min' => 'Nomor KK Harus Memiliki 16 Angka!',
            'nip.unique' => 'Nomor KK Sudah Tersedia!',
            'nip.numeric' => 'Nomor KK Harus Menggunakan Angka!',
            'nama.max' => 'Nama Melebihi Batasan Maksimal!',
            'alamat.max' => 'Alamat Melebihi Batasan Maksimal!',
            'tempat_lahir.max' => 'Tempat Lahir Melebihi Batasan Maksimal!',
            'pekerjaan.max' => 'Pekerjaan Melebihi Batasan Maksimal!',
            'alamat.min' => 'Alamat Keluarga Minimal 3 Karakter!',
            'alamat.max' => 'Alamat Keluarga Maksimal 100 Karakter!',
        ]);

        DB::table('tb_sekdes')->where('id_sekdes', $id_sekdes)
        ->update([
            'nik' => $request -> nik ,
            'nip' => $request -> nip ,
            'nama' => $request -> nama ,
            'jabatan' => $request -> jabatan,
            'alamat' => $request -> alamat ,
            'jns_kelamin' => $request -> jns_kelamin ,
            'tempat_lahir' => $request -> tempat_lahir ,
            'tgl_lahir' => Carbon::createFromFormat('d-m-Y', $request->tgl_lahir)->format('Y-m-d'),
            'agama' => $request -> agama ,
            'pendidikan' => $request -> pendidikan ,
            'updated_at' => now(),
        ]);


        return redirect('sekdes')->with('status', 'DATA SEKRETARIS DESA BERHASIL DIUBAH!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sekdes  $sekdes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_sekdes)
    {
        DB::table('tb_sekdes')->where('id_sekdes', $id_sekdes)->delete();
        return redirect('sekdes')->with('status', 'DATA SEKRETARIS DESA BERHASIL DIHAPUS!');
    }
}