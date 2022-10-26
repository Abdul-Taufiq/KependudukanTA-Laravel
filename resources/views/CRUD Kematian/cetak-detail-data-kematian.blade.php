<!DOCTYPE html>
<html>
<head>
	<title>Desa Ngilen | Cetak Detail Data Kematian</title>
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
			border-collapse: collapse;
		}
		table.static th{
			background-color: aqua;
			text-align: left;
			padding-top: 10px;
			padding-bottom: 10px;
		}
		table.static td{
			padding: 5px;
		}
		table.static tr{
			border-bottom: 1px solid black;
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
								<h3>PEMERINTAH KABUPATEN BLORA KECAMATAN KUNDURAN <br> DESA NGILEN</h3>
							</td>
							<td width="20%"></td>
						</tr>
					</table>
				</div>
								<h3 style="text-align: center;">LAPORAN DETAIL DATA KEMATIAN</h3>
				{{-- TANGGAL CETAK --}}
				Dicetak Pada Tanggal : <?php echo date("d-m-Y"); ?> <br>
				Jumlah Data : {{ $kematian->penduduk->count('pivot.id_kematian') }}
				<br><br>
				<table class="static" id="" width="100%" cellspacing="0" style="color: #000;">
				<tr>
					@foreach ($kematian->penduduk as $item)
					<th>Nomor Kartu Keluarga</th>
					<td> {{ $item-> kk -> no_kk }} </td>
				</tr>
				<tr>
					<th>Nomor Kematian</th>
					<td> {{ $kematian -> no_kematian }} </td>
				</tr>
				<tr>
					<th>Nomor Induk Kependudukan</th>
					<td> {{ $item -> nik }} </td>
				</tr>
				<tr>
					<th>Nama</th>
					<td> {{ $item -> nama }} </td>
				</tr>
				<tr>
					<th>Jenis Kelamin</th>
					<td> {{ $item -> jns_kelamin }} </td>
				</tr>
				<tr>
					<th>Tempat, Tanggal Lahir</th>
					<td> {{ $item -> tempat_lahir }}, {{ $item -> tgl_lahir->format('d-m-Y')  }} </td>
				</tr>
				<tr>
					<th>Tanggal Kematian</th>
					<td> {{ $kematian -> tgl_kematian->format('d-m-Y') }} </td>
				</tr>
				<tr>
					<th>Umur</th>
					<td> {{ Carbon\Carbon::parse($item -> tgl_lahir) -> diff($kematian -> tgl_kematian) ->y }} Tahun 
						{{ Carbon\Carbon::parse($item -> tgl_lahir) -> diff($kematian -> tgl_kematian) ->m }} Bulan  
					 	{{ Carbon\Carbon::parse($item -> tgl_lahir) -> diff($kematian -> tgl_kematian) ->d }} Hari  
					</td>
				</tr>
				<tr>	
					<th>Tempat Kematian</th>
					<td> {{ $kematian -> tempat_kematian }} </td>
				</tr>
				<tr>	
					<th>Keterangan</th>
					<td> {{ $kematian -> keterangan }} </td>
				</tr>
				
				@endforeach
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
