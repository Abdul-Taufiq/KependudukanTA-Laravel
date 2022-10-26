@extends('layout.main')

@section('konten')
<!-- ISI KONTEN -->
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><i class="fa fa-edit"></i> Edit Data Kartu Keluarga</h1>

<div class="card shadow mb-4">
        <div class="card-body">

        <form action="  {{ url('kk/'.$kk->id_kk) }} " method="post" enctype="multipart/form-data">
                {{-- DEKLARASI METHODE ROUTING --}}
                @method('patch')
                {{-- CSRF TOKEN --}}
                @csrf
                <div class="form-group">
                        <label>Nomor Kartu Keluarga</label>
                        <input type="text" name="no_kk" autocomplete="off" required maxlength="16"
                        class="form-control @error('no_kk') is-invalid @enderror" autofocus value="{{ old('no_kk', $kk->no_kk) }}">
                        {{-- Erorr Message --}}
                        @error('no_kk')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                </div>
                <div class="form-group">
                        <label>Alamat Keluarga</label>
                        <input type="text" name="alamat_klg" autocomplete="off" required
                        class="form-control @error('alamat_klg') is-invalid @enderror" value="{{ old('alamat_klg', $kk->alamat_klg) }}">
                        {{-- Erorr Message --}}
                        @error('alamat_klg')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
                <div class="form-group">
                        <label>RT</label>
                        <input type="text" name="rt" autocomplete="off" required
                        class="form-control @error('rt') is-invalid @enderror" value="{{ old('rt', $kk->rt) }}">
                        {{-- Erorr Message --}}
                        @error('rt')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
                <div class="form-group">
                        <label>RW</label>
                        <input type="text" name="rw" autocomplete="off" required
                        class="form-control @error('rw') is-invalid @enderror" value="{{ old('rw', $kk->rw) }}">
                        {{-- Erorr Message --}}
                        @error('rw')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </div>
                <div class="modal-footer">
                        <a href=" /kk " class="btn btn-danger btn-icon-split">
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