<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>AnhcodePhim Admin </title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon" href="{{ asset('img/favicon.webp') }}" type="image/ico" />
    <!-- site css -->
    <link rel="stylesheet" href="{{ asset('dist/css/site.min.css') }}">
    <link
        href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic"
        rel="stylesheet" type="text/css">
    <!-- <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'> -->
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="{{ asset('dist/js/site.min.js') }}"></script>
    <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #303641;
            color: #C1C3C6
        }
    </style>
</head>

<body>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="form-signin" role="form" method="POST" action="{{ route('admin.login') }}">
            @csrf
            <h3 class="form-signin-heading">Please Log in</h3>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="glyphicon glyphicon-user"></i>
                    </div>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email"
                        autocomplete="off" />
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class=" glyphicon glyphicon-lock "></i>
                    </div>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                        autocomplete="off" />
                </div>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        </form>

    </div>
    <div class="clearfix"></div>
    <br><br>
    <!--footer-->
    {{-- <div class="site-footer login-footer">
        <div class="container">
            <div class="copyright clearfix text-center">
                <p><b>AnhcodePhim</b>&nbsp;&nbsp;&nbsp;&nbsp;<a href="getting-started.html">Getting
                        Started</a>&nbsp;&bull;&nbsp;<a href="#">Documentation</a>&nbsp;&bull;&nbsp;<a
                        href="https://github.com/Bootflat/Bootflat.UI.Kit.PSD/archive/master.zip">Free
                        PSD</a>&nbsp;&bull;&nbsp;<a href="colors.html">Color Picker</a></p>
                <p>Code licensed under <a href="http://opensource.org/licenses/mit-license.html" target="_blank"
                        rel="external nofollow">MIT License</a>, documentation under <a
                        href="http://creativecommons.org/licenses/by/3.0/" rel="external nofollow">CC BY 3.0</a>.</p>
            </div>
        </div>
    </div> --}}
</body>

</html>
