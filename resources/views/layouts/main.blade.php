
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SISRel | @yield('title')</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ url('') }}/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ url('') }}/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ url('') }}/adminlte/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ url('') }}/adminlte/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ url('') }}/adminlte/dist/css/skins/_all-skins.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <!-- Toastr -->
        <link rel="stylesheet" href="{{ url('') }}/plugins/toastr/build/toastr.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ url('') }}/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

        <link rel="icon" href="{{ url('') }}/images/logo.png">

        <style>
            hr {
                border-top: 1px solid #e6e6e6;
            }
        </style>

        @yield('headerScripts')
    </head>
    <body class="hold-transition skin-black sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="{{ url('') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>S</b>R</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">
                    <img src="{{ url('') }}/images/logo.png" alt="">
                    <b>SIS</b>REL
                </span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ url('') }}/images/default-user.png" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="{{ url('') }}/images/default-user.png" class="img-circle" alt="User Image">

                                    <p>
                                    {{ Auth::user()->name }}
                                    <small>{{ Auth::user()->email }}</small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign out</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{ url('') }}/images/default-user.png" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>{{ Auth::user()->name }}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="@yield('home')">
                        <a href="{{ url('') }}"><i class="fa fa-home"></i> <span>Laman Utama</span></a>
                    </li>
                    <li>
                        <a href="{{ url('admin') }}"><i class="fa fa-user-secret"></i> <span>Admin Panel</span></a>
                    </li>
                    <li class="treeview @yield('pelesen')">
                        <a href="#">
                            <i class="fa fa-user"></i> <span>Pelesen</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="@yield('pelesen_list')"><a href="{{ url('pelesen') }}"><i class="fa fa-circle-o"></i> Senarai Pelesen</a></li>
                            <li class="@yield('pelesen_add')"><a href="{{ url('pelesen/add') }}"><i class="fa fa-circle-o"></i> Daftar Baru Pelesen</a></li>
                        </ul>
                    </li>
                    <li class="@yield('levi')">
                        <a href="{{ url('levi') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>Daftar Borang Levi</span>
                        </a>
                    </li>
                    <li class="@yield('report')">
                        <a href="{{ url('report') }}">
                            <i class="fa fa-line-chart"></i>
                            <span>Laporan Kewangan</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.13
            </div>
            <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
            reserved.
        </footer>

        <!-- jQuery 3 -->
        <script src="{{ url('') }}/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ url('') }}/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="{{ url('') }}/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="{{ url('') }}/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ url('') }}/adminlte/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ url('') }}/adminlte/dist/js/demo.js"></script>
        <!-- Toastr -->
        <script src="{{ url('') }}/plugins/toastr/build/toastr.min.js"></script>
        <!-- DataTables -->
        <script src="{{ url('') }}/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{ url('') }}/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script>
        var _months = [
            { id: 1, name: 'Januari' },
            { id: 2, name: 'Februari' },
            { id: 3, name: 'Mac' },
            { id: 4, name: 'April' },
            { id: 5, name: 'Mei' },
            { id: 6, name: 'Jun' },
            { id: 7, name: 'Julai' },
            { id: 8, name: 'Ogos' },
            { id: 9, name: 'September' },
            { id: 10, name: 'Oktober' },
            { id: 11, name: 'November' },
            { id: 12, name: 'Disember' },
        ];
        $(document).ready(function () {
            $(".datatable").DataTable();

            @if(Session('success'))
            toastr.success("{{ Session('success') }}");
            @endif

            @if(Session('error'))
            toastr.error("{{ Session('error') }}");
            @endif

            
        })
        </script>

        @yield('footerScripts')
    </body>
</html>
