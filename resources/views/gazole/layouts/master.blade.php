<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>AdminLTE 3 | Dashboard 3</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Theme style -->
    @yield('head_links')
    @yield('style')
    @livewireStyles

    {{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        {{-- {{ Auth::user()->name }} --}}

                        {{-- <i class="far fa-comments"></i> --}}
                        {{-- <span class="badge badge-danger navbar-badge">3</span> --}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item text-center">
                            profile
                        </a>
                        <div class="dropdown-divider"></div>
                        {{-- <form method="POST" action="{{ route('logout') }}" id="frm">
                            @csrf
                            <button type="submit" class="dropdown-item text-center">log out </button>
                        </form> --}}
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">A&J</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('chaufeur.index') }}" class="nav-link">
                                <i class="fa-solid fa-user"></i>
                                <p>
                                    Chauffeur
                                    <span class="right badge badge-success">{{ App\Models\Chaufeur::count() }}</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('camions.index') }}" class="nav-link">
                                <i class="fa-solid fa-truck"></i>
                                <p>
                                    Camions
                                    <span class="right badge badge-success">{{ App\Models\Camion::count() }}</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('stations.index') }}" class="nav-link">
                                <i class="fa-solid fa-charging-station"></i>
                                <p>
                                    Station
                                    <span class="right badge badge-success">{{ App\Models\Station::count() }}</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('consomations.index') }}" class="nav-link">
                                <i class="fa-solid fa-map-location-dot"></i>
                                <p>
                                    Trajet
                                    <span
                                        class="right badge badge-success">{{ App\Models\Consomation::count() }}</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('missions.index') }}" class="nav-link">
                                <i class="fa-solid fa-truck-fast"></i>
                                <p>
                                    Mission
                                    <span class="right badge badge-success">{{ App\Models\Mission::count() }}</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-cart-plus"></i>
                                <p>
                                    Mouvement de Caisse
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                {{-- <li class="nav-item">
                                    <a href="{{ route('pieces.index') }}" class="nav-link">
                                        <i class="fa-solid fa-screwdriver"></i>
                                        <p>pieces</p>
                                    </a>
                                </li> --}}
                                <li class="nav-item">
                                    <a href="{{ route('reparations.index') }}" class="nav-link">
                                        <i class="fa-solid fa-circle-dollar-to-slot"></i>
                                        <p>Caisse</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('reparation.statistiques') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-simple"></i>
                                        <p>statistiques Caisse</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-file-lines"></i>
                                <p>
                                    Factures
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                <li class="nav-item">
                                    <a href="{{ route('factures.index') }}" class="nav-link">
                                        <i class="fa-solid fa-money-check-dollar"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('facture.statistiques') }}" class="nav-link">
                                        <i class="fa-solid fa-chart-simple"></i>
                                        <p>statistiques</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('global.search') }}" class="nav-link">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                <p>
                                    Search
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ville.index') }}" class="nav-link">
                                <i class="fa-solid fa-city"></i>
                                <p>
                                    Ville
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('natures.index') }}" class="nav-link">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <p>
                                    Natures
                                    {{-- <span class="right badge badge-success">5</span> --}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('profile.index') }}" class="nav-link">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <p>
                                    Profile
                                    {{-- <span class="right badge badge-success">5</span> --}}
                                </p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('gazole.users') }}" class="nav-link">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <p>
                                    Users List
                                    <span class="right badge badge-success">5</span>
                                </p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <p>
                                    log out
                                    {{-- <span class="right badge badge-success">5</span> --}}
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">
            <div class="container">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="container">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
        <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
        <script src="{{ asset('adminlte/dist/js/pages/dashboard3.js') }}"></script>
        @yield('scripts')
        @livewireScripts

</body>

</html>
