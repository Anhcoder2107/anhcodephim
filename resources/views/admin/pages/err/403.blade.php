<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
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
    @yield('styles')
</head>

<body>
<div class="container">
    <h1 class="display-3">403</h1>
    <p class="lead">Forbidden - You don't have permission to access this resource.</p>
    <a href="{{ route('admin.home') }}" class="btn btn-primary">Go Home</a>
</div>

{{-- js --}}
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>

</body>

</html>

