<!DOCTYPE html>
<html>
<head>
	<title>Desa Ngilen | Cetak Data Penduduk</title>
	<style type="text/css">
		body{
			font-family: Times New Roman;
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
			table-layout: fixed;
			padding: 5px;
		}
		
		table.header {
			border-bottom: double;
			width: 100%;
		}

		div.c {
			text-align: right;
		} 
	</style>
</head>
<body>
	<div class="form-group">
		<div>
			<br>
			<table class="header">
				<tr>
					<td width="25%">
						<img class="rounded-circle" src="{{ asset('style/img/logo.png') }}" alt="logo" width="70" >
					</td>
					<td width="50%" style="text-align: center;">
						<h3>PEMERINTAH KABUPATEN BLORA <br> KECAMATAN KUNDURAN <br> DESA NGILEN</h3>
					</td>
					<td width="25%"></td>
				</tr>
			</table>
		</div>
						<h3 style="text-align: center;">LAPORAN DATA PENDUDUK</h3>
		{{-- TANGGAL CETAK --}}
		Dicetak Pada Tanggal : <?php echo date("d-m-Y"); ?> <br>
		Jumlah Data : {{ $cetakdatapenduduk->count('pivot.id_kk') }}
		<br><br>
		<table class="static" border="1" id="" width="100%" cellspacing="0" style="color: #000;" rules="all">
			<thead>
				<tr align="center">
					<th>No</th>
					<th>Nama</th>
					<th>NIK</th>
					<th>Jenis Kelamin</th>
					<th>Tempat Lahir</th>
					<th>Tgl Lahir</th>
					<th>Agama</th>
					<th>Pendidikan</th>
					<th>Golongan Darah</th>
					<th>Pekerjaan</th>
					<th>Status Perkawinan</th>
					<th>Alamat</th>
					<th>RT/RW</th>
					<th>Kelurahan</th>
					<th>Kecamatan</th>
					<th>Kewarganegaraan</th>
					<th>Status Warga</th>
					<th>Keterangan</th>
				</tr>
				<tbody>
					<?php $i = 1; ?>
					@foreach ($cetakdatapenduduk as $item)
					<tr>
						<td style="text-align: center;"> <?=  $i; ?> </td>
						<td> {{ $item -> nama }} </td>
						<td> {{ $item -> nik }} </td>
						<td> {{ $item -> jns_kelamin }} </td>
						<td> {{ $item -> tempat_lahir }} </td>
						<td> {{ $item -> tgl_lahir->format('d-m-Y') }} </td>
						<td> {{ $item -> agama }} </td>
						<td> {{ $item -> pendidikan }} </td>
						<td> {{ $item -> goldar }} </td>
						<td> {{ $item -> pekerjaan }} </td>
						<td> {{ $item -> status_perkawinan }} </td>
						<td> {{ $item -> alamat }} </td>
						<td> {{ $item -> rt }}/{{ $item -> rw }} </td>
						<td> {{ $item -> kelurahan }} </td>
						<td> {{ $item -> kecamatan }} </td>
						<td> {{ $item -> kewarganegaraan }} </td>
						<td> {{ $item -> status_warga }} </td>
						<td> {{ $item -> keterangan }} </td>
						<?php $i++; ?>
						@endforeach     
					</tr>
				</tbody>
			</thead>
		</table>

	</div>
	{{-- MEMINCULKAN PRINT --}}
	<script type="text/javascript">
		window.print();
	</script>

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
