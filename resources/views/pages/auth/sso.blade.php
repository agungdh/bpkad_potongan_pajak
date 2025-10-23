<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name')}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/assets/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/AdminLTE-3.2.0/dist/css/adminlte.min.css">

    <style>
        body.login-page {
            background-image: url('/cristina-gottardi-CSpjU6hYo_0-unsplash.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* efek transparan + blur */
        .login-box .card {
            background: rgba(255, 255, 255, 0.85); /* transparan putih */
            backdrop-filter: blur(8px); /* efek blur latar belakang */
            -webkit-backdrop-filter: blur(8px); /* dukungan Safari */
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
        }

        /* agar teks tetap nyaman dibaca */
        .login-box .card-body,
        .login-box .card-header a {
            color: #333;
        }
    </style>

    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary" x-data="form">
        <div class="card-header text-center">
            <a href="javascript:void(0)" class="h1"><b>{{config('app.name')}}</b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form method="POST" action="{{route('passport.authorizations.approve')}}">
                @csrf

                <input type="hidden" name="state" value="{{$request->state}}">
                <input type="hidden" name="client_id" value="{{$request->client_id}}">
                <input type="hidden" name="auth_token" value="{{$authToken}}">

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Sign In
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<p style="position: absolute; bottom: 10px; width: 100%; text-align: center; color: white; font-size: 12px;">
    Foto oleh <a href="https://unsplash.com/id/@cristina_gottardi?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
                 style="color: #fff; text-decoration: underline;">Cristina Gottardi</a> di
    <a href="https://unsplash.com/id/foto/formasi-batuan-coklat-di-bawah-langit-biru-CSpjU6hYo_0?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
       style="color: #fff; text-decoration: underline;">Unsplash</a>
</p>

<!-- jQuery -->
<script src="/assets/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        Alpine.start();
    });
</script>
<!-- Bootstrap 4 -->
<script src="/assets/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
</body>
</html>
