<!DOCTYPE html>
<html>
<head>
	<title>Desa Ngilen | Cetak Detail Data Kartu Keluarga</title>
	<style type="text/css">
		body{
			font-family: Times New Roman;
			font-size: 16px;
		}
		div.form-group{
			padding-left: 10px;
			padding-right: 10px;
		}
		h1{
			text-align: center;
		}
		table.static {
			position: relative;
		}
		table.static th{
			background-color: aqua;
			padding-top: 10px;
			padding-bottom: 10px;
		}
		table.static td{
			padding: 5px;
			font-size: 10pt;
		}
		
		table.header {
			width: 100%;
			border-bottom: double;
		}

		p{
			font-style: bold;
			font-family: Times New Roman;
			font-size: 20px;
		}
	</style>
</head>
<body>
	{{-- @php
		dd($data);
		@endphp --}}
		<div class="form-group">
			<div>
				<br>
				<table class="header">
					<tr>
						<td width="20%">
							<img class="rounded-circle" src="{{ asset('style/img/logo.png') }}" alt="logo" width="70" >
						</td>
						<td width="60%" style="text-align: center;">
							<h3>PEMERINTAH KABUPATEN BLORA <br> KECAMATAN KUNDURAN <br> DESA NGILEN</h3>
						</td>
						<td width="20%"></td>
					</tr>
				</table>
			</div>
							<h3 style="text-align: center;">LAPORAN DETAIL DATA KARTU KELUARGA</h3>
			{{-- TANGGAL CETAK --}}
			Dicetak Pada Tanggal : <?php echo date("d-m-Y"); ?> <br>
			Jumlah Data : {{ $kk->penduduk->count('pivot.id_penduduk') }}
			<br><br>
			<table class="static" border="1" id="" width="100%" cellspacing="0" style="color: #000;" rules="all">
				<thead>
					<tr>
						<th>No</th>
						<th>Nomor KK</th>
						<th>NIK</th>
						<th>Nama</th>
						<th>Jenis Kelamin</th>
						<th>Tempat Lahir</th>
						<th>Tanggal Lahir</th>
						<th>Agama</th>
						<th>Pendidikan</th>
						<th>Pekerjaan</th>
						<th>Alamat Keluarga</th>
					</tr>
				</thead>
				<tbody>
					@php
					$no=1;
					@endphp
					@foreach ($kk->penduduk as $item)
					<tr>
						<td>{{ $no++ }}</td>
						<td> {{ $item -> kk -> no_kk }} </td>
						<td> {{ $item->nik }} </td>
						<td> {{ $item->nama }} </td>
						<td> {{ $item->jns_kelamin }} </td>
						<td> {{ $item->tempat_lahir }} </td>
						<td> {{ $item->tgl_lahir->format('d-m-Y') }} </td>
						<td> {{ $item->agama}} </td>
						<td> {{ $item->pendidikan}} </td>
						<td> {{ $item->pekerjaan}} </td>
						<td> {{ $item -> kk  -> alamat_klg }}, Rt.{{ $item -> kk -> rt }}  Rw.{{ $item -> kk ->  rw }} </td>
					</tr>
					@endforeach
				</tbody>
			</table>

		</div>
					<!-- muncul -->
{{-- <script type="text/javascript">
	window.print();
</script>
--}}

<br><br><br><br>
{{-- ttd --}}
<table align="right">
	<tr>
		<td>
			@include('partial.kades')
		</td>
	</tr>
</table>

</body>
</html>
