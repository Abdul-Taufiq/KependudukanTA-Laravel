@extends('layout.main')

@section('konten')
<!-- ISI KONTEN -->
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><i class="fa fa-edit"></i> Ubah Data Sekdes</h1>

<div class="card shadow mb-4">
	<div class="card-body">

		<form action="  {{ url('sekdes/'.$sekdes->id_sekdes) }} " method="post" enctype="multipart/form-data">
		{{-- DEKLARASI METHODE ROUTING --}}
            @method('patch')
		{{-- CSRF TOKEN --}}
			@csrf
			<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" id="nama" autocomplete="off" required maxlength="200" value="{{ old('nama', $sekdes->nama) }}"
					class="form-control @error('nama') is-invalid @enderror" autofocus>
					{{-- Erorr Message --}}
					@error('nama')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>Nomor Induk Kependudukan</label>
					<input type="text" name="nik" id="nik" autocomplete="off" required maxlength="16" value="{{ old('nik', $sekdes->nik) }}"
					class="form-control @error('nik') is-invalid @enderror" >
					{{-- Erorr Message --}}
					@error('nik')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>Nomor Induk Pegawai</label>
					<input type="text" name="nip" id="nip" autocomplete="off" required maxlength="16" value="{{ old('nip', $sekdes->nip) }}"
					class="form-control @error('nip') is-invalid @enderror" autofocus>
					{{-- Erorr Message --}}
					@error('nip')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>Jabatan</label>
					<select name="jabatan" id="jabatan" autocomplete="off" required value="{{ old('jabatan') }}" class="form-control @error('jabatan') is-invalid @enderror">
							<option value="SEKDES" {{ old('jabatan' , $sekdes->jabatan) == "SEKDES"  ? 'selected' : null }}>SEKDES</option>
							<option value="KADES" {{ old('jabatan', $sekdes->jabatan) == "KADES"  ? 'selected' : null }}>KADES</option>
					</select>
					{{-- Erorr Message --}}
					@error('jabatan')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<input type="text" name="alamat" id="alamat" autocomplete="off" required maxlength="16" value="{{ old('alamat' , $sekdes->alamat) }}"
					class="form-control @error('alamat') is-invalid @enderror" autofocus>
					{{-- Erorr Message --}}
					@error('alamat')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>Jenis Kelamin</label>
					<select name="jns_kelamin" id="jns_kelamin" autocomplete="off" required value="{{ old('jns_kelamin') }}" class="form-control @error('jns_kelamin') is-invalid @enderror">
							<option value="" disabled selected hidden>- Pilih Jenis Kelamin -</option>
							<option value="Laki-laki"  {{ old('jns_kelamin' , $sekdes->jns_kelamin) == "Laki-laki" ? 'selected' : null }}>Laki-laki</option>
							<option value="Perempuan" {{ old('jns_kelamin' , $sekdes->jns_kelamin) == "Perempuan" ? 'selected' : null }}>Perempuan</option>
					</select>
					{{-- Erorr Message --}}
					@error('jns_kelamin')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>Tempat Lahir</label>
					<input type="text" name="tempat_lahir" id="tempat_lahir" autocomplete="off" required 
					maxlength="15" value="{{ old('tempat_lahir' , $sekdes->tempat_lahir) }}" class="form-control @error('tempat_lahir') is-invalid @enderror" >
					{{-- Erorr Message --}}
					@error('tempat_lahir')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>Tanggal Lahir</label>
					<input type="text" name="tgl_lahir" id="tgl_lahir" required 
						data-provide="datepicker" required value="{{ old('tgl_lahir', Carbon\Carbon::parse($sekdes->tgl_lahir)->format('d-m-Y')) }}"
					class="datepicker @error('tgl_lahir') is-invalid @enderror" style="width: 100%;" placeholder="DD-MM-YYYY" maxlength="10">
					@error('tgl_lahir')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>Agama</label>
					<select name="agama" id="agama" autocomplete="off" required value="{{ old('agama') }}" class="form-control @error('agama') is-invalid @enderror">
							<option value="" disabled selected hidden>- Pilih Agama -</option>
							<option value="Islam"  {{ old('agama' , $sekdes->agama) == "Islam"? 'selected' : null }}>Islam</option>
							<option value="Katolik"  {{ old('agama' , $sekdes->agama) == "Katolik" ? 'selected' : null }}>Katolik</option>
							<option value="Kristen Protestan"  {{ old('agama' , $sekdes->agama) == "Kristen Protestan" ? 'selected' : null }}>Kristen Protestan</option>
							<option value="Hindu"  {{ old('agama' , $sekdes->agama) == "Hindu" ? 'selected' : null }}>Hindu</option>
							<option value="Budha"  {{ old('agama' , $sekdes->agama) == "Budha" ? 'selected' : null }}>Budha</option>
							<option value="Konghucu" {{ old('agama' , $sekdes->agama) == "Konghucu" ? 'selected' : null }}>Konghucu</option>
					</select>
					{{-- Erorr Message --}}
					@error('agama')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>Pendidikan</label>
					<select name="pendidikan" id="pendidikan" name="pendidikan" autocomplete="off" required value="{{ old('pendidikan') }}" class="form-control @error('pendidikan') is-invalid @enderror">
							<option value="" disabled selected hidden>- Pilih Pendidikan -</option>
							<option value="Tidak Sekolah" {{ old('pendidikan' , $sekdes->pendidikan) == "Tidak Sekolah" ? 'selected' : null }}>Tidak Sekolah</option>
							<option value="Tidak Tamat SD" {{ old('pendidikan' , $sekdes->pendidikan) == "Tidak Tamat SD" ? 'selected' : null }}>Tidak Tamat SD</option>
							<option value="SD Sederajat" {{ old('pendidikan' , $sekdes->pendidikan) == "SD Sederajat"  ? 'selected' : null }}>SD Sederajat</option>
							<option value="SMP Sederajat" {{ old('pendidikan' , $sekdes->pendidikan) == "SMP Sederajat"  ? 'selected' : null }}>SMP Sederajat</option>
							<option value="SMA Sederajat" {{ old('pendidikan' , $sekdes->pendidikan) == "SMA Sederajat"  ? 'selected' : null }}>SMA Sederajat</option>
							<option value="D1" {{ old('pendidikan' , $sekdes->pendidikan) == "D1"  ? 'selected' : null }}>D1</option>
							<option value="D2" {{ old('pendidikan' , $sekdes->pendidikan) == "D2"  ? 'selected' : null }}>D2</option>
							<option value="D3" {{ old('pendidikan' , $sekdes->pendidikan) == "D3"  ? 'selected' : null }}>D3</option>
							<option value="D4" {{ old('pendidikan' , $sekdes->pendidikan) == "D4"  ? 'selected' : null }}>D4</option>
							<option value="S1" {{ old('pendidikan' , $sekdes->pendidikan) == "S1"  ? 'selected' : null }}>S1</option>
							<option value="S2" {{ old('pendidikan' , $sekdes->pendidikan) == "S2"  ? 'selected' : null }}>S2</option>
							<option value="S3" {{ old('pendidikan' , $sekdes->pendidikan) == "S3"  ? 'selected' : null }}>S3</option>
					</select>
					{{-- Erorr Message --}}
					@error('pendidikan')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
	
			<div class="modal-footer">
				<a href=" /sekdes " class="btn btn-danger btn-icon-split">
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