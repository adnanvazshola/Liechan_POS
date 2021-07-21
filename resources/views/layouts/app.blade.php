<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Liechan | POS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link href="{{ asset('img/liechanbgpolos.png') }}" rel="icon">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('adminLTE/plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminLTE/dist/css/adminlte.min.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ asset('adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
        @livewireStyles
        <style>
            @stack('css'){}
            .scrollbar
            {
                background: #F5F5F5;
                overflow-y: scroll;
            }
            #style-3::-webkit-scrollbar-track
            {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
                background-color: #F5F5F5;
            }

            #style-3::-webkit-scrollbar
            {
                width: 6px;
                background-color: #F5F5F5;
            }

            #style-3::-webkit-scrollbar-thumb
            {
                background-color: #000000;
            }
        </style>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed scrollbar" id="style-3">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                    @if(Auth::user()->role == 'admin')
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
                    </li>
                    @endif
                </ul>
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="#" class="brand-link">
                    <span class="brand-text font-weight-bold text-center ml-3">Liechan POS</span>
                </a>
                <div class="sidebar">
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            @if(Auth::user()->role == 'kasir')
                            <li class="nav-item">
                                <a href="{{ route('kasir.dashboard') }}" class="nav-link">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            @elseif(Auth::user()->role == 'admin')
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{ route('orders.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-clipboard"></i>
                                    <p>POS</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('products.index') }}" class="nav-link">
                                    <i class="fas fa-utensils nav-icon"></i>
                                    <p>Menu</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('reservation.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>Reservasi</p>
                                </a>
                            </li>
                            @if(Auth::user()->role == 'admin')
                            <li class="nav-item">
                                <a href="{{ route('transaction.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-money-check-alt"></i>
                                    <p>Transaksi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('employee.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-alt"></i>
                                    <p>Karyawan</p>
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{ route('logout') }}" class="nav-link" 
                                    onclick="event.preventDefault(); 
                                    document.getElementById('logout-form').submit();">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>Logout</p>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="content-wrapper">
                @yield('content')
                {{ isset($slot) ? $slot : null }}
            </div>
            <footer class="main-footer">
                <strong>Copyright &copy; 2021 <a href="#">Liechan POS</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 1.0
                </div>
            </footer>
        </div>
        @livewireScripts
        <script src="{{ asset('adminLTE/plugins/jquery/jquery.min.js') }}"></script>
        @stack('js')
        <script src="{{ asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('adminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <script src="{{ asset('adminLTE/dist/js/adminlte.js') }}"></script>
        <script src="{{ asset('adminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
        <script src="{{ asset('adminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>
        <script>
            $(document).ready(function () {
                if (!$.browser.webkit) {
                    $('.wrapper').html('<p>Sorry! Non webkit users. :(</p>');
                }
            });
        </script>
    </body>
</html>
