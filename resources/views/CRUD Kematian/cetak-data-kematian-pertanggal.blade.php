<!DOCTYPE html>
<html>
<head>
	<title>Desa Ngilen | Cetak Data Kematian</title>
	<style type="text/css">
		body{
			font-family: Times New Roman;
		}
		div.form-group{
			padding-left: 5px;
			padding-right: 5px;
		}
		h1{
			text-align: center;
		}
		table.static {
			position: relative;
			width: 100%;
			font-size: 10pt;
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
						<h3 style="text-align: center;">LAPORAN DATA KEMATIAN</h3>
		{{-- TANGGAL CETAK --}}
		Dicetak Pada Tanggal : <?php echo date("d-m-Y"); ?> <br>
		Jumlah Data : {{ $cetakpertanggal->count('pivot.id_kematian') }}
		<br><br>
		<table class="static" border="1" id="" width="100%" cellspacing="0" style="color: #000;" rules="all">
				<tr align="center">
					<th>No</th>
					<th>No Kematian</th>
					<th>NIK</th>
					<th>Nama</th>
					<th>Tanggal Lahir</th>
					<th>Tanggal Kematian</th>
					<th>Umur</th>
					<th>Tempat Kematian</th>
					<th>Keterangan</th>
				</tr>
					<?php $i = 1; ?>
					@foreach ($cetakpertanggal as $item)
					<tr>
						@foreach($item->penduduk as $penduduk)
						<td style="text-align: center;"> <?=  $i; ?> </td>
						<td> {{ $item -> no_kematian }} </td>
						<td> {{ $penduduk -> nik }} </td>
						<td> {{ $penduduk -> nama  }} </td>
						<td> {{ $penduduk -> tgl_lahir ->format('d-m-Y') }} </td>
						<td> {{ $item -> tgl_kematian->format('d-m-Y') }} </td>
						{{-- UMUR --}}
						<td> {{ Carbon\Carbon::parse($penduduk -> tgl_lahir) -> diffInYears($item -> tgl_kematian)  }} </td>
						@endforeach
						<td> {{ $item -> tempat_kematian }} </td>
						<td> {{ $item -> keterangan }} </td>
						<?php $i++; ?>
						@endforeach     
					</tr>
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