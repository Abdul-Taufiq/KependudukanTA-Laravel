@extends('layout.main')

@section('konten')
<!-- ISI KONTEN -->
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tabel Penduduk</h1>

{{-- PEMBERITAHUAN DATA BERHASIL/TIDAK DITAMBAH --}}
@if (session('status'))
<div class="alert alert-success">
	{{ session('status') }}
</div>
@endif

{{-- ERROR CETAK PERTANGGAL --}}
@if (session('statuserror'))
<div class="alert alert-danger">
	{{ session('statuserror') }}
</div>
@endif

{{-- Jumlah Data : {{ $penduduks->count('id_penduduk') }} --}}

<!-- DataTales -->
{{-- TOMBOL ATAS CARD TABEL --}}
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<a class="btn btn-primary btn-icon-split btn-sm mb-2" href="penduduk/create">
			<span class="icon text-white-50">
				<i class="fa fa-plus-circle" aria-hidden="true"></i>
			</span>
			<span class="text">Tambah Data</span>
		</a>
		<a href="penduduk/cetak/cetakdatapenduduk" class="btn btn-primary btn-icon-split btn-sm mb-2" target="_blank">
			<span class="icon text-white-50">
				<i class="fa fa-print" aria-hidden="true"></i>
			</span>
			<span class="text">Cetak Laporan</span>
		</a>

		<div class="d-inline" style="float: right; overflow: hidden; padding: 2px">
			<label>Tanggal Awal</label>
			<input name="tglawal" id="tglawal" required data-provide="datepicker" 
			class="datepicker" style="width: 150px;" placeholder="DD-MM-YYYY" maxlength="10">
			<label>Tanggal Akhir</label>
			<input name="tglakhir" id="tglakhir" required data-provide="datepicker" 
			class="datepicker" style="width: 150px;" placeholder="DD-MM-YYYY" maxlength="10">
			<a href="" onclick="this.href='/penduduk/cetak/cetakdatapenduduk-pertanggal/'+ document.getElementById('tglawal').value +'/'+ document.getElementById('tglakhir').value" class="btn btn-primary btn-icon-split btn-sm mb-2" target="_blank" >
				<span class="icon text-white-50">
					<i class="fa fa-print" aria-hidden="true"></i>
				</span>
				<span class="text">Cetak Per Tanggal</span>
			</a>
		</div>
</div>
{{-- TABEL --}}
<div class="card-body">
	<div class="table-responsive">
		<table class="table table-bordered display" id="dataTable" cellspacing="0"  style="color: #000;">
			<thead>
				<tr align="center">
					<th>Aksi</th>
					<th style="width: 200px;">Nama</th>
					<th>NIK</th>
					<th>Jenis Kelamin</th>
					<th>Tempat, Tanggal Lahir</th>
					<th>Agama</th>
					<th>Pendidikan</th>
					<th>Golongan Darah</th>
					<th>Pekerjaan</th>
					<th>Status Perkawinan</th>
					<th>Alamat</th>
					<th>Rt/Rw</th>
					<th>Kelurahan</th>
					<th>Kecamatan</th>
					<th>Kewarganegaraan</th>
					<th>Status Warga</th>
					<th>Keterangan</th>
				</tr>
			</thead>
				<tbody>
					@foreach ($penduduks as $item)
					<tr >
						<td style="text-align:center">
							{{-- BUTTON VIEW DETAIL --}}
							<a href=" {{ url('penduduk/'.$item->id_penduduk) }} " 
								class="btn btn-info btn-icon-split" style="width: 35px; height: 35px">
								<span class="icon text-white-50">
									<i class="fa fa-eye"></i>
								</span>
							</a>
						
							{{-- BUTTON UBAH --}}
							<a href=" {{ url('penduduk/'.$item->id_penduduk.'/edit') }} " 
								class="btn btn-primary btn-icon-split" style="width: 35px; height: 35px">
								<span class="icon text-white-50">
									<i class="fa fa-edit"></i>
								</span>
							</a>
													{{-- BUTTON HAPUS --}}
							<form action="{{ url('penduduk/'.$item->id_penduduk) }}" method="post" 
								onsubmit="return confirm('Yakin Hapus Data?')" class="d-inline">
								{{-- DEKLARASI METHODE ROUTING --}}
								@method('delete')
								{{-- CSRF TOKEN --}}
								@csrf
								<button class="btn btn-danger btn-icon-split" style="width: 35px; height: 35px">
									<span class="icon text-white-50">
										<i class="fa fa-trash" aria-hidden="true"></i>
									</span>
								</button>
							</form>
						</td>
						
						{{-- @if ($item->penduduk)
						<td> {{ $item->kk->no_kk }} </td>
						@endif --}}
						<td> {{ $item -> nama }} </td>
						<td> {{ $item -> nik }} </td>
						<td> {{ $item -> jns_kelamin }} </td>
						<td> {{ $item -> tempat_lahir }}, {{ $item -> tgl_lahir->format('d-m-Y') }} </td>
						<td> {{ $item -> agama }} </td>
						<td> {{ $item -> pendidikan }} </td>
						<td> {{ $item -> goldar }} </td>
						<td> {{ $item -> pekerjaan }} </td>
						<td> {{ $item -> status_perkawinan }} </td>
						<td> {{ $item -> alamat }} </td>
						<td> {{ $item -> rt }}/{{ $item -> rw }} </td>
						<td> {{ $item -> kelurahan }} </td>
						<td> {{ $item -> kecamatan }} </td>
						<td> {{ $item -> kewarganegaraan }} </td>
						<td> {{ $item -> status_warga }} </td>
						<td> {{ $item -> keterangan }} </td>
						@endforeach     
					</tr>
				</tbody>
			</thead>
		</table>
	</div>
  </div>
</div>

@endsection

