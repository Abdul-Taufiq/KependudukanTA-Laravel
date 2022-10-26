@extends('layout.main')

@section('konten')
<!-- ISI KONTEN -->
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Tabel Kelahiran</h1>

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

	<!-- DataTales -->
	{{-- TOMBOL ATAS CARD TABEL --}}
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<a class="btn btn-primary btn-icon-split btn-sm mb-2" href="kelahiran/create">
				<span class="icon text-white-50">
					<i class="fa fa-plus-circle" aria-hidden="true"></i>
				</span>
				<span class="text">Tambah Data</span>
			</a>
			<a href="{{ route('cetak-kelahiran') }}" class="btn btn-primary btn-icon-split btn-sm mb-2" target="_blank">
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
				<a href="" onclick="this.href='/kelahiran/cetak/cetakdatakelahiran-pertanggal/'+ document.getElementById('tglawal').value +'/'+ document.getElementById('tglakhir').value" class="btn btn-primary btn-icon-split btn-sm mb-2" target="_blank" >
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
				<table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0" style="color: #000;">
					<thead>
						<tr align="center">
							<th>Aksi</th>
							<th>No Kelahiran</th>
							<th>NIK</th>
							<th>Nama</th>
							<th>Ayah</th>
							<th>Ibu</th>
							<th>Anak Ke</th>
							<th>Penolong</th>
						</tr>
						<tbody>
							@foreach ($data as $item)
							<tr>
								<td style="width: 10px; text-align:center;">
									{{-- BUTTON VIEW DETAIL --}}
									<a href=" {{ url('kelahiran/'.$item->id_kelahiran) }} " class="btn btn-info btn-icon-split" style="width: 35px; height: 35px">
										<span class="icon text-white-50">
											<i class="fa fa-eye"></i>
										</span>
									</a>


									{{-- BUTTON UBAH --}}
									<a href=" {{ url('kelahiran/'.$item->id_kelahiran.'/edit') }} " class="btn btn-primary btn-icon-split" style="width: 35px; height: 35px">
										<span class="icon text-white-50">
											<i class="fa fa-edit"></i>
										</span>
									</a>


									{{-- BUTTON HAPUS --}}
									<form action="{{ url('kelahiran/'.$item->id_kelahiran) }}" method="post" onsubmit="return confirm('Yakin Hapus Data?')" class="d-inline">
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

								<td> {{ $item -> no_kelahiran }} </td>
								@foreach ( $item->penduduk as $p )
								<td> {{ $p -> nik }} </td>
								<td> {{ $p -> nama }} </td>
								
								@endforeach 
								
								<td> {{ $item -> ayah }} </td>
								<td> {{ $item -> ibu }} </td>
								<td> {{ $item -> anak_ke }} </td>
								<td> {{ $item -> penolong }} </td>
								{{-- <td> {{ $item -> kelahiran->id_penduduk }} </td> --}}
								
								@endforeach
							</tr>
						</tbody>
					</thead>
				</table>
			</div>
		</div>
	</div>

@endsection