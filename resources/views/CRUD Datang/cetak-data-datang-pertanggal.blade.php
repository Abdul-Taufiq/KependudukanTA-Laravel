<!DOCTYPE html>
<html>
<head>
	<title>Desa Ngilen | Cetak Data Datang</title>
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
					<td width="26%">
						<img class="rounded-circle" src="{{ asset('style/img/logo.png') }}" alt="logo" width="70" >
					</td>
					<td width="48%" style="text-align: center;">
						<h3>PEMERINTAH KABUPATEN BLORA KECAMATAN KUNDURAN <br> DESA NGILEN</h3>
					</td>
					<td width="26%"></td>
				</tr>
			</table>
		</div>
			<h3 style="text-align: center;">LAPORAN DATA DATANG</h3>
		{{-- TANGGAL CETAK --}}
		Data Pada Tanggal : {{ Carbon\Carbon::parse($tgl1)->format('d-m-Y') }} (s/d) {{ Carbon\Carbon::parse($tgl2)->format('d-m-Y') }} <br>
		Dicetak Pada Tanggal : <?php echo date("d-m-Y"); ?> <br>
		Jumlah Data : {{ $cetakpertanggal->count('pivot.id_datang') }}
		<br><br>
		<table class="static" border="1" id="" width="100%" cellspacing="0" style="color: #000;" rules="all">
			<thead>
				<tr align="center">
					<th>No</th>
					<th>No Datang</th>
					<th style="width: 90px">Tanggal Datang</th>
					<th>Alamat Lama</th>
					<th>Alamat Baru</th>
					<th>Alasan</th>
				</tr>
				<tbody>
					<?php $i = 1; ?>
					@foreach ($cetakpertanggal as $item)
					<tr>
						<td style="text-align: center;"> <?=  $i; ?> </td>
						<td> {{ $item -> no_datang }} </td>
						<td> {{ $item -> tgl_datang->format('d-m-Y') }} </td>
						<td> {{ $item -> alamat_lama }} </td>
						<td> {{ $item -> alamat_baru }} </td>
						<td> {{ $item -> alasan }} </td>
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
