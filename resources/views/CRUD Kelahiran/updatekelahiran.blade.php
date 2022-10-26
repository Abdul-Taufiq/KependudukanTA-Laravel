@extends('layout.main')

@section('konten')
<!-- ISI KONTEN -->
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800"><i class="fa fa-edit"></i> Edit Data Kelahiran</h1>

	<div class="card shadow mb-4">
		<div class="card-body">

			<form action="  {{ url('kelahiran/'.$kelahiran->id_kelahiran) }} " method="post" enctype="multipart/form-data">
				{{-- DEKLARASI METHODE ROUTING --}}
                @method('patch')
                {{-- CSRF TOKEN --}}
                @csrf
				<div class="form-group">
					<label>Nomor Kelahiran</label>
					<input type="text" name="no_kelahiran" autocomplete="off" required maxlength="30" value="{{ old('no_kelahiran', $kelahiran->no_kelahiran) }}"
					class="form-control @error('no_kelahiran') is-invalid @enderror" autofocus>
					{{-- Erorr Message --}}
					@error('no_kelahiran')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror

				</div>
				<div class="form-group">
					<label>Nama Ayah</label>
					<select id="ayah" name="ayah" autocomplete="off" class="form-control combobox @error('ayah') is-invalid @enderror">
						<option value="" selected>- Nama Ayah -</option>
            			@foreach ($penduduk as $item)
						<option value="{{ $item->nama }}" {{ old('ayah', $kelahiran->ayah) == $item->nama ? 'selected' : null }}>{{ $item->nama }} ( {{ $item->nik }} )
						</option>
			            @endforeach 
					</select>
					{{-- Erorr Message --}}
					@error('ayah')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>Nama Ibu</label>
					<select id="ibu" name="ibu" autocomplete="off" required class="form-control combobox
					@error('ibu') is-invalid @enderror" style="display: flex;">
						<option value="" selected>- Nama Ibu -</option>
            			@foreach ($penduduk as $item)
						<option value="{{ $item->nama }}" {{ old('ibu', $kelahiran->ibu) == $item->nama ? 'selected' : null }}>{{ $item->nama }} ( {{ $item->nik }} )
						</option>
			            @endforeach 
					</select>
					{{-- Erorr Message --}}
					@error('ibu')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>Anak Ke</label>
					<input type="text" name="anak_ke" autocomplete="off" maxlength="4" required value="{{ old('anak_ke', $kelahiran->anak_ke) }}"
					class="form-control @error('anak_ke') is-invalid @enderror">
					{{-- Erorr Message --}}
					@error('anak_ke')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>Penolong</label>
					<input type="text" name="penolong" autocomplete="off" maxlength="200" required value="{{ old('penolong', $kelahiran->penolong) }}"
					class="form-control @error('penolong') is-invalid @enderror">
					{{-- Erorr Message --}}
					@error('penolong')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="modal-footer">
					<a href=" /kelahiran " class="btn btn-danger btn-icon-split">
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