<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('style/img/logo.png') }}">

    <title>Desa Ngilen | Login </title>

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
        <div class="card-body">
            @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
            @endif
            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block col align-self-center text-center bg-secondary">
                                   <img src="{{ asset('style/img/logodesa.png') }}" alt="logo" width="450" height="520">
                               </div>
                               <div class="col-lg-6">
                                <div class="p-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-3">Selamat Datang!</h1>
                                    </div>

                                    {{-- LOGIN ERROR --}}
                                    @if(session()->has('loginError'))
                                    <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert" style="font-size: 13px">
                                        {{ session('loginError') }}
                                    </div>
                                    @endif

                                    <form class="user" action="/login" method="post">
                                        @csrf
                                        <div class="form-group mb-2">
                                            <input type="username" class="form-control form-control-user" name="email" required 
                                            id="email" value="{{ old('email') }}"
                                            placeholder="Email/Username">
                                        </div>
                                        <div class="form-group mb-2">
                                            <input type="password" class="form-control form-control-user" 
                                            name="password" required id="password" placeholder="Password">
                                        </div>

                                        {{-- Capctha --}}
                                        <div class="form-group mb-2">
                                            <div class="hasil_refereshrecapcha d-inline">
                                                {!! captcha_img('math') !!}
                                            </div>
                                            {{-- refresh captcha --}}
                                            <a class="btn btn-default btn-icon-split"  style="padding: 10px;" 
                                            href="javascript:void(0)" onclick="refreshCaptcha()">
                                            <span>
                                                <i class="fas fa-sync"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="form-group mb-2">
                                        <input type="text" class="form-control form-control-user @error('captcha') is-invalid @enderror" 
                                        name="captcha" required id="captcha" placeholder="Masukan Captcha">
                                        @error('captcha')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block" type="submit">Login</button> 
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('forget.password.get') }}">Lupa Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{ route('register') }}">Buat Akun!</a>
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

<script>
    function refreshCaptcha(){
        $.ajax({
            url: "/refereshcapcha",
            type: 'get',
            dataType: 'html',        
            success: function(json) {
                $('.hasil_refereshrecapcha').html(json);
            },
            error: function(data) {
                alert('Try Again.');
            }
        });
    }
</script>


</body>

</html>