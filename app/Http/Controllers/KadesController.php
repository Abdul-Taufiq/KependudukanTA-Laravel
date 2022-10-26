<?php

namespace App\Http\Controllers;

use PDF;
use DB;
use Carbon\Carbon;
use App\Models\Kades;
use Illuminate\Http\Request;

class KadesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function index()
    {
        $data = Kades::all();
        return view ('CRUD Kades.Kades', compact('data'), [
            "tittle" => "Data Kades"
        ],
        [
            'data'=>$data
        ]);
    }

    // CETAK DATA
    public function cetakdatakades()
    {
        $data = Kades::all()->sortBy('nama');
        $pdf = PDF::loadView('CRUD Kades.cetak-data-kades', ['cetakdatakades' => $data]);
        return $pdf->setPaper('A4','landscape')
                    ->stream('laporan-data-kades.pdf');

    }    

    // CETAK Pertanggal
    public function cetakpertanggal($tglawal, $tglakhir)
    {
        $tgl1 = $tglawal;
        $tgl2 = $tglakhir;
        $dateawal = Carbon::createFromFormat('d-m-Y', $tglawal)->format('Y-m-d');
        $dateakhir = Carbon::createFromFormat('d-m-Y', $tglakhir)->format('Y-m-d');

        if ( strtotime($tglakhir) < strtotime($tglawal) ) {
             return redirect('kades')->with('statuserror', 'GAGAL MENCETAK LAPORAN, PASTIKAN TANGGAL AKHIR LEBIH BESAR DARI TANGGAL AWAL!');
        }
        // dd(["Tanggal Awal : ".$tglawal, "Tanggal Akhir : ".$tglakhir]);
        $cetakpertanggal = DB::table('tb_kades')->whereBetween('tgl_lahir',[$dateawal, $dateakhir])->get()->sortBy('nama');
        $pdf = PDF::loadView('CRUD Kades.cetak-data-kades-pertanggal', 
            ['cetakpertanggal' => $cetakpertanggal, 'tgl1' => $tgl1, 'tgl2' => $tgl2]);
        return $pdf->setPaper('A4','landscape')
                    ->stream('laporan-data-kades-pertanggal.pdf');
    }


    public function create()
    {
        return view ('CRUD Kades.addkades', [
            "tittle" => "Tambah Data Kades"
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
            'nik' => 'numeric|min:1111111111111111|max:99999999999999999|unique:tb_kades',
            'nip' => 'numeric|min:1111111111111111|max:99999999999999999|unique:tb_kades',
            'nama' => 'max:200',
            'alamat' => 'max:100',
            'tempat_lahir' => 'max:15',
            'pekerjaan' => 'max:20',
            'alamat' => 'max:25',
            'rt' => 'numeric|max:9999',
            'rw' => 'numeric|max:9999',
        ], [
            // PESAN ERROR
            'nik.min' => 'Nomor NIK Harus Memiliki 16 Angka!',
            'nik.unique' => 'Nomor NIK Sudah Tersedia!',
            'nik.numeric' => 'Nomor NIK Harus Menggunakan Angka!',
            'nip.min' => 'Nomor NIP Harus Memiliki 16 Angka!',
            'nip.unique' => 'Nomor NIP Sudah Tersedia!',
            'nip.numeric' => 'Nomor NIP Harus Menggunakan Angka!',
            'nama.max' => 'Nama Melebihi Batasan Maksimal!',
            'alamat.max' => 'Alamat Melebihi Batasan Maksimal!',
            'tempat_lahir.max' => 'Tempat Lahir Melebihi Batasan Maksimal!',
            'pekerjaan.max' => 'Pekerjaan Melebihi Batasan Maksimal!',
            'alamat.min' => 'Alamat Keluarga Minimal 3 Karakter!',
            'alamat.max' => 'Alamat Keluarga Maksimal 100 Karakter!',
        ]);

        $kades = new Kades;
        $kades->nik = $request->nik ;
        $kades->nip = $request->nip ;
        $kades->nama = $request->nama ;
        $kades->jabatan = $request->jabatan ;
        $kades->alamat = $request->alamat ;
        $kades->jns_kelamin = $request->jns_kelamin ;
        $kades->tempat_lahir = $request->tempat_lahir ;
        $kades->tgl_lahir =  Carbon::createFromFormat('d-m-Y', $request->tgl_lahir)->format('Y-m-d');
        $kades->agama = $request->agama ;
        $kades->pendidikan = $request->pendidikan ;
        $kades->created_at = now() ;
        $kades->save();

        return redirect('kades')->with('status', 'DATA KEPALA DESA BERHASIL DITAMBAH!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kades  $kades
     * @return \Illuminate\Http\Response
     */
    public function edit($id_kades)
    { 
        $kades = DB::table('tb_kades')->where('id_kades', $id_kades)->first();
        // dd($kades);
        return view ('CRUD Kades.updatekades', compact('kades'),
            [
                "tittle" => "Edit Data Kades"
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kades  $kades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_kades)
    {
        // FORM VALIDASI
        $request->validate([
            'nik' => 'numeric|min:1111111111111111|max:99999999999999999|unique:tb_kades,id_kades',
            'nip' => 'numeric|min:1111111111111111|max:99999999999999999|unique:tb_kades,id_kades',
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

        DB::table('tb_kades')->where('id_kades', $id_kades)
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


        return redirect('kades')->with('status', 'DATA KEPALA DESA BERHASIL DIUBAH!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kades  $kades
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_kades)
    {
        DB::table('tb_kades')->where('id_kades', $id_kades)->delete();
        return redirect('kades')->with('status', 'DATA KEPALA DESA BERHASIL DIHAPUS!');
    }
}