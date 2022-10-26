@extends('layout.main')

<style type="text/css">
	 tr{
			border-bottom: 1px solid black;
		}
</style>

@section('konten')
<!-- ISI KONTEN -->
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800"><i class="fa fa-info-circle" aria-hidden="true"></i> Detail Data Kelahiran</h1>


<!-- DataTales -->
{{-- TOMBOL ATAS CARD TABEL --}}
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div style="float: left;">
			<a href="{{ url('kelahiran/cetak/cetak-detail-kelahiran/'.$kelahiran->id_kelahiran) }}" class="btn btn-primary btn-icon-split btn-sm mb-2" target="_blank">
				<span class="icon text-white-50">
					<i class="fa fa-print" aria-hidden="true"></i>
				</span>
				<span class="text">Cetak Laporan</span>
			</a>
		</div>
		<div style="float: right;">
			<a href=" {{ url('kelahiran') }} " class="btn btn-warning btn-icon-split btn-sm">
				<span class="icon text-white">
					<i class="fa fa-arrow-left" aria-hidden="true"></i> Back
				</span>
			</a>
		</div>
</div>
{{-- TABEL --}}
<div class="card-body">

	<div class="table-responsive" id="detail">
		<table id="" width="100%" cellspacing="0" cellpadding="4" style="border-collapse: collapse;">
		<tr>
			@foreach ($kelahiran->penduduk as $item)
			<th>Nomor Kartu Keluarga</th>
			<td> {{ $item-> kk -> no_kk }} </td>
		</tr>
		<tr>
			<th>Nomor Kelahiran</th>
			<td> {{ $kelahiran -> no_kelahiran }} </td>
		</tr>
		<tr>
			<th>Nomor Induk Kependudukan</th>
			<td> {{ $item -> nik }} </td>
		</tr>
		<tr>
			<th>Nama</th>
			<td> {{ $item -> nama }} </td>
		</tr>
		<tr>
			<th>Jenis Kelamin</th>
			<td> {{ $item -> jns_kelamin }} </td>
		</tr>
		<tr>
			<th>Tempat, Tanggal Lahir</th>
			<td> {{ $item -> tempat_lahir }}, {{ $item -> tgl_lahir->format('d-m-Y')  }} </td>
		</tr>
		<tr>
			<th>Anak Ke</th>
			<td> {{ $kelahiran -> anak_ke }} </td>
		</tr>
		<tr>	
			<th>Nama Ayah</th>
			<td> {{ $kelahiran -> ayah }} </td>
		</tr>
		<tr>	
			<th>Nama Ibu</th>
			<td> {{ $kelahiran -> ibu }} </td>
		</tr>
		<tr>	
			<th>Penolong</th>
			<td> {{ $kelahiran -> penolong }} </td>
		</tr>
		@endforeach
	</table>
	</div>
  </div>
</div>

@endsection