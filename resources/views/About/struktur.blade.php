@extends('layout.main')

@section('konten')

<div class="card shadow mb-10 ">
	<!-- Card Header - Accordion -->
	<a href="#struktur" class="d-block card-header py-3" data-toggle="collapse"
	role="button" aria-expanded="true" aria-controls="struktur">
	<h6 class="m-0 font-weight-bold text-primary">Struktur Organisasi Kelurahan Desa Ngilen</h6>
</a>
<!-- Card Content - Collapse -->
<div class="collapse show" id="struktur">
	<div class="card-body">
		Struktur Organisasi Desa Ngilen di pimpin oleh Kepala Desa sebagai pimpinan dan koordinator penyelenggaraan pemerintahan di wilayah kerja kelurahan selaku perangkat kecamatan yang memiliki kewenangan penuh dalam sistem, Sekretaris Desa memiliki tugas salah satunya adalah melakukan penyusunan dokumentasi serta mendata data penduduk Desa di Desa Ngilen yang dibantu oleh Kaur TU dan Umum serta Kaur Keuangan selain itu Kaur memiliki tugas membantu Sekertaris Desa dalam urusan pelayanan administrasi pendukung pelaksanaan tugas-tugas pemerintahan, Kemudian terdapat Kasi Pemerintahan, Kasi Kesejahtraan dan Kasi Pelayanan yang memiliki tugas salah satunya adalah menyusun program dan kegiatan pemerintahan dan pelayanan publik, kemudian Kadus memiliki tugas salah satunya adalah melakukan pembinaan ketentraman dan ketertiban, pelaksanaan upaya perlindungan masyarakat, mobilitas kependudukan, penataan dan pengelolahan wilayah serta mengawasi pelaksanaan pembangunan di wilayahnya. Berikut Struktur Organisasi Desa Ngilen : <br>
		<hr class="sidebar-divider">
		<img src="{{ asset('style/img/struktur.png') }}" alt="logo" width="100%" >
	</div>
</div>
</div>


@endsection