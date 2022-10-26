@extends('layout.main')

@section('konten')


<div class="container-fluid">

{{-- <input type="text" id="awal" class="datepicker" name="awal"/>
<input type="text" id="akhir"  class="datepicker" name="akhir" onchange="autofill()" />
<input type="text" name="umur" id="umur" disabled="">


<script type="text/javascript">
    function autofill() {
        var awal = $("#awal").val().replace(/-/g,'');
        var akhir = $("#akhir").val().replace(/-/g,'');
        // substr awal
        var dayAwal = Number(awal.substr(0, 2));
        var monthAwal = Number(awal.substr(2, 2));
        var yearAwal = Number(awal.substr(4, 4));
        // substr akhir
        var dayAkhir = Number(akhir.substr(0, 2));
        var monthAkhir = Number(akhir.substr(2, 2));
        var yearAkhir = Number(akhir.substr(4, 4));

        // var age = dayAkhir - dayAwal || monthAkhir - monthAwal || yearAkhir - yearAwal;

        // umur.value = age;   

        var age = yearAkhir - yearAwal;
        if (monthAkhir < monthAwal || monthAkhir == monthAwal && dayAkhir < dayAwal) {
            age--;
        }
        umur.value = age;  
        }
</script> --}}



                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <div class="row">

                        <!-- Penduduk -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Penduduk</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $Penduduk->count() }}  Data</div>
                                        </div>
                                        <div class="col-auto">
                                           <i class="fa fa-users fa-2x text-gray-300" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- KK -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Kartu Keluarga</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $Kk->count() }}  Data</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-address-card fa-2x text-gray-300" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kelahiean -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kelahiran
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $Kelahiran->count() }}  Data</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        	<i class="fa fa-id-badge fa-2x text-gray-300" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kematian -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Kematian</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $Kematian->count() }}  Data</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-user-times fa-2x text-gray-300" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pindah -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pindah</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $Pindah->count() }}  Data</div>
                                        </div>
                                        <div class="col-auto">
                                        	<i class="fa fa-angle-double-right fa-2x text-gray-300" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Datang -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                Datang</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $Datang->count() }}  Data</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-angle-double-left fa-2x text-gray-300" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- User -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-dark shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                User</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $User->count() }}  Data</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-lock fa-2x text-gray-300" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-15">

                            <!-- Collapsable Card Example -->
                            <div class="card shadow mb-10 ">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">Tentang Kelurahan Desa Ngilen</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample">
                                    <div class="card-body">
                                       Kantor Kelurahan Desa Ngilen merupakan salah satu instansi pemerintahan yang berkedudukan dibawah kecamatan yang bertugas sebagai pelaksana teknis kewilayahan yang memiliki wilayah kerja tertentu dan dipimpin oleh seorang Kepala Desa (Lurah). Kelurahan adalah perangkat kecamatan yang dibentuk untuk membantu atau melaksanakan sebagian tugas Camat, kelurahan mempunyai tugas menyelenggarakan urusan pemerintahan, pemberdayaan dan pelayanan. Kelurahan juga memiliki peran penting dalam menyediakan segala keperluan masyarakat dalam hal kependudukan, seperti pelayanan surat-menyurat antara lain: Surat Pengantar, Surat Keterangan, Surat Keterangan pembuatan KTP dan Surat Ijin Bepergian. Salah satu tugas Kantor Kelurahan Desa Ngilen adalah melakukan pendataan penduduk Desa Ngilen. Kelurahan juga memiliki peran penting dalam melakukakan pendataan penduduk, Pendataan penduduk dilakukan oleh Sekertaris Desa (Sekdes), pendataan penduduk yang meliputi, penduduk lahir, datang, pindah dan kematian serta kartu keluarga. 
                                    </div>
                                </div>
                            </div>
                            <hr class="sidebar-divider">
                             <!-- Collapsable Card Example -->
                            <div class="card shadow mb-10 ">
                                <!-- Card Header - Accordion -->
                                <a href="#alamat" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="alamat">
                                    <h6 class="m-0 font-weight-bold text-primary">Alamat Kantor Kelurahan Desa Ngilen</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="alamat">
                                    <div class="card-body">
                                       Kantor Kelurahan Desa Ngilen berlokasikan di Jl. Sumberwudi, Ngilen, Kunduran, Kabupaten Blora, Jawa Tengah. Tepatnya berada di Dusun Tempur, Desa Ngilen, Kecamatan Kunduran, Kabupaten Blora, Jawa Tengah. Link Alamat : <a href="https://www.google.com/maps/place/Kantor+Desa+Ngilen/@-7.0680529,111.225479,17z/data=!4m5!3m4!1s0x2e774e51a357b059:0x61a3642747a19699!8m2!3d-7.0680527!4d111.2289433" target="_blank">Kantor Kelurahan Desa Ngilen.</a> <br>
                                       <hr class="sidebar-divider">
                                       <img src="{{ asset('style/img/kantor kelurahan.png') }}" alt="logo" width="100%" >
                                    </div>
                                </div>
                            </div>
                            <hr class="sidebar-divider">
                             <div class="card shadow mb-10 ">
                                <!-- Card Header - Accordion -->
                                <a href="#struktur" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="struktur">
                                    <h6 class="m-0 font-weight-bold text-primary">Struktur Organisasi Kelurahan Desa Ngilen</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="struktur">
                                    <div class="card-body">
                                       Struktur Organisasi Desa Ngilen di pimpin oleh Kepala Desa sebagai pimpinan dan koordinator penyelenggaraan pemerintahan di wilayah kerja kelurahan selaku perangkat kecamatan yang memiliki kewenangan penuh dalam sistem, Sekretaris Desa memiliki tugas salah satunya adalah melakukan penyusunan dokumentasi serta mendata data penduduk Desa di Desa Ngilen yang dibantu oleh Kaur TU dan Umum serta Kaur Keuangan selain itu Kaur memiliki tugas membantu Sekertaris Desa dalam urusan pelayanan administrasi pendukung pelaksanaan tugas-tugas pemerintahan, Kemudian terdapat Kasi Pemerintahan, Kasi Kesejahtraan dan Kasi Pelayanan yang memiliki tugas salah satunya adalah menyusun program dan kegiatan pemerintahan dan pelayanan publik, kemudian Kadus memiliki tugas salah satunya adalah melakukan pembinaan ketentraman dan ketertiban, pelaksanaan upaya perlindungan masyarakat, mobilitas kependudukan, penataan dan pengelolahan wilayah serta mengawasi pelaksanaan pembangunan di wilayahnya. Berikut Struktur Organisasi Desa Ngilen : <br>
                                       <hr class="sidebar-divider">
                                       <img src="{{ asset('style/img/struktur.png') }}" alt="logo" width="100%" >
                                    </div>
                                </div>
                            </div>

                        <hr class="sidebar-divider">
                             <div class="card shadow mb-10 ">
                                <!-- Card Header - Accordion -->
                                <a href="#visimisi" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="visimisi">
                                    <h6 class="m-0 font-weight-bold text-primary">Visi & Misi Kelurahan Desa Ngilen</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="visimisi">
                                    <div class="card-body">
                                       <table border="1" style="width: 100%">
                                       	<tr>
                                       		<th style="width: 30%; text-align: center; background-color: aqua;">Visi</th>
                                       		<th style="width: 70%; text-align: center; background-color: aqua;">Misi</th>
                                       	</tr>
                                       	<tr>
                                       		<td style="padding: 4px;"> <p style="padding-left: 5px">Mewujudkan Kelurahan Desa Ngilen yang lebih maju dan sejahtera.</p></td>
                                       		<td style="padding: 4px;"><p style="padding-left: 5px">
                                       			1.	Meningkkatkan kualitas hidup masyarakat Desa Ngilen. <br>
												2.	Meningkatkan kualitas penyelenggaraan pemerintahan, pembangunan dan meningkatkkan pelayanan masyarakat di Desa Ngilen. <br>
												3.	Meningkatkan kuallitas Sumber Daya Manusia dan Aparatur. <br>
												4.	Meningkatkan sarana dan prasarana yang ada di Desa Ngilen. <br>
												5.	Melaksanakan pembinaan kesejahtraan umum, kesajahtraan dan pembangunan.
                                            </p>
                                       		</td>
                                       	</tr>
                                       </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <br><br><br>
@endsection
