@extends('layout.main')

@section('konten')
<!-- ISI KONTEN -->
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><i class="fa fa-info-circle" aria-hidden="true"></i> Detail Data Kartu Keluarga</h1>


<!-- DataTales -->
{{-- TOMBOL ATAS CARD TABEL --}}
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<div style="float: left;">
			<a href="{{ url('kk/cetak/cetak-detail-datakk/'.$kk->id_kk) }}" class="btn btn-primary btn-icon-split btn-sm mb-2" target="_blank">
				<span class="icon text-white-50">
					<i class="fa fa-print" aria-hidden="true"></i>
				</span>
				<span class="text">Cetak Laporan</span>
			</a>
		</div>
		<div style="float: right;">
			<a href=" {{ url('kk') }} " class="btn btn-warning btn-icon-split btn-sm">
				<span class="icon text-white">
					<i class="fa fa-arrow-left" aria-hidden="true"></i> Back
				</span>
			</a>
		</div>
</div>
{{-- TABEL --}}
<div class="card-body">

	<div class="table-responsive">
		<table border="1" id="" width="100%" cellspacing="0" cellpadding="4">
			<thead>
				<tr style="text-align: center;">
					<th>No</th>
					<th>Nomor KK</th>
					<th>NIK</th>
					<th>Nama</th>
					<th>Jenis Kelamin</th>
					<th>Tempat Lahir</th>
					<th>Tanggal Lahir</th>
					<th>Agama</th>
					<th>Pendidikan</th>
					<th>Pekerjaan</th>
					<th>Alamat Keluarga</th>
				</tr>
			</thead>
				<tbody>
					@php
						$no=1;
					@endphp
					@foreach ($kk->penduduk as $item)
					<tr>
						<td>{{ $no++ }}</td>
						<td> {{ $item -> kk -> no_kk }} </td>
						<td> {{ $item->nik }} </td>
						<td> {{ $item->nama }} </td>
						<td> {{ $item->jns_kelamin }} </td>
						<td> {{ $item->tempat_lahir }} </td>
						<td> {{ $item->tgl_lahir->format('d-m-Y') }} </td>
						<td> {{ $item->agama}} </td>
						<td> {{ $item->pendidikan}} </td>
						<td> {{ $item->pekerjaan}} </td>
						<td> {{ $item -> kk  -> alamat_klg }}, Rt.{{ $item -> kk -> rt }}  Rw.{{ $item -> kk ->  rw }} </td>
					</tr>
					@endforeach
				</tbody>
			
		</table>
	</div>
  </div>
</div>

@endsection