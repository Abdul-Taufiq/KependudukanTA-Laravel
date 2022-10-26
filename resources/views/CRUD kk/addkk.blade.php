@extends('layout.main')

@section('konten')
<!-- ISI KONTEN -->
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800"><i class="fa fa-plus-circle"></i> Tambah Data Kartu Keluarga</h1>

	<div class="card shadow mb-4">
		<div class="card-body">

			<form action="  {{ url('kk') }} " method="post" enctype="multipart/form-data">
				{{-- CSRF TOKEN --}}
				@csrf
				<div class="form-group">
					<label>Nomor Kartu Keluarga</label>
					<input type="text" name="no_kk" autocomplete="off" required maxlength="16" value="{{ old('no_kk') }}"
					class="form-control @error('no_kk') is-invalid @enderror" autofocus>
					{{-- Erorr Message --}}
					@error('no_kk')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror

				</div>
				<div class="form-group">
					<label>Alamat Keluarga</label>
					<input type="text" name="alamat_klg" autocomplete="off" required value="{{ old('alamat_klg') }}"
					class="form-control @error('alamat_klg') is-invalid @enderror">
					{{-- Erorr Message --}}
					@error('alamat_klg')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>RT</label>
					<input type="text" name="rt" autocomplete="off" required value="{{ old('rt') }}"
					class="form-control @error('rt') is-invalid @enderror">
					{{-- Erorr Message --}}
					@error('rt')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>RW</label>
					<input type="text" name="rw" autocomplete="off" required value="{{ old('rw') }}"
					class="form-control @error('rw') is-invalid @enderror">
					{{-- Erorr Message --}}
					@error('rw')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="modal-footer">
					<a href=" /kk " class="btn btn-danger btn-icon-split">
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