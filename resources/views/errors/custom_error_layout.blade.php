<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>

    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href="{{asset('assets/css/app.min.css')}} " rel="stylesheet" type="text/css" id="app-default-stylesheet" />

</head>

<body class="authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card">

                        <div class="card-body p-4">
                            <div class="text-center mt-4">
                                <h1 class="text-error">@yield('code')</h1>
                                <h3 class="mt-3 mb-2">@yield('header')</h3>
                                <p class="text-muted mb-3">@yield('message')</p>
                                @if (($code ?? '') == '404')
                                <a href="{{ URL::to('/home') }}" class="btn btn-success waves-effect waves-light">Back to Home</a>
                                @else
                                <a href="{{ env('MYHUB_LOGOUT_URL') }}" class="btn btn-success waves-effect waves-light">Back to MyHub</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer footer-alt">
        <script>
            document.write(new Date().getFullYear())
        </script> &copy; ALFAMART PHILS. All Rights Reserved.
    </footer>

    <script src="{{asset('assets/js/vendor.min.js')}}"></script>
    <script src="{{asset('assets/js/app.min.js')}}"></script>

</body>

</html>
