<style>
    .lawang:hover .fa-door-closed {
    display: none;
  }
  .lawang:hover .fa-door-open {
    display: inline-block;
  }
  .fa-door-open {
    display: none;
  }
</style>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white"
            style=" background:#CDE4D2; color: #7D4F49;">
            <div class="container">
                @php
                    if (Session::get('id_lokasi') == 1) {
                        $gambar = 'Takemori_new.jpg';
                        $h5 = 'TAKEMORI';
                        $link = 'Soondobu';
                        $login = 'Sdb';
                    } elseif (Session::get('id_lokasi') == 2) {
                        $gambar = 'soondobu.jpg';
                        $h5 = 'SOONDOBU';
                        $link = 'Takemori';
                        $login = 'Tkm';
                    } else {
                        $gambar = 'user copy.png';
                        $h5 = 'ADMINISTRATOR';
                        $link = '';
                    }
                @endphp
                <img src="{{ asset('assets') }}/pages/login/img/{{ $gambar }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8"> &nbsp;
                <h5 style="font-weight: bold; color:#7D4F49">{{ $h5 }}</h5>
                <button class="order-1 navbar-toggler first-button" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <div class="animated-icon1"><span></span><span></span><span></span></div>
                </button>

                @if ($link == '')
                @else
                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ route('login'.$link) }}" class="nav-link lawang">{{ $link }} <i class="fas fa-door-closed tutup"></i><i class="fas fa-door-open buka"></i></a>
                        </li>

                    </ul>
                </div>
                @endif

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ @Auth::user()->nama }} <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"
                            style="left: 0px; right: inherit;">
                            <a class="dropdown-item" href="#">Ganti Password</a>
                            <a class="dropdown-item" href="{{ route('logout' . @$logout) }}">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
@section('script')
<script>

</script>
@endsection