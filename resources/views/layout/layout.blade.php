<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pemetaan Potensi Desa</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('template/sbadmin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{asset('template/sbadmin/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
    <style>
        #mapid { height: 50vh; }
    </style>
    {{-- @stack('duar') --}}
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-text mx-2">Pemetaan Potensi Desa</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item " id="beranda">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item" id="desa">
                <a class="nav-link" href="{{ route('desa') }}">
                    <i class="fas fa-fw fa-house-user"></i>
                    <span>Manajemen desa</span></a>
            </li>

            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST" class="nav-link p-0 m-0">
                    @csrf
                    <a class="nav-link" onclick='this.parentNode.submit(); return false;'>
                        <i class="fas fa-fw fa-arrow-left"></i>
                        <span>Logout</span>
                    </a>
                </form>
            </li>

            <li class="nav-item" id="about">
                <a class="nav-link" onclick="openAboutModal();">
                    <i class="fas fa-fw fa-info"></i>
                    <span>Tentang aplikasi</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Manajemen potensi
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item" id="sekolah">
                <a class="nav-link" href="{{ route('sekolah') }}">
                    <i class="fas fa-fw fa-graduation-cap"></i>
                    <span>Sekolah</span></a>
            </li>

            <li class="nav-item" id="pasar">
                <a class="nav-link" href="{{ route('pasar') }}">
                    <i class="fas fa-fw fa-store"></i>
                    <span>Pasar</span></a>
            </li>

            <li class="nav-item" id="tempatibadah">
                <a class="nav-link" href="{{ route('tempatibadah') }}">
                    <i class="fas fa-fw fa-place-of-worship"></i>
                    <span>Tempat ibadah</span></a>
            </li></span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            @yield('content')
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('/layout/about-modal')

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('template/sbadmin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('template/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('template/sbadmin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('template/sbadmin/js/sb-admin-2.min.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>

        function openAboutModal() {
            $('#aboutApp').modal('show');
        }
        function alertDone(msg){
          Swal.fire({
            title: "Berhasil",
            text: msg,
            icon: "success",
            button: "Oke",
          });
        }

        function alertWarning(msg){
          Swal.fire({
            title: "Eror",
            text: msg,
            icon: "warning",
            button: "Oke",
          });
        }

        function alertFail(msg){
          Swal.fire({
            title: "Gagal",
            text: msg,
            icon: "error",
            button: "Oke",
          });
        }
    </script>
    @stack("anjay")
</body>
</html>
