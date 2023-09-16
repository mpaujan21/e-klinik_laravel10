<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>eKlinik</title>

    <!-- Custom fonts for this template-->
    <link href="{{ URL::asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ URL::asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    {{-- TEST SIDEBAR --}}
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'>
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">

    <!-- Bootstrap core JavaScript-->
    <script src="{{ URL::asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('/js/printThis.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ URL::asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ URL::asset('js/fontawesome-iconpicker.js') }}"></script>
    <link href="{{ URL::asset('css/fontawesome-iconpicker.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom scripts for all pages-->
    <script src="{{ URL::asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ URL::asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ URL::asset('js/demo/datatables-demo.js') }}"></script>

    @livewireStyles
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item -->
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="messagesDropdown" style="padding: 5px;">
                                @if (Auth::user()->role === 1)
                                    <span class="badge badge-success">Super Admin</span>
                                @elseif (Auth::user()->role === 2)
                                    <span class="badge badge-success">Admin Klinik</span>
                                @elseif (Auth::user()->role === 3)
                                    <span class="badge badge-success">Dokter</span>
                                @elseif (Auth::user()->role === 4)
                                    <span class="badge badge-success">Pasien</span>
                                @elseif (Auth::user()->role === 5)
                                    <span class="badge badge-success">Admin Farmasi</span>
                                @elseif (Auth::user()->role === 6)
                                    <span class="badge badge-success">Admin Lab</span>
                                @endif
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 large">{{ ucfirst(Auth::user()->nama) }}</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                {{-- <a class="dropdown-item" href="{{route('profile.edit')}}"> --}}
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" id="PrintRM">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">@yield('judul_halaman')</h1>
                    <p class="mb-4">@yield('deskripsi_halaman')</p>

                    <!-- Errors -->
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <p class="mb-0">
                                    {{ $error }}
                                </p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endforeach
                    @endif
                    <!-- End of Errors -->

                    <!-- Pesan Berhasil -->
                    @if (session()->has('pesan'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <p class="mb-0">
                                {{ session()->get('pesan') }}
                            </p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <!-- End of Pesan Berhasil-->

                    <!-- Content -->
                    @yield('content')

                </div>
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    @livewireScripts
</body>

</html>
