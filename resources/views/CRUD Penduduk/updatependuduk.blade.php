@extends('layout.main')

@section('konten')
<!-- ISI KONTEN -->
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><i class="fa fa-edit"></i> Ubah Data Penduduk</h1>

<div class="card shadow mb-4">
	<div class="card-body">

		<form action="  {{ url('penduduk/'.$penduduk->id_penduduk) }} " method="post" enctype="multipart/form-data">
		{{-- DEKLARASI METHODE ROUTING --}}
            @method('patch')
		{{-- CSRF TOKEN --}}
			@csrf
	{{-- opsional --}}
	<div class="form-group">
		<a class="collapsed" href="#" data-toggle="collapse" data-target="#opsional"
		aria-expanded="true" aria-controls="opsional">
		<i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
		<span style="font-weight: bold; ">OPSIONAL</span>
		<i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
		</a>
			<div id="opsional" class="collapse" aria-labelledby="opsional">
			<div class="form-group">

			<div class="form-group">
				<label>Nomor Kartu Keluarga</label>
				<select id="id_kk" name="id_kk" autocomplete="off" class="form-control combobox @error('id_kk') is-invalid @enderror" style="width: 100%">
					<option value="" selected>- Nomor Kartu Keluarga -</option>
        			@foreach ($kk as $item)
					<option value="{{ $item->id_kk }}" {{ old('id_kk',$penduduk->id_kk) == $item->id_kk ? 'selected' : null }}>{{ $item->no_kk }} ( {{ $item->alamat_klg }} )
					</option>
		            @endforeach 
				</select>
				{{-- Erorr Message --}}
				@error('id_kk')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>

			<div class="form-group">
				<label>Kelahiran</label>
				<select id="id_kelahiran" name="id_kelahiran" autocomplete="off" class="form-control combobox @error('id_kelahiran') is-invalid @enderror" style="width: 100%">
					<option value="" selected>- Nomor Kelahiran -</option>
        			@foreach ($kelahiran as $item)
					<option value="{{ $item->id_kelahiran }}" {{ old('id_kelahiran',$penduduk->id_kelahiran) == $item->id_kelahiran ? 'selected' : null }}>{{ $item->no_kelahiran }} ( Ayah: {{ $item->ayah }},- Ibu: {{ $item->ibu }},- Anak Ke:,- {{ $item->anak_ke }})
					</option>
		            @endforeach 
				</select>
				{{-- Erorr Message --}}
				@error('id_kelahiran')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>

			<div class="form-group">
				<label>Kematian</label>
				<select id="id_kematian" name="id_kematian" autocomplete="off" class="form-control combobox @error('id_kematian') is-invalid @enderror" style="width: 100%">
					<option value="" selected>- Nomor Kematian -</option>
        			@foreach ($kematian as $item)
					<option value="{{ $item->id_kematian }}" {{ old('id_kematian', $penduduk->id_kematian) == $item->id_kematian? 'selected' : null }}>{{ $item->no_kematian}} ( {{ $item->tgl_kematian->format('d-m-Y') }})
					</option>
		            @endforeach 
				</select>
				{{-- Erorr Message --}}
				@error('id_kematian')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>

			<div class="form-group">
				<label>Datang</label>
				<select id="id_datang" name="id_datang" autocomplete="off" class="form-control combobox @error('id_datang') is-invalid @enderror" style="width: 100%">
					<option value="" selected>- Nomor Datang -</option>
        			@foreach ($datang as $item)
					<option value="{{ $item->id_datang }}" {{ old('id_datang',$penduduk->id_datang) == $item->id_datang? 'selected' : null }}>{{ $item->no_datang}} ( {{ $item->tgl_datang->format('d-m-Y') }})
					</option>
		            @endforeach 
				</select>
				{{-- Erorr Message --}}
				@error('id_datang')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>

			<div class="form-group">
				<label>Pindah</label>
				<select id="id_pindah" name="id_pindah" autocomplete="off" class="form-control combobox @error('id_pindah') is-invalid @enderror" style="width: 100%">
					<option value="" selected>- Nomor Pindah -</option>
        			@foreach ($pindah as $item)
					<option value="{{ $item->id_pindah }}" {{ old('id_pindah',$penduduk->id_pindah) == $item->id_pindah? 'selected' : null }}>{{ $item->no_pindah}} ( {{ $item->tgl_pindah->format('d-m-Y') }})
					</option>
		            @endforeach 
				</select>
				{{-- Erorr Message --}}
				@error('id_pindah')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
		</div>
		</div>
		</div>
	</label>

	{{-- END OPSIONAL --}}

			<div class="form-group">
				<label>Nomor Induk Kependudukan</label>
				<input type="text" name="nik" id="nik" autocomplete="off" required maxlength="16" value="{{ old('nik', $penduduk->nik) }}"
				class="form-control @error('nik') is-invalid @enderror" autofocus>
				{{-- Erorr Message --}}
				@error('nik')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group">
				<label>Nama</label>
				<input type="text" name="nama" id="nama" autocomplete="off" required maxlength="200" value="{{ old('nama',$penduduk->nama) }}"
				class="form-control @error('nama') is-invalid @enderror">
				{{-- Erorr Message --}}
				@error('nama')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group">
				<label>Jenis Kelamin</label>
				<select name="jns_kelamin" id="jns_kelamin" autocomplete="off" required value="{{ old('jns_kelamin',$penduduk->jns_kelamin) }}" class="form-control @error('jns_kelamin') is-invalid @enderror">
						<option value="" disabled selected hidden>- Pilih Jenis Kelamin -</option>
						<option value="Laki-laki"  {{ old('jns_kelamin' ,$penduduk->jns_kelamin) == "Laki-laki" ? 'selected' : null }}>Laki-laki</option>
						<option value="Perempuan" {{ old('jns_kelamin',$penduduk->jns_kelamin) == "Perempuan" ? 'selected' : null }}>Perempuan</option>
				</select>
				{{-- Erorr Message --}}
				@error('jns_kelamin')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group">
				<label>Tempat Lahir</label>
				<input type="text" name="tempat_lahir" id="tempat_lahir" autocomplete="off" required 
				maxlength="15" value="{{ old('tempat_lahir',$penduduk->tempat_lahir) }}" class="form-control @error('tempat_lahir') is-invalid @enderror" >
				{{-- Erorr Message --}}
				@error('tempat_lahir')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group">
				<label>Tanggal Lahir</label>
				<input type="text" name="tgl_lahir" id="tgl_lahir" required autocomplete="off" 
					data-provide="datepicker" required value="{{ old('tgl_lahir',$penduduk->tgl_lahir->format('d-m-Y')) }}"
				class="datepicker @error('tgl_lahir') is-invalid @enderror" style="width: 100%;" placeholder="DD-MM-YYYY" maxlength="10">
				@error('tgl_lahir')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group">
				<label>Agama</label>
				<select name="agama" id="agama" autocomplete="off" required value="{{ old('agama',$penduduk->agama) }}" class="form-control @error('agama') is-invalid @enderror">
						<option value="" disabled selected hidden>- Pilih Agama -</option>
						<option value="Islam"  {{ old('agama',$penduduk->agama) == "Islam"? 'selected' : null }}>Islam</option>
						<option value="Katolik"  {{ old('agama',$penduduk->agama) == "Katolik" ? 'selected' : null }}>Katolik</option>
						<option value="Kristen Protestan"  {{ old('agama',$penduduk->agama) == "Kristen Protestan" ? 'selected' : null }}>Kristen Protestan</option>
						<option value="Hindu"  {{ old('agama',$penduduk->agama) == "Hindu" ? 'selected' : null }}>Hindu</option>
						<option value="Budha"  {{ old('agama',$penduduk->agama) == "Budha" ? 'selected' : null }}>Budha</option>
						<option value="Konghucu" {{ old('agama',$penduduk->agama) == "Konghucu" ? 'selected' : null }}>Konghucu</option>
				</select>
				{{-- Erorr Message --}}
				@error('agama')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group">
				<label>Pendidikan</label>
				<select name="pendidikan" id="pendidikan" name="pendidikan" autocomplete="off" required value="{{ old('pendidikan',$penduduk->pendidikan) }}" class="form-control @error('pendidikan') is-invalid @enderror">
						<option value="" disabled selected hidden>- Pilih Pendidikan -</option>
						<option value="Tidak Sekolah" {{ old('pendidikan',$penduduk->pendidikan) == "Tidak Sekolah" ? 'selected' : null }}>Tidak Sekolah</option>
						<option value="Tidak Tamat SD" {{ old('pendidikan',$penduduk->pendidikan) == "Tidak Tamat SD" ? 'selected' : null }}>Tidak Tamat SD</option>
						<option value="SD Sederajat" {{ old('pendidikan',$penduduk->pendidikan) == "SD Sederajat"  ? 'selected' : null }}>SD Sederajat</option>
						<option value="SMP Sederajat" {{ old('pendidikan',$penduduk->pendidikan) == "SMP Sederajat"  ? 'selected' : null }}>SMP Sederajat</option>
						<option value="SMA Sederajat" {{ old('pendidikan',$penduduk->pendidikan) == "SMA Sederajat"  ? 'selected' : null }}>SMA Sederajat</option>
						<option value="D1" {{ old('pendidikan',$penduduk->pendidikan) == "D1"  ? 'selected' : null }}>D1</option>
						<option value="D2" {{ old('pendidikan',$penduduk->pendidikan) == "D2"  ? 'selected' : null }}>D2</option>
						<option value="D3" {{ old('pendidikan',$penduduk->pendidikan) == "D3"  ? 'selected' : null }}>D3</option>
						<option value="D4" {{ old('pendidikan',$penduduk->pendidikan) == "D4"  ? 'selected' : null }}>D4</option>
						<option value="S1" {{ old('pendidikan',$penduduk->pendidikan) == "S1"  ? 'selected' : null }}>S1</option>
						<option value="S2" {{ old('pendidikan',$penduduk->pendidikan) == "S2"  ? 'selected' : null }}>S2</option>
						<option value="S3" {{ old('pendidikan',$penduduk->pendidikan) == "S3"  ? 'selected' : null }}>S3</option>
				</select>
				{{-- Erorr Message --}}
				@error('pendidikan')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group">
				<label>Golongan Darah</label>
				<select name="goldar" id="goldar" autocomplete="off" required value="{{ old('goldar',$penduduk->goldar) }}" class="form-control @error('goldar') is-invalid @enderror">
						<option value="" disabled selected hidden>- Pilih Goldar -</option>
						<option value="-" {{ old('goldar',$penduduk->goldar) == "-"  ? 'selected' : null }}>-</option>
						<option value="A" {{ old('goldar',$penduduk->goldar) == "A"  ? 'selected' : null }}>A</option>
						<option value="B" {{ old('goldar',$penduduk->goldar) == "B"  ? 'selected' : null }}>B</option>
						<option value="AB" {{ old('goldar',$penduduk->goldar) == "AB"  ? 'selected' : null }}>AB</option>
						<option value="O" {{ old('goldar',$penduduk->goldar) == "O"  ? 'selected' : null }}>O</option>
				</select>
				{{-- Erorr Message --}}
				@error('goldar')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group">
				<label>Pekerjaan</label>
				<input type="text" name="pekerjaan" id="pekerjaan" autocomplete="off" required value="{{ old('pekerjaan',$penduduk->pekerjaan) }}"
				class="form-control @error('pekerjaan') is-invalid @enderror" maxlength="20">
				{{-- Erorr Message --}}
				@error('pekerjaan')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group">
				<label>Status Perkawinan</label>
				<select name="status_perkawinan" id="status_perkawinan" autocomplete="off" required value="{{ old('status_perkawinan',$penduduk->status_perkawinan) }}" class="form-control @error('status_perkawinan') is-invalid @enderror">
						<option value="" disabled selected hidden>- Pilih Status Perkawinan -</option>
						<option value="Kawin" {{ old('status_perkawinan',$penduduk->status_perkawinan) == "Kawin"  ? 'selected' : null }}>Kawin</option>
						<option value="Belum Kawin" {{ old('status_perkawinan',$penduduk->status_perkawinan) == "Belum Kawin"  ? 'selected' : null }}>Belum Kawin</option>
				</select>
				{{-- Erorr Message --}}
				@error('status_perkawinan')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group">
				<label>Rt</label>
				<input type="text" name="rt" id="rt" autocomplete="off" required value="{{ old('rt',$penduduk->rt) }}"
				class="form-control @error('rt') is-invalid @enderror">
				{{-- Erorr Message --}}
				@error('rt')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group">
				<label>Rw</label>
				<input type="text" name="rw" id="rw" autocomplete="off" required value="{{ old('rw',$penduduk->rw) }}"
				class="form-control @error('rw') is-invalid @enderror">
				{{-- Erorr Message --}}
				@error('rw')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group">
				<label>Kelurahan</label>
				<input type="text" name="kelurahan" id="kelurahan" autocomplete="off" required value="{{ old('kelurahan',$penduduk->kelurahan) }}"
				class="form-control @error('kelurahan') is-invalid @enderror">
				{{-- Erorr Message --}}
				@error('kelurahan')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group">
				<label>Kecamatan</label>
				<input type="text" name="kecamatan" id="kecamatan" autocomplete="off" required value="{{ old('kecamatan',$penduduk->kecamatan) }}"
				class="form-control @error('kecamatan') is-invalid @enderror">
				{{-- Erorr Message --}}
				@error('kecamatan')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group">
				<label>Kewarganegaraan</label>
				<input type="text" name="kewarganegaraan" id="kewarganegaraan" autocomplete="off" required value="{{ old('kewarganegaraan',$penduduk->kewarganegaraan) }}"
				class="form-control @error('kewarganegaraan') is-invalid @enderror">
				{{-- Erorr Message --}}
				@error('kewarganegaraan')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group">
				<label>Status Pada Keluarga</label>
				<select name="status_pada_keluarga" id="status_pada_keluarga" autocomplete="off" value="{{ old('status_pada_keluarga',$penduduk->status_pada_keluarga) }}" class="form-control @error('status_pada_keluarga') is-invalid @enderror">
						<option value="" disabled selected hidden>- Pilih Status Pada Keluarga -</option>
						<option value="Ayah" {{ old('status_pada_keluarga',$penduduk->status_pada_keluarga) == "Ayah"  ? 'selected' : null }}>Ayah</option>
						<option value="Ibu" {{ old('status_pada_keluarga',$penduduk->status_pada_keluarga) == "Ibu"  ? 'selected' : null }}>Ibu</option>
						<option value="Anak" {{ old('status_pada_keluarga',$penduduk->status_pada_keluarga) == "Anak"  ? 'selected' : null }}>Anak</option>
				</select>
				{{-- Erorr Message --}}
				@error('status_pada_keluarga')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group">
				<label>Status Warga</label>
				<select name="status_warga" id="status_warga" autocomplete="off" value="{{ old('status_warga',$penduduk->status_warga) }}" class="form-control @error('status_warga') is-invalid @enderror">
						<option value="" disabled selected hidden>- Pilih Status Warga -</option>
						<option value="Tetap"  {{ old('status_warga',$penduduk->status_warga) == "Tetap" ? 'selected' : null }}>Tetap</option>
						<option value="Kontrak"  {{ old('status_warga',$penduduk->status_warga) == "Kontrak" ? 'selected' : null }}>Kontrak</option>
				</select>
				{{-- Erorr Message --}}
				@error('status_warga')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="form-group">
				<label>Keterangan</label>
				<input type="text" name="keterangan" id="keterangan" autocomplete="off" required value="{{ old('keterangan',$penduduk->keterangan) }}"
				class="form-control @error('keterangan') is-invalid @enderror">
				{{-- Erorr Message --}}
				@error('keterangan')
				<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>
			<div class="modal-footer">
				<a href=" /penduduk " class="btn btn-danger btn-icon-split">
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