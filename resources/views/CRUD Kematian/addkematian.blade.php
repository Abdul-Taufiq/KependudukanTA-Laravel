@extends('layout.main')

@section('konten')
<!-- ISI KONTEN -->
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800"><i class="fa fa-plus-circle"></i> Tambah Data Kematian</h1>

	<div class="card shadow mb-4">
		<div class="card-body">

			<form action="  {{ url('kematian') }} " method="post" enctype="multipart/form-data">
				{{-- CSRF TOKEN --}}
				@csrf
				<div class="form-group">
					<label>Nomor Kematian</label>
					<input type="text" name="no_kematian" autocomplete="off" required maxlength="50" value="{{ old('no_kematian', $nomer) }}"
					class="form-control @error('no_kematian') is-invalid @enderror" autofocus>
					{{-- Erorr Message --}}
					@error('no_kematian')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror

				</div>
				<div class="form-group">
					<label>Tanggal Lahir</label>
					<input type="text" name="tgl_lahir" id="tgl_lahir" required 
						data-provide="datepicker" required value="{{ old('tgl_lahir') }}"
					class="datepicker @error('tgl_lahir') is-invalid @enderror" style="width: 100%;" placeholder="DD-MM-YYYY" maxlength="10">
					@error('tgl_lahir')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>Tanggal Kematian</label>
					<input type="text" name="tgl_kematian" id="tgl_kematian" required onchange="autofill()"
						data-provide="datepicker" required value="{{ old('tgl_kematian') }}"
					class="datepicker @error('tgl_kematian') is-invalid @enderror" style="width: 100%;" placeholder="DD-MM-YYYY" maxlength="10">
					@error('tgl_kematian')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>Umur</label>
					<input type="text" name="umur" id="umur" autocomplete="off" maxlength="4" readonly="" required value="{{ old('umur') }}"
					class="form-control @error('umur') is-invalid @enderror">
					{{-- Erorr Message --}}
					@error('umur')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>Tempat Kematian</label>
					<input type="text" name="tempat_kematian" autocomplete="off" maxlength="200" required value="{{ old('tempat_kematian') }}" 
					class="form-control @error('tempat_kematian') is-invalid @enderror">
					{{-- Erorr Message --}}
					@error('tempat_kematian')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>Keterangan</label>
					<input type="text" name="keterangan" autocomplete="off" maxlength="200" required value="{{ old('keterangan') }}"
					class="form-control @error('keterangan') is-invalid @enderror">
					{{-- Erorr Message --}}
					@error('keterangan')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="modal-footer">
					<a href=" /kematian " class="btn btn-danger btn-icon-split">
						<span class="icon text-white">
							Kembali
						</span>
					</a>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>

{{-- Script umur --}}
<script type="text/javascript">
    function autofill() {
        var tgl_lahir = $("#tgl_lahir").val().replace(/-/g,'');
        var tgl_kematian = $("#tgl_kematian").val().replace(/-/g,'');
        // substr awal
        var dayAwal = Number(tgl_lahir.substr(0, 2));
        var monthAwal = Number(tgl_lahir.substr(2, 2));
        var yearAwal = Number(tgl_lahir.substr(4, 4));
        // substr akhir
        var dayAkhir = Number(tgl_kematian.substr(0, 2));
        var monthAkhir = Number(tgl_kematian.substr(2, 2));
        var yearAkhir = Number(tgl_kematian.substr(4, 4));

        // var age = dayAkhir - dayAwal || monthAkhir - monthAwal || yearAkhir - yearAwal;

        // umur.value = age;   

        var age = yearAkhir - yearAwal;
        if (monthAkhir < monthAwal || monthAkhir == monthAwal && dayAkhir < dayAwal) {
            age--;
        }
        umur.value = age;  
        }
</script>

@endsection