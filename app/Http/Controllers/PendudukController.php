<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Penduduk;
use App\Models\Kelahiran;
use App\Models\Kematian;
use App\Models\Datang;
use App\Models\Pindah;
use App\Models\Kk;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PendudukController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

     public function indexnyoba()
    {
        $data = Penduduk::get();
        // $penduduks = Penduduk::limit(10)->get();
        // return $penduduks;
        

        if (request()->ajax()) {
            return DataTables()->of($data)->toJson();
        }
        return view ('CRUD Penduduk.penduduk-nyoba', compact('data'),
        [
            "tittle" => "Data Warga"
        ],
        [
            // 'data'=>$data
        ]);
    }
    
    public function index()
    {
        $penduduks = Penduduk::all();
        // $penduduks = Penduduk::limit(10)->get();
        // return $penduduks;
        return view ('CRUD Penduduk.penduduk', compact('penduduks'),
        [
            "tittle" => "Data Warga"
        ],
        [
            // 'data'=>$data
        ]);
    }


    // CETAK DATA
    public function cetakdatapenduduk()
    {
        $data = Penduduk::all()->sortBy('nama');
        // return view(('CRUD Penduduk.cetak-data-penduduk',)
        $pdf = PDF::loadView('CRUD Penduduk.cetak-data-penduduk', ['cetakdatapenduduk' => $data]);
        return $pdf->setPaper('A2','landscape')
                    ->stream('laporan-data-penduduk.pdf');

    }    

    // CETAK DETAIL
    public function cetakdetaildatapenduduk(Penduduk $penduduk)
    {
         // $data = Penduduk::with('penduduk')->find($Penduduk);
       $pdf = PDF::loadView('CRUD Penduduk.cetak-detail-data-penduduk', compact('penduduk'));
       return $pdf->stream('laporan-detail-data-penduduk.pdf');
    }

    // CETAK Pertanggal
    public function cetakpertanggal($tglawal, $tglakhir)
    {
        $tgl1 = $tglawal;
        $tgl2 = $tglakhir;
        $dateawal = Carbon::createFromFormat('d-m-Y', $tglawal)->format('Y-m-d');
        $dateakhir = Carbon::createFromFormat('d-m-Y', $tglakhir)->format('Y-m-d');

        if ( strtotime($tglakhir) < strtotime($tglawal) ) {
             return redirect('penduduk')->with('statuserror', 'GAGAL MENCETAK LAPORAN, PASTIKAN TANGGAL AKHIR LEBIH BESAR DARI TANGGAL AWAL!');
        }
        // dd(["Tanggal Awal : ".$tglawal, "Tanggal Akhir : ".$tglakhir]);
        $cetakpertanggal = Penduduk::with('kk')->whereBetween('tgl_lahir',[$dateawal, $dateakhir])->get()->sortBy('nama');
        $pdf = PDF::loadView('CRUD Penduduk.cetak-data-penduduk-pertanggal', 
            ['cetakpertanggal' => $cetakpertanggal, 'tgl1' => $tgl1, 'tgl2' => $tgl2]);
        return $pdf->setPaper('A2','landscape')
                    ->stream('laporan-data-penduduk-pertanggal.pdf');
    }

    
    public function create()
    {
        $kk = Kk::all();
        $kelahiran = Kelahiran::all();
        $kematian = Kematian::all();
        $pindah = Pindah::all();
        $datang = Datang::all();
        return view ('CRUD Penduduk.addpenduduk', compact('kk','kelahiran', 'kematian', 'pindah', 'datang'), [
            "tittle" => "Tambah Data Penduduk"
      ]);
    
    }

   
    public function store(Request $request)
    {
        // return $request;
      // FORM VALIDASI
        $request->validate([
            'nik' => 'numeric|min:1111111111111111|max:99999999999999999|unique:tb_penduduk',
            'nama' => 'max:200',
            'tempat_lahir' => 'max:15',
            'pekerjaan' => 'max:20',
            'alamat' => 'max:25',
            'rt' => 'numeric|max:9999',
            'rw' => 'numeric|max:9999',
            'kelurahan' => 'max:15',
            'kecamatan' => 'max:15',
            'kewarganegaraan' => 'max:15',
            'keterangan' => 'max:50',
        ], [
            // PESAN ERROR
            'nik.min' => 'Nomor Induk Kependudukan Harus Memiliki 16 Angka!',
            'nik.unique' => 'Nomor Induk Kependudukan Sudah Tersedia!',
            'nik.numeric' => 'Nomor Induk Kependudukan Harus Menggunakan Angka!',
            'nama.max' => 'Nama Melebihi Batasan Maksimal!',
            'tempat_lahir.max' => 'Tempat Lahir Melebihi Batasan Maksimal!',
            'pekerjaan.max' => 'Pekerjaan Melebihi Batasan Maksimal!',
            'alamat.min' => 'Alamat Keluarga Minimal 3 Karakter!',
            'alamat.max' => 'Alamat Keluarga Maksimal 100 Karakter!',
            'rt.numeric' => 'Nomor RT Harus Menggunakan Angka!',
            'rw.numeric' => 'Nomor RW Harus Menggunakan Angka!',
            'kelurahan.max' => 'Kelurahan Melebihi Batasan Maksimal!',
            'kecamatan.max' => 'Kecamatan Melebihi Batasan Maksimal!',
            'kewarganegaraan.max' => 'Kewarganegaraan Melebihi Batasan Maksimal!',
            'keterangan.max' => 'Keterangan Melebihi Batasan Maksimal!'
        ]);

        $penduduk = new Penduduk;
        $penduduk->id_kk = $request->id_kk ;
        $penduduk->id_kelahiran = $request->id_kelahiran ;
        $penduduk->id_kematian = $request->id_kematian ;
        $penduduk->id_datang = $request->id_datang ;
        $penduduk->id_pindah = $request->id_pindah ;
        $penduduk->nik = $request->nik ;
        $penduduk->nama = $request->nama ;
        $penduduk->jns_kelamin = $request->jns_kelamin ;
        $penduduk->tempat_lahir = $request->tempat_lahir ;
        $penduduk->tgl_lahir =  Carbon::createFromFormat('d-m-Y', $request->tgl_lahir)->format('Y-m-d');
        $penduduk->agama = $request->agama ;
        $penduduk->pendidikan = $request->pendidikan ;
        $penduduk->goldar = $request->goldar ;
        $penduduk->pekerjaan = $request->pekerjaan ;
        $penduduk->status_perkawinan = $request->status_perkawinan ;
        $penduduk->alamat = $request->alamat ;
        $penduduk->rt = $request->rt ;
        $penduduk->rw = $request->rw ;
        $penduduk->kelurahan = $request->kelurahan ;
        $penduduk->kecamatan = $request->kecamatan ;
        $penduduk->kewarganegaraan = $request->kewarganegaraan ;
        $penduduk->status_pada_keluarga = $request->status_pada_keluarga ;
        $penduduk->status_warga = $request->status_warga ;
        $penduduk->keterangan = $request->keterangan ;
        $penduduk->created_at = now() ;
        $penduduk->save();

        // $data = $request->all();
        // $data['tgl_lahir'] = Carbon::createFromFormat('d-m-Y', $request->tgl_lahir)->format('Y-m-d');
        // $penduduk  = Penduduk::create($data);

        return redirect('penduduk')->with('status', 'DATA PENDUDUK BERHASIL DITAMBAH!');

    }

    
    public function show(Penduduk $penduduk)
    {
        $kk = Kk::all();
        $kelahiran = Kelahiran::all();
        $kematian = Kematian::all();
        $pindah = Pindah::all();
        $datang = Datang::all();
        $data = Penduduk::all();
        return view ('CRUD Penduduk.detailpenduduk', compact('penduduk', 'data','kk','kelahiran', 'kematian', 'pindah', 'datang'),
        [
            "tittle" => "Detail Data Penduduk"
        ]);
    }

   
    public function edit(Penduduk $penduduk)
    {
        $kk = Kk::all();
        $kelahiran = Kelahiran::all();
        $kematian = Kematian::all();
        $pindah = Pindah::all();
        $datang = Datang::all();
        $data = Penduduk::all();
        return view ('CRUD Penduduk.updatependuduk', compact('penduduk', 'data','kk','kelahiran', 'kematian', 'pindah', 'datang'),
        [
            "tittle" => "Edit Data Penduduk"
        ]);
    }

   
    public function update(Request $request, Penduduk $penduduk)
    {
         // FORM VALIDASI
        $request->validate([
            'nik' => 'numeric|min:1111111111111111|max:99999999999999999|unique:tb_penduduk,id_penduduk',
            'nama' => 'max:200',
            'tempat_lahir' => 'max:15',
            'pekerjaan' => 'max:20',
            'alamat' => 'max:25',
            'rt' => 'numeric|max:9999',
            'rw' => 'numeric|max:9999',
            'kelurahan' => 'max:15',
            'kecamatan' => 'max:15',
            'kewarganegaraan' => 'max:15',
            'keterangan' => 'max:50',
        ], [
            // PESAN ERROR
            'nik.min' => 'Nomor KK Harus Memiliki 16 Angka!',
            'nik.unique' => 'Nomor KK Sudah Tersedia!',
            'nik.numeric' => 'Nomor KK Harus Menggunakan Angka!',
            'nama.max' => 'Nama Melebihi Batasan Maksimal!',
            'tempat_lahir.max' => 'Tempat Lahir Melebihi Batasan Maksimal!',
            'pekerjaan.max' => 'Pekerjaan Melebihi Batasan Maksimal!',
            'alamat.min' => 'Alamat Keluarga Minimal 3 Karakter!',
            'alamat.max' => 'Alamat Keluarga Maksimal 100 Karakter!',
            'rt.numeric' => 'Nomor RT Harus Menggunakan Angka!',
            'rw.numeric' => 'Nomor RW Harus Menggunakan Angka!',
            'kelurahan.max' => 'Kelurahan Melebihi Batasan Maksimal!',
            'kecamatan.max' => 'Kecamatan Melebihi Batasan Maksimal!',
            'kewarganegaraan.max' => 'Kewarganegaraan Melebihi Batasan Maksimal!',
            'keterangan.max' => 'Keterangan Melebihi Batasan Maksimal!'
        ]);

        $penduduk->id_kk = $request->id_kk ;
        $penduduk->id_kelahiran = $request->id_kelahiran ;
        $penduduk->id_kematian = $request->id_kematian ;
        $penduduk->id_datang = $request->id_datang ;
        $penduduk->id_pindah = $request->id_pindah ;
        $penduduk->nik = $request->nik ;
        $penduduk->nama = $request->nama ;
        $penduduk->jns_kelamin = $request->jns_kelamin ;
        $penduduk->tempat_lahir = $request->tempat_lahir ;
        $penduduk->tgl_lahir =  Carbon::createFromFormat('d-m-Y', $request->tgl_lahir)->format('Y-m-d');
        $penduduk->agama = $request->agama ;
        $penduduk->pendidikan = $request->pendidikan ;
        $penduduk->goldar = $request->goldar ;
        $penduduk->pekerjaan = $request->pekerjaan ;
        $penduduk->status_perkawinan = $request->status_perkawinan ;
        $penduduk->alamat = $request->alamat ;
        $penduduk->rt = $request->rt ;
        $penduduk->rw = $request->rw ;
        $penduduk->kelurahan = $request->kelurahan ;
        $penduduk->kecamatan = $request->kecamatan ;
        $penduduk->kewarganegaraan = $request->kewarganegaraan ;
        $penduduk->status_pada_keluarga = $request->status_pada_keluarga ;
        $penduduk->status_warga = $request->status_warga ;
        $penduduk->keterangan = $request->keterangan ;
        $penduduk->updated_at = now() ;
        $penduduk->save();

         return redirect('penduduk')->with('status', 'DATA PENDUDUK BERHASIL DIUBAH!');
    }

   
    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();
        return redirect('penduduk')->with('status', 'DATA PENDUDUK BERHASIL DIHAPUS!');
    }

    public function json()
    {
        return DataTables::of(Penduduk::limit(5))->make(true);
    }
}
