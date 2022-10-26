@extends('layout.main')
	
@section('konten')
<!-- ISI KONTEN -->
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800"><i class="fa fa-plus-circle"></i> Tambah Data Pindah</h1>

	<div class="card shadow mb-4">
		<div class="card-body">

			<form action="  {{ url('pindah') }} " method="post" enctype="multipart/form-data">
				{{-- CSRF TOKEN --}}
				@csrf
				<div class="form-group">
					<label>Nomor Pindah</label>
					<input type="text" name="no_pindah" autocomplete="off" required maxlength="30" value="{{ old('no_pindah', $nomer) }}"
					class="form-control @error('no_pindah') is-invalid @enderror" autofocus>
					{{-- Erorr Message --}}
					@error('no_pindah')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror

				</div>
				<div class="form-group">
					<label>Tanggal Pindah</label>
					<input type="text" name="tgl_pindah" id="tgl_pindah" required 
						data-provide="datepicker" required value="{{ old('tgl_pindah') }}"
					class="datepicker @error('tgl_pindah') is-invalid @enderror" style="width: 100%;" placeholder="DD-MM-YYYY" maxlength="10">
					@error('tgl_pindah')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>Alamat Lama</label>
					<input type="text" name="alamat_lama" autocomplete="off" maxlength="200" required value="{{ old('alamat_lama') }}"
					class="form-control @error('alamat_lama') is-invalid @enderror">
					{{-- Erorr Message --}}
					@error('alamat_lama')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>Alamat Baru</label>
					<input type="text" name="alamat_baru" autocomplete="off" maxlength="200" required value="{{ old('alamat_baru') }}"
					class="form-control @error('alamat_baru') is-invalid @enderror">
					{{-- Erorr Message --}}
					@error('alamat_baru')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>Alasan</label>
					<input type="text" name="alasan" autocomplete="off" maxlength="200" required value="{{ old('alasan') }}"
					class="form-control @error('alasan') is-invalid @enderror">
					{{-- Erorr Message --}}
					@error('alasan')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="modal-footer">
					<a href=" /pindah " class="btn btn-danger btn-icon-split">
						<span class="icon text-white">
							Kembali
						</span>
					</a>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>


@endsection