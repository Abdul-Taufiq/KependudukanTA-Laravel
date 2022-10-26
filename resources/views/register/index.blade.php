<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('style/img/logo.png') }}">

    <title>Desa Ngilen | {{ $tittle }} </title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="{{ asset('style/vendor/fontawesome-free/css/all.min.css') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{ asset('style/css/sb-admin-2.min.css') }}">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-lg-block bg-warning col align-self-center text-center">
                        <img src="{{ asset('style/img/logodesa.png') }}" alt="logo" width="450" height="550">
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Daftar Akun Baru!</h1>
                            </div>
                        
                            <form class="user"  method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <input id="name" type="text" class="form-control form-control-user
                                    @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" 
                                    required autocomplete="name" autofocus placeholder="Nama">
                                     
                                     @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control form-control-user
                                     @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                      required autocomplete="email" placeholder="Email/Username">

                                        @error('email')
                                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
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
                                        <input id="password-confirm" type="password" 
                                        class="form-control form-control-user" name="password_confirmation" 
                                        required autocomplete="new-password" placeholder="Konfirmasi Password">
                                    </div>
                                </div>
                                {{-- <a href="{{ route('register') }}" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </a> --}}
                                {{-- tombol daftar --}}
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('Register Account') }}
                                    </button>
                                
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('forget.password.get') }}">Lupa Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="/">Sudah Punya Akun? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('style/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('style/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('style/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('style/js/sb-admin-2.min.js') }}"></script>
     

</body>

</html>