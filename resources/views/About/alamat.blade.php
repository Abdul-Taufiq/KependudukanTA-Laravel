@extends('layout.main')

@section('konten')


<div class="card shadow mb-10 ">
	<!-- Card Header - Accordion -->
	<a href="#alamat" class="d-block card-header py-3" data-toggle="collapse"
	role="button" aria-expanded="true" aria-controls="alamat">
	<h6 class="m-0 font-weight-bold text-primary">Alamat Kantor Kelurahan Desa Ngilen</h6>
</a>
<!-- Card Content - Collapse -->
<div class="collapse show" id="alamat">
	<div class="card-body">
		Kantor Kelurahan Desa Ngilen berlokasikan di Jl. Sumberwudi, Ngilen, Kunduran, Kabupaten Blora, Jawa Tengah. Tepatnya berada di Dusun Tempur, Desa Ngilen, Kecamatan Kunduran, Kabupaten Blora, Jawa Tengah. Link Alamat : <a href="https://www.google.com/maps/place/Kantor+Desa+Ngilen/@-7.0680529,111.225479,17z/data=!4m5!3m4!1s0x2e774e51a357b059:0x61a3642747a19699!8m2!3d-7.0680527!4d111.2289433" target="_blank">Kantor Kelurahan Desa Ngilen.</a> <br>
		<hr class="sidebar-divider">
		<img src="{{ asset('style/img/kantor kelurahan.png') }}" alt="logo" width="100%" >
	</div>
</div>
</div>
<hr class="sidebar-divider">


@endsection