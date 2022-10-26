@extends('layout.main')

@section('konten')

<div class="card shadow mb-10 ">
	<!-- Card Header - Accordion -->
	<a href="#visimisi" class="d-block card-header py-3" data-toggle="collapse"
	role="button" aria-expanded="true" aria-controls="visimisi">
	<h6 class="m-0 font-weight-bold text-primary">Visi & Misi Kelurahan Desa Ngilen</h6>
</a>
<!-- Card Content - Collapse -->
<div class="collapse show" id="visimisi">
	<div class="card-body">
		<table border="1" style="width: 100%">
			<tr>
				<th style="width: 30%; text-align: center; background-color: aqua;">Visi</th>
				<th style="width: 70%; text-align: center; background-color: aqua;">Misi</th>
			</tr>
			<tr>
				<td style="padding: 4px;"> <p style="padding-left: 5px">Mewujudkan Kelurahan Desa Ngilen yang lebih maju dan sejahtera.</p></td>
				<td style="padding: 4px;"><p style="padding-left: 5px">
					1.	Meningkkatkan kualitas hidup masyarakat Desa Ngilen. <br>
					2.	Meningkatkan kualitas penyelenggaraan pemerintahan, pembangunan dan meningkatkkan pelayanan masyarakat di Desa Ngilen. <br>
					3.	Meningkatkan kuallitas Sumber Daya Manusia dan Aparatur. <br>
					4.	Meningkatkan sarana dan prasarana yang ada di Desa Ngilen. <br>
					5.	Melaksanakan pembinaan kesejahtraan umum, kesajahtraan dan pembangunan.
				</p>
				</td>
			</tr>
		</table>
	</div>
</div>
</div>

@endsection