<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Datang;
use App\Models\Pindah;
use App\Models\Kk;
use App\Models\Kelahiran;
use App\Models\Kematian;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Penduduk = Penduduk::all(); 
        $Datang = Datang::all();
        $Pindah = Pindah::all();
        $Kk = Kk::all();
        $Kelahiran = Kelahiran::all();
        $Kematian = Kematian::all();
        $User = User::all();
        return view('home', compact('Penduduk', 'Datang', 'Pindah', 'Kk', 'Kelahiran', 'Kematian', 'User'),[
            "tittle" => "Dashboard"
        ]);
    }
}
