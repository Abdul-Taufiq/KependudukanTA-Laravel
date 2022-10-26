<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('style/img/logo.png') }}">

    <title>Desa Ngilen | Verify Email </title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="{{ asset('style/vendor/fontawesome-free/css/all.min.css') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{ asset('style/css/sb-admin-2.min.css') }}">
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
                                <h1 class="h4 text-gray-900 mb-4">Verifikasi Akun Baru!</h1>
                            </div>

                            @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('Link Verifikasi akan dikirimkan ke email anda.') }}
                            </div>
                            @endif

                            <p class="mb-3">Sebelum melanjutkan proses, pastikan email anda telah mendapatkan pesan verifikasi di email anda.</p>
                            <p class="mb-3">Jika anda tidak mendapatkan email verifikasi, silahkan klik link dibawah ini!</p>

                            <form class="user" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-user btn-block">{{ __('Kirim verifikasi email') }}</button>
                            </form>
                        
                            
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('forget.password.get') }}">Lupa Password?</a>
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

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('style/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('style/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('style/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('style/js/sb-admin-2.min.js') }}"></script>
     

</body>

</html>