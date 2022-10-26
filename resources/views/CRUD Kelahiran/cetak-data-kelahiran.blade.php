<!DOCTYPE html>
<html>
<head>
	<title>Desa Ngilen | Cetak Data Kelahiran</title>
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
			width: 100%;
			font-size: 10pt;
			padding: 5px;
		}
		
		table.header {
			width: 100%;
			border-bottom: double;
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
						<h3>PEMERINTAH KABUPATEN BLORA KECAMATAN KUNDURAN <br> DESA NGILEN</h3>
					</td>
					<td width="25%"></td>
				</tr>
			</table>
		</div>
				<h3 style="text-align: center;">LAPORAN DATA KELAHIRAN</h3>
		{{-- TANGGAL CETAK --}}
		Dicetak Pada Tanggal : <?php echo date("d-m-Y"); ?> <br>
		Jumlah Data : {{ $cetakdatakelahiran->count('pivot.id_kelahiran') }}
		<br><br>
		<table class="static" border="1" id="" width="100%" cellspacing="0" style="color: #000;" rules="all">
			<thead>
				<tr align="center">
					<th style="width: 10px">No</th>
					<th>No Kelahiran</th>
					<th>NIK</th>
					<th>Nama</th>
					<th>Ayah</th>
					<th>Ibu</th>
					<th>Anak Ke</th>
					<th>Penolong</th>
				</tr>
				<tbody>
					<?php $i = 1; ?>
					@foreach ($cetakdatakelahiran as $item)
					<tr>
						<td style="text-align: center;"> <?=  $i; ?> </td>
						<td> {{ $item -> no_kelahiran }} </td>
						@foreach ( $item->penduduk as $p )
						<td> {{ $p -> nik }} </td>
						<td> {{ $p -> nama }} </td>

						@endforeach 
						<td> {{ $item -> ayah }} </td>
						<td> {{ $item -> ibu }} </td>
						<td> {{ $item -> anak_ke }} </td>
						<td> {{ $item -> penolong }} </td>
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
