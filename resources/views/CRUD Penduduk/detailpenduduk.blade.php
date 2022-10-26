@extends('layout.main')
<style type="text/css">
	 tr{
			border-bottom: 1px solid black;
		}
	 th{
	 	width: 45%;
	 }
</style>
@section('konten')
<!-- ISI KONTEN -->
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><i class="fa fa-info-circle" aria-hidden="true"></i> Detail Data Penduduk</h1>


<!-- DataTales -->
{{-- TOMBOL ATAS CARD TABEL --}}
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div style="float: left;">
			<a href="{{ url('penduduk/cetak/cetak-detail-datapenduduk/'.$penduduk->id_penduduk) }}" class="btn btn-primary btn-icon-split btn-sm mb-2" target="_blank">
				<span class="icon text-white-50">
					<i class="fa fa-print" aria-hidden="true"></i>
				</span>
				<span class="text">Cetak Laporan</span>
			</a>
		</div>
		<div style="float: right;">
			<a href=" {{ url('penduduk') }} " class="btn btn-warning btn-icon-split btn-sm">
				<span class="icon text-white">
					<i class="fa fa-arrow-left" aria-hidden="true"></i> Back
				</span>
			</a>
		</div>
</div>
{{-- TABEL --}}
<div class="card-body">

	<div class="table-responsive">
		<table id="" width="100%" cellspacing="0" cellpadding="4" style="border-collapse: collapse;">
			<tr>
				<th>Nomor Induk Kependudukan</th>
				<td> {{ $penduduk -> nik }} </td>
			</tr>
			<tr>
				<th>Nama</th>
				<td> {{ $penduduk -> nama }} </td>
			</tr>
			<tr>
				<th>Jenis Kelamin</th>
				<td> {{ $penduduk -> jns_kelamin }} </td>
			</tr>
			<tr>
				<th>Tempat, Tanggal Lahir</th>
				<td> {{ $penduduk -> tempat_lahir }}, {{ $penduduk -> tgl_lahir->format('d-m-Y') }} </td>
			</tr>
			<tr>
				<th>Agama</th>
				<td> {{ $penduduk -> agama }} </td>
			</tr>
			<tr>
				<th>Pendidikan</th>
				<td> {{ $penduduk -> pendidikan }} </td>
			</tr>
			<tr>
				<th>Golongan Darah</th>
				<td> {{ $penduduk -> goldar }} </td>
			</tr>
			<tr>
				<th>Pekerjaan</th>
				<td> {{ $penduduk -> pekerjaan }} </td>
			</tr>
			<tr>
				<th>Status Perkawinan</th>
				<td> {{ $penduduk -> status_perkawinan }} </td>
			</tr>
			<tr>	
				<th>Alamat</th>
				<td> {{ $penduduk -> alamat }} </td>
			</tr>
			<tr>	
				<th>RT/RW</th>
				<td> {{ $penduduk -> rt }}/{{ $penduduk -> rw }} </td>
			</tr>
			<tr>	
				<th>Kelurahan</th>
				<td> {{ $penduduk -> kelurahan }} </td>
			</tr>
			<tr>	
				<th>Kecamatan</th>
				<td> {{ $penduduk -> kecamatan }} </td>
			</tr>
			<tr>	
				<th>Kewarganegaraan</th>
				<td> {{ $penduduk -> kewarganegaraan }} </td>
			</tr>
			<tr>	
				<th>Status Warga</th>
				<td> {{ $penduduk -> status_warga }} </td>
			</tr>
			<tr>	
				<th>Keterangan</th>
				<td> {{ $penduduk -> keterangan }} </td>
			</tr>
		</table>
	</div>
  </div>
</div>

@endsection