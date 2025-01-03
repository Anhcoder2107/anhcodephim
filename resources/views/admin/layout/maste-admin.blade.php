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
    <!--nav-->
    <nav role="navigation" class="navbar navbar-custom">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button data-target="#bs-content-row-navbar-collapse-5" data-toggle="collapse" class="navbar-toggle"
                    type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand">AnhcodePhim-Admin</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div id="bs-content-row-navbar-collapse-5" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">Admin <b
                                class="caret"></b></a>
                        <ul role="menu" class="dropdown-menu">
                            <li class="dropdown-header">Setting</li>
                            <li><a href="#">Action</a></li>
                            <li class="divider"></li>
                            <li class="active"><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                            <li class="disabled"><a href="#">Signout</a></li>
                        </ul>
                    </li>
                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!--header-->
    <div class="container-fluid">
        <!--documents-->
        <div class="row row-offcanvas row-offcanvas-left">
            <div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
                <ul class="list-group panel">
                    <li class="list-group-item"><i class="glyphicon glyphicon-align-justify"></i> <b>SIDE PANEL</b></li>
                    <li class="list-group-item"><input type="text" class="form-control search-query"
                            placeholder="Search Something"></li>
                    <li class="list-group-item"><a href="{{ route('admin.home') }}"><i
                                class="glyphicon glyphicon-home"></i>Dashboard
                        </a></li>
                    <li>
                        <a href="#demo4" class="list-group-item " data-toggle="collapse">Movie<span
                                class="glyphicon glyphicon-chevron-right"></span></a>
                    </li>
                    <li class="collapse" id="demo4">
                        <a href="{{ route('admin.movies') }}" class="list-group-item">Danh Sách Phim</a>
                        <a href="{{ route('admin.movies.create') }}" class="list-group-item">Thêm Mới Phim</a>
                    </li>
                    <li>
                        <a href="#demo1" class="list-group-item " data-toggle="collapse">Category<span
                                class="glyphicon glyphicon-chevron-right"></span></a>
                    </li>
                    <li class="collapse" id="demo1">
                        <a href="{{ route('admin.categories') }}" class="list-group-item">Danh Sách Danh Mục</a>
                        <a href="{{ route('admin.categories.create') }}" class="list-group-item">Thêm Mới Danh Mục</a>
                    </li>
                    <li>
                        <a href="#demo2" class="list-group-item " data-toggle="collapse">Actors<span
                                class="glyphicon glyphicon-chevron-right"></span></a>
                    </li>
                    <li class="collapse" id="demo2">
                        <a href="{{ route('admin.actors') }}" class="list-group-item">Danh Sách Diễn Viên</a>
                        <a href="{{ route('admin.actors.create') }}" class="list-group-item">Thêm Mới Diễn Viên</a>
                    </li>
                    <li>
                        <a href="#demo3" class="list-group-item " data-toggle="collapse">Directors<span
                                class="glyphicon glyphicon-chevron-right"></span></a>
                    </li>
                    <li class="collapse" id="demo3">
                        <a href="{{ route('admin.directors') }}" class="list-group-item">Danh Sách Đạo Diễn</a>
                        <a href="{{ route('admin.directors.create') }}" class="list-group-item">Thêm Mới Đạo Diễn</a>
                    </li>
                    <li>
                        <a href="#demo5" class="list-group-item " data-toggle="collapse">Regions<span
                                class="glyphicon glyphicon-chevron-right"></span></a>
                    </li>
                    <li class="collapse" id="demo5">
                        <a href="{{ route('admin.regions') }}" class="list-group-item">Danh Sách Khu Vực</a>
                        <a href="{{ route('admin.regions.create') }}" class="list-group-item">Thêm Mới Khu Vực</a>
                    </li>
                    <li>
                        <a href="#demo6" class="list-group-item " data-toggle="collapse">Episodes<span
                                class="glyphicon glyphicon-chevron-right"></span></a>
                    </li>
                    <li class="collapse" id="demo6">
                        <a href="{{ route('admin.espiodes') }}" class="list-group-item">Danh Sách Tập Phim</a>
                    </li>

                    <li>
                        <a href="#demo7" class="list-group-item " data-toggle="collapse">Users<span
                                class="glyphicon glyphicon-chevron-right"></span></a>
                    </li>
                    <li class="collapse" id="demo7">
                        <a href="{{ route('admin.users') }}" class="list-group-item">Danh Sách Người Dùng</a>
                        <a href="{{ route('admin.users.create') }}" class="list-group-item">Thêm Mới Người Dùng</a>
                    </li>
                    <li>
                        <a href="#demo8" class="list-group-item " data-toggle="collapse">Roles<span
                                class="glyphicon glyphicon-chevron-right"></span></a>
                    </li>
                    <li class="collapse" id="demo8">
                        <a href="{{ route('admin.roles') }}" class="list-group-item">Danh Sách Vai Trò</a>
                        <a href="{{ route('admin.roles.create') }}" class="list-group-item">Thêm Mới Vai Trò</a>
                    </li>
                    <li>
                        <a href="#demo9" class="list-group-item " data-toggle="collapse">Permissions<span
                                class="glyphicon glyphicon-chevron-right"></span></a>
                    </li>
                    <li class="collapse" id="demo9">
                        <a href="{{ route('admin.permissions') }}" class="list-group-item">Danh Sách Quyền</a>
                        <a href="{{ route('admin.permissions.create') }}" class="list-group-item">Thêm Mới Quyền</a>

                    </li>


                </ul>
            </div>
            <div class="col-xs-12 col-sm-9 content">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span
                                    class="fa fa-angle-double-left" data-toggle="offcanvas"
                                    title="Maximize Panel"></span></a> Panel Title</h3>
                    </div>
                    <div class="panel-body">
                        @yield('container')
                    </div><!-- panel body -->
                </div>
            </div><!-- content -->
        </div>
    </div>
    <!--footer-->
    <div class="footer">
        <div class="container">
            <div class="clearfix">
                <div class="footer-logo"><a href="#">Bootflat-Admin</a></div>
                <dl class="footer-nav">
                    <dt class="nav-title">PORTFOLIO</dt>
                    <dd class="nav-item"><a href="#">Web Design</a></dd>
                    <dd class="nav-item"><a href="#">Branding &amp; Identity</a></dd>
                    <dd class="nav-item"><a href="#">Mobile Design</a></dd>
                    <dd class="nav-item"><a href="#">Print</a></dd>
                    <dd class="nav-item"><a href="#">User Interface</a></dd>
                </dl>
                <dl class="footer-nav">
                    <dt class="nav-title">ABOUT</dt>
                    <dd class="nav-item"><a href="#">The Company</a></dd>
                    <dd class="nav-item"><a href="#">History</a></dd>
                    <dd class="nav-item"><a href="#">Vision</a></dd>
                </dl>
                <dl class="footer-nav">
                    <dt class="nav-title">GALLERY</dt>
                    <dd class="nav-item"><a href="#">Flickr</a></dd>
                    <dd class="nav-item"><a href="#">Picasa</a></dd>
                    <dd class="nav-item"><a href="#">iStockPhoto</a></dd>
                    <dd class="nav-item"><a href="#">PhotoDune</a></dd>
                </dl>
                <dl class="footer-nav">
                    <dt class="nav-title">CONTACT</dt>
                    <dd class="nav-item"><a href="#">Basic Info</a></dd>
                    <dd class="nav-item"><a href="#">Map</a></dd>
                    <dd class="nav-item"><a href="#">Conctact Form</a></dd>
                </dl>
            </div>
            <div class="footer-copyright text-center">Copyright &copy; 2014 YourCompany.All rights reserved.</div>
        </div>
    </div>

    {{-- js --}}
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    @yield('scripts')
</body>

</html>
