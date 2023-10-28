<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    @yield('title')

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('stisla/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/assets/css/components.css') }}">

    @yield('style')
    
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg bg-primary2"></div>
            {{-- Navbar --}}
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                    class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-1.png') }}"
                                class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, Champ!</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Logged in 5 min ago</div>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            {{-- / Navbar --}}

            {{-- Sidebar --}}
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    {{-- logo --}}
                    <div class="sidebar-brand">
                        <a href="index.html">Sikasiduk</a>
                    </div>

                    {{-- === logo Minimize === --}}
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">Si</a>
                    </div>
                    {{-- / logo --}}

                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="active">
                            <a class="nav-link" href="#">
                                <i class="fas fa-fire"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        {{-- Dropdown Example --}}
                        {{-- <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown"><i
                                    class="fas fa-fire"></i><span>Dashboard</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="index-0.html">General Dashboard</a></li>
                                <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
                            </ul>
                        </li> --}}
                        {{-- / Dropdown Example --}}

                        <li class="menu-header">Data</li>
                        <li>
                            <a class="nav-link" href="#">
                                <i class="fas fa-user"></i>
                                <span>Data Penduduk</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="#">
                                <i class="fas fa-home"></i>
                                <span>Data TPS</span>
                            </a>
                        </li>
                        <li class="menu-header">Klasifikasi</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-robot"></i><span>Sistem
                                    Klasifikasi</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="index-0.html">KNN Data Penduduk</a></li>
                                <li><a class="nav-link" href="index.html">Confussion Matrix</a></li>
                            </ul>
                        </li>
                    </ul>
                </aside>
            </div>
            {{-- / Sidebar --}}

            {{-- <!-- Main Content --> --}}
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        @yield('header')
                    </div>
                    <div class="section-body">
                        @yield('body')
                    </div>
                </section>
            </div>
            {{-- / Main Content --}}


            <footer class="main-footer">
                <div class="footer-left">
                    Copyright Ahmad Zulfan Najib &copy; 2023 <div class="bullet"></div> Design By <a
                        href="https://nauv.al/">Muhamad
                        Nauval Azhar</a>
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('stisla/assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('stisla/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('stisla/assets/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->
    @yield('script')
</body>

</html>
