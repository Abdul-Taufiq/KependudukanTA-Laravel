@extends('layout.main')

@section('konten')
<!-- ISI KONTEN -->
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><i class="fa fa-edit"></i> Ubah Data User</h1>

<div class="card shadow mb-4">
	<div class="card-body">

		<form action="  {{ url('user/'.$user->id) }} " method="post" enctype="multipart/form-data">
		{{-- DEKLARASI METHODE ROUTING --}}
            @method('patch')
		{{-- CSRF TOKEN --}}
			@csrf
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="name" id="name" autocomplete="off" required maxlength="200" value="{{ old('name', $user->name) }}"
					class="form-control @error('name') is-invalid @enderror" autofocus>
					{{-- Erorr Message --}}
					@error('name')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" name="email" id="email" autocomplete="off" required maxlength="200" value="{{ old('email', $user->email) }}"
					class="form-control @error('email') is-invalid @enderror" autofocus>
					{{-- Erorr Message --}}
					@error('email')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
				 <div class="form-group row">
				 	<div class="col-sm-6 mb-3 mb-sm-0">
				 		<label>Password</label>
						<input id="password" type="password" class="form-control form-control-user
						@error('password') is-invalid @enderror" name="password" 
						required autocomplete="new-password" placeholder="Password">

						@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="col-sm-6">
						<label>Konfirmasi Password</label>
						<input id="password-confirm" type="password" 
						class="form-control form-control-user" name="password_confirmation" 
						required autocomplete="new-password" placeholder="Konfirmasi Password">
					</div>
				</div>
				<div class="form-group">
					<label>Level</label>
					<select name="level" id="level" autocomplete="off" required value="{{ old('level') }}" class="form-control @error('level') is-invalid @enderror">
							<option value="USER" {{ old('level', $user->level) == "USER"  ? 'selected' : null }}>USER</option>
							<option value="KADES" {{ old('level', $user->level) == "KADES"  ? 'selected' : null }}>KADES</option>
							<option value="SEKDES" {{ old('level' , $user->level) == "SEKDES"  ? 'selected' : null }}>SEKDES</option>
					</select>
					{{-- Erorr Message --}}
					@error('level')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
			<div class="modal-footer">
				<a href=" /user " class="btn btn-danger btn-icon-split">
					<span class="icon text-white">
						Kembali
					</span>
				</a>
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
		</form>
	</div>
</div>

@endsection