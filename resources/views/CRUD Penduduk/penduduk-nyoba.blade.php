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

<!-- DataTales -->
{{-- TOMBOL ATAS CARD TABEL --}}
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<a class="btn btn-primary btn-icon-split btn-sm mb-2" href="kk/create">
			<span class="icon text-white-50">
				<i class="fa fa-plus-circle" aria-hidden="true"></i>
			</span>
			<span class="text">Tambah Data</span>
		</a>
		<a href="#" class="btn btn-primary btn-icon-split btn-sm mb-2">
			<span class="icon text-white-50">
				<i class="fa fa-print" aria-hidden="true"></i>
			</span>
			<span class="text">Cetak Laporan</span>
		</a>
</div>
{{-- TABEL --}}
<div class="card-body">
	<div class="table-responsive">
		<table class="table table-bordered display" id="dataTablenyoba" width="100%" cellspacing="0">
			<thead>
				<tr align="center">
					{{-- <th colspan="3">Aksi</th> --}}
					<th>#</th>
					<th>#</th>
					<th>Nama</th>
					<th>NIK</th>
					<th>Gender</th>
					<th>Tempat Lahir</th>
					<th>Tgl Lahir</th>
					<th>Agama</th>
					<th>Pendidikan</th>
					<th>Goldar</th>
					<th>Pekerjaan</th>
					<th>Status Perkawinan</th>
					<th>Alamat</th>
					<th>RT</th>
					<th>RW</th>
					<th>Kelurahan</th>
					<th>Kecamatan</th>
					<th>Kewarganegaraan</th>
					<th>Status Warga</th>
					<th>Keterangan</th>
				</tr>
			</thead>
				<tbody>
					{{-- @foreach ($penduduks as $item)
					<tr > --}}
						
						{{-- @if ($item->kk)
						<td> {{ $item->kk->no_kk }} </td>
						@endif --}}
						{{-- <td> {{ $item -> nama }} </td>
						<td> {{ $item -> nik }} </td>
						<td> {{ $item -> jns_kelamin }} </td>
						<td> {{ $item -> tempat_lahir }} </td>
						<td> {{ $item -> tgl_lahir }} </td>
						<td> {{ $item -> agama }} </td>
						<td> {{ $item -> pendidikan }} </td>
						<td> {{ $item -> goldar }} </td>
						<td> {{ $item -> pekerjaan }} </td>
						<td> {{ $item -> status_perkawinan }} </td>
						<td> {{ $item -> alamat }} </td>
						<td> {{ $item -> rt }} </td>
						<td> {{ $item -> rw }} </td>
						<td> {{ $item -> kelurahan }} </td>
						<td> {{ $item -> kecamatan }} </td>
						<td> {{ $item -> kewarganegaraan }} </td>
						<td> {{ $item -> status_warga }} </td>
						<td> {{ $item -> keterangan }} </td>
						@endforeach     
					</tr> --}}
				</tbody>
			</thead>
		</table>
	</div>
  </div>
</div>



@endsection

@section('footer')
	
	<script>
    $(document).ready(function() {
        $('#dataTablenyoba').DataTable({
            "scrollX": true,
            "processing": true,
        	"serverSide": true,
            "responsive" : true,
            ajax : {
                url : "{{ route('data') }}",
            },
            columns:[
            // PENOMORAN HALAMAN
            {
                "data" :null, "sortable":false, "orderColumn":false, "searchable":false,
                render: function (data, type, row, meta){
                    return meta.row + meta.settings._iDisplayStart + 1
                }
            },
            {
                "data" :null, "sortable":false, "orderColumn":false, "searchable":false,
                render: function (data, type, row, meta){
                    var btn = "<a href="'#'"</a>"
                    return btn;
                }
            },
                {data: 'nama', nama: 'nama'},
                {data: 'nik', nik: 'nik'},
                {data: 'jns_kelamin', jns_kelamin: 'jns_kelamin'},
                {data: 'tempat_lahir', tempat_lahir: 'tempat_lahir'},
                {data: 'tgl_lahir', tgl_lahir: 'tgl_lahir'},
                {data: 'agama', agama: 'agama'},
                {data: 'pendidikan', pendidikan: 'pendidikan'},
                {data: 'goldar', goldar: 'goldar'},
                {data: 'pekerjaan', pekerjaan: 'pekerjaan'},
                {data: 'status_perkawinan', status_perkawinan: 'status_perkawinan'},
                {data: 'alamat', alamat: 'alamat'},
                {data: 'rt', rt: 'rt'},
                {data: 'rw', rw: 'rw'},
                {data: 'kelurahan', kelurahan: 'kelurahan'},
                {data: 'kecamatan', kecamatan: 'kecamatan'},
                {data: 'kewarganegaraan', kewarganegaraan: 'kewarganegaraan'},
                {data: 'status_warga', status_warga: 'status_warga'},
                {data: 'keterangan', keterangan: 'keterangan'}
                ]
        })
    } );
</script>

@endsection