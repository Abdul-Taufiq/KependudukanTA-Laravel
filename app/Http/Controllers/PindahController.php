<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Pindah;
use Illuminate\Http\Request;

class PindahController extends Controller
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
        $data = Pindah::all();
        return view('CRUD Pindah.Pindah',compact('data'), [
            'tittle' => 'Data Pindah'
        ],
        [
            'data'=>$data
        ]);
    }

    // CETAK DATA
    public function cetakdatapindah()
    {
        $data = Pindah::all()->sortBy('no_pindah');
        $pdf = PDF::loadView('CRUD pindah.cetak-data-pindah', ['cetakdatapindah' => $data]);
        return $pdf->stream('laporan-data-pindah.pdf');

    }

    // CETAK DETAIL
    public function cetakdetaildatapindah(Pindah $pindah)
    {
         // $data = pindah::with('penduduk')->find($pindah);
       $pdf = PDF::loadView('CRUD pindah.cetak-detail-data-pindah', compact('pindah'));
       return $pdf->stream('laporan-detail-data-pindah.pdf');
    }    

     // CETAK Pertanggal
    public function cetakpertanggal($tglawal, $tglakhir)
    {
        $tgl1 = $tglawal;
        $tgl2 = $tglakhir;
        $dateawal = Carbon::createFromFormat('d-m-Y', $tglawal)->format('Y-m-d');
        $dateakhir = Carbon::createFromFormat('d-m-Y', $tglakhir)->format('Y-m-d');

        if ( strtotime($tglakhir) < strtotime($tglawal) ) {
             return redirect('pindah')->with('statuserror', 'GAGAL MENCETAK LAPORAN, PASTIKAN TANGGAL AKHIR LEBIH BESAR DARI TANGGAL AWAL!');
        }
        // dd(["Tanggal Awal : ".$tglawal, "Tanggal Akhir : ".$tglakhir]);
        $cetakpertanggal = Pindah::with('penduduk')->whereBetween('tgl_pindah',[$dateawal, $dateakhir])->get()->sortBy('no_pindah');
        // return view('CRUD pindah.cetakdatapindah-pertanggal',  compact('cetakpertanggal'));
        $pdf = PDF::loadView('CRUD Pindah.cetak-data-pindah-pertanggal', 
            ['cetakpertanggal' => $cetakpertanggal, 'tgl1' => $tgl1, 'tgl2' => $tgl2]);
        return $pdf->stream('laporan-datapindah-pertanggal.pdf');
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
        $cek = pindah::count();
        if ($cek == 0) {
            $urut = 10001;
            $nomer = 'KL'.$urut;
        
        } else {
            $ambil = pindah::all()->last();
            $urut = (int)substr($ambil->no_pindah, 7) + 1;
            $nomer = 'PN'.$thn.$urut;
        }

        return view('CRUD Pindah.addpindah',compact('nomer'), [
            "tittle" => "Tambah Data Pindah"
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
            'no_pindah' => 'required|min:3|unique:tb_pindah',
            'tgl_pindah' => 'required',
            'alamat_lama' => 'required|max:200|min:2',
            'alamat_baru' => 'required|min:2|max:200',
            'alasan' => 'required|min:1|max:200',
        ], [
            // PESAN ERROR
            'no_pindah.min' => 'Nomor pindah Harus Memiliki Minimal 3 Karakter!',
            'no_pindah.unique' => 'Nomor pindah Sudah Tersedia!',
            'tgl_pindah.required' => 'Kolom Tidak Boleh Kosong!',
            'alamat_lama.max' => 'Kolom Maksimal 200 Karakter!',
            'alamat_lama.min' => 'Kolom Minimal 2 Karakter!',
            'alamat_baru.required' => 'Kolom Tidak Boleh Kosong!',
            'alamat_baru.min' => 'Kolom Minimal 2 Karakter!',
            'alamat_baru.max' => 'Kolom Maksimal 200 Karakter!',
            'alasan.max' => 'Kolom Maksimal 200 Karakter!',
            'alasan.min' => 'alasan Minimal 1 Karakter!'
        ]);

        $pindah = new Pindah;
        $pindah->no_pindah = $request->no_pindah ;
        $pindah->tgl_pindah =  Carbon::createFromFormat('d-m-Y', $request->tgl_pindah)->format('Y-m-d');
        $pindah->alamat_lama = $request->alamat_lama ;
        $pindah->alamat_baru = $request->alamat_baru ;
        $pindah->alasan = $request->alasan ;
        $pindah->created_at = now() ;
        $pindah->save();

        // \DB::table('tb_pindah')->insert([
        //     'no_pindah' => $request -> no_pindah ,
        //     'tgl_pindah' => $request -> tgl_pindah ,
        //     'alamat_lama' => $request -> alamat_lama ,
        //     'alamat_baru' => $request -> alamat_baru,
        //     'alasan' => $request -> alasan ,
        //     'created_at' => now(),
        // ]);
        return redirect('pindah')->with('status', 'DATA PINDAH BERHASIL DITAMBAH!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pindah  $pindah
     * @return \Illuminate\Http\Response
     */
    public function show(Pindah $pindah)
    {
        return view ('CRUD Pindah.detailpindah', compact('pindah'),
        [
            "tittle" => "Detail Data Pindah"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pindah  $pindah
     * @return \Illuminate\Http\Response
     */
    public function edit(Pindah $pindah)
    {
        $data = Pindah::all();
        return view ('CRUD Pindah.updatepindah', compact('pindah', 'data'),
        [
            "tittle" => "Edit Data Pindah"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pindah  $pindah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pindah $pindah)
    {
        // FORM VALIDASI
        $request->validate([
            'no_pindah' => 'required|min:3|unique:tb_pindah,id_pindah',
            'tgl_pindah' => 'required',
            'alamat_lama' => 'required|max:200|min:2',
            'alamat_baru' => 'required|min:2|max:200',
            'alasan' => 'required|min:1|max:200',
        ], [
            // PESAN ERROR
            'no_pindah.min' => 'Nomor pindah Harus Memiliki Minimal 3 Karakter!',
            'no_pindah.unique' => 'Nomor pindah Sudah Tersedia!',
            'tgl_pindah.required' => 'Kolom Tidak Boleh Kosong!',
            'alamat_lama.max' => 'Kolom Maksimal 200 Karakter!',
            'alamat_lama.min' => 'Kolom Minimal 2 Karakter!',
            'alamat_baru.required' => 'Kolom Tidak Boleh Kosong!',
            'alamat_baru.min' => 'Kolom Minimal 2 Karakter!',
            'alamat_baru.max' => 'Kolom Maksimal 200 Karakter!',
            'alasan.max' => 'Kolom Maksimal 200 Karakter!',
            'alasan.min' => 'alasan Minimal 1 Karakter!'
        ]);

        $pindah->no_pindah = $request->no_pindah ;
        $pindah->tgl_pindah =  Carbon::createFromFormat('d-m-Y', $request->tgl_pindah)->format('Y-m-d');
        $pindah->alamat_lama = $request->alamat_lama ;
        $pindah->alamat_baru = $request->alamat_baru ;
        $pindah->alasan = $request->alasan ;
        $pindah->updated_at = now() ;
        $pindah->save();

        // Pindah::where('id_pindah', $pindah->id_pindah)
        // ->update([
        //     'no_pindah' => $request -> no_pindah ,
        //     'tgl_pindah' => $request -> tgl_pindah ,
        //     'alamat_lama' => $request -> alamat_lama ,
        //     'alamat_baru' => $request -> alamat_baru,
        //     'alasan' => $request -> alasan,
        //     'updated_at' => now(),
        // ]);
        return redirect('pindah')->with('status', 'DATA PINDAH BERHASIL DIUBAH!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pindah  $pindah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pindah $pindah)
    {
        $pindah->delete();
        return redirect('pindah')->with('status', 'DATA PINDAH BERHASIL HAPUS!');
    }
}
