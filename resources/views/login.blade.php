@section('pageTitle', 'Login')

@push('page-style')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/iCheck/square/blue.css') }}">
    <link href="{{ asset('bower_components/sweetalert/dist/sweetalert.css') }}" rel="stylesheet">

@endpush

@include('layouts.head')

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#">Employee Self-Service System</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="{{ action('Auth\AuthController@postLogin') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="#">I forgot my password</a><br>
        </div>
        <!-- /.login-box-body -->

        <div class="alert text-center">
            <p>If you don't have an account, kindly contact system admin (support@company.com.my) or +604-xxx xxxx</p>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- REQUIRED JS SCRIPTS -->
    @include('layouts.basic-script')

    <!-- iCheck -->
    <script src="{{ asset('bower_components/AdminLTE/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('bower_components/sweetalert/dist/sweetalert.min.js')}}"></script>
    <script>
        $(function () {
            $('input').iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_square-blue',
              increaseArea: '20%' // optional
            });
        });

        @if($errors->has())
            @foreach ($errors->all() as $error)
                swal("Oops...", "{{ $error }}", "error");
            @endforeach
        @endif
    </script>
</body>
</html>