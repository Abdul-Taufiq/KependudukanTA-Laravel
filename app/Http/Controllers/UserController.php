<?php

namespace App\Http\Controllers;

use PDF;
use DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {
    	$data = User::all();
        return view ('CRUD User.user', compact('data'), [
            "tittle" => "Data User"
        ],
        [
            'data'=>$data
        ]);
    }

    // CETAK DATA
    public function cetakdatauser()
    {
        $data = user::all()->sortBy('nama');
        $pdf = PDF::loadView('CRUD user.cetak-data-user', ['cetakdatauser' => $data]);
        return $pdf->setPaper('A4','landscape')
                    ->stream('laporan-data-user.pdf');

    }    

    // CETAK Pertanggal
    public function cetakpertanggal($tglawal, $tglakhir)
    {
        $tgl1 = $tglawal;
        $tgl2 = $tglakhir;
        $dateawal = Carbon::createFromFormat('d-m-Y', $tglawal)->format('Y-m-d');
        $dateakhir = Carbon::createFromFormat('d-m-Y', $tglakhir)->format('Y-m-d');

        if ( strtotime($tglakhir) < strtotime($tglawal) ) {
             return redirect('user')->with('statuserror', 'GAGAL MENCETAK LAPORAN, PASTIKAN TANGGAL AKHIR LEBIH BESAR DARI TANGGAL AWAL!');
        }
        // dd(["Tanggal Awal : ".$tglawal, "Tanggal Akhir : ".$tglakhir]);
        $cetakpertanggal = DB::table('users')->whereBetween('created_at',[$dateawal, $dateakhir])->get()->sortBy('nama');
        $pdf = PDF::loadView('CRUD user.cetak-data-user-pertanggal', 
            ['cetakpertanggal' => $cetakpertanggal, 'tgl1' => $tgl1, 'tgl2' => $tgl2]);
        return $pdf->setPaper('A4','landscape')
                    ->stream('laporan-data-user-pertanggal.pdf');
    }


    public function create()
    {
        return view ('CRUD user.adduser', [
            "tittle" => "Tambah Data User"
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
            'name' => ['required', 'string', 'max:255', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
           // PESAN ERROR
            'name.min' => 'Nama Minimal 2 Karakter!',
            'name.max' => 'Nama Maksimal 255 Karakter!',
            'email.email' => 'Email Yang Anda Masukan Tidak Valid!',
            'email.unique' => 'Email Tidak Bisa Digunakan!',
            'password.min' => 'Password Minimal 8 Karakter!',
            'password.confirmed' => 'Konfirmasi Password Tidak Cocok!',
        ]);

       DB::table('users')
        ->insert([
            'name' => $request['name'],
            'email' => $request['email'],
            // menggunakan enkripsi jenis BCrypt
            'password' => Hash::make($request['password']),
            'created_at' => now(),
            // menggunakan md5
            // 'password' => md5($data['password']),
        ]);

        return redirect('user')->with('status', 'DATA USER BERHASIL DITAMBAH!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $user = DB::table('users')->where('id', $id)->first();
        // dd($user);
        return view ('CRUD user.updateuser', compact('user'),
            [
                "tittle" => "Edit Data user"
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // FORM VALIDASI
       $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
           // PESAN ERROR
            'name.min' => 'Nama Minimal 2 Karakter!',
            'name.max' => 'Nama Maksimal 255 Karakter!',
            'email.email' => 'Email Yang Anda Masukan Tidak Valid!',
            'email.unique' => 'Email Tidak Bisa Digunakan!',
            'password.min' => 'Password Minimal 8 Karakter!',
            'password.confirmed' => 'Konfirmasi Password Tidak Cocok!',
        ]);

        DB::table('users')->where('id', $id)
        ->update([
            'name' => $request['name'],
            'email' => $request['email'],
            // menggunakan enkripsi jenis BCrypt
            'password' => Hash::make($request['password']),
            'updated_at' => now(),
            // menggunakan md5
            // 'password' => md5($data['password']),
        ]);


        return redirect('user')->with('status', 'DATA USER BERHASIL DIUBAH!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect('user')->with('status', 'DATA USER BERHASIL DIHAPUS!');
    }

}
