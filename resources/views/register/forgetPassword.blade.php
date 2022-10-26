<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('style/img/logo.png') }}">

    <title>Desa Ngilen | Lupa Password</title>

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

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                         <div class="col-lg-6 d-lg-block bg-success col align-self-center text-center">
                            <img src="{{ asset('style/img/logodesa.png') }}" alt="logo" width="410" height="505">
                        </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h2 class="h4 text-gray-900 mb-2">Lupa Password Anda?</h2>

                                        @if (Session::has('message'))
                                        <div class="alert alert-success" role="alert">
                                            {{ Session::get('message') }}
                                        </div>
                                        @endif

                                        <p class="mb-3">Masukan Email yang sudah terdaftar pada sistem, Kami akan mengirimkan Link Reset Password ke Email Anda!</p>
                                    </div>

                                    <form class="user" action="{{ route('forget.password.post') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user 
                                                @error('email') is-invalid @enderror"
                                                id="email_address" name="email" aria-describedby="emailHelp"
                                                placeholder="Masukan Email..." required autofocus autocomplete="off">

                                              @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                              @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Kirim Link Reset Password
                                        </button>
                                    </form>

                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">Buat Akun!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="/login">Sudah Punya Akun? Login!</a>
                                    </div>
                                </div>
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