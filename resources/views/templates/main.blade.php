<!doctype html>
<html class="no-js h-100" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Donasi</title>
    <meta name="description" content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/v4-shims.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0" href="{{url('styles/shards-dashboards.1.1.0.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.0.1/css/scroller.dataTables.min.css">
    <link rel="stylesheet" href="{{url('styles/extras.1.1.0.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    @yield('cssExternal')
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </head>
  <style>
  
  .collapse-header 
  {
    text-align : center;
  }
  .bg-sidebar 
  {
    background : #cacaca;
    margin : 10px;
    padding : 10px;
    position: relative;
  }
  .collapse-item
  {
    display : block;
    position: relative;
    padding: 2px 8px ;
    list-style : none;
  }
  a.collapse-item
  {
    color : black;
    background : white;
    margin: 10px 0;
  }
  .fa-disabled {
    opacity: 0.6;
    cursor: not-allowed;
  }
  a:hover.collapse-item
  {
    -webkit-box-shadow: 0px 8px 5px 0px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 8px 5px 0px rgba(0,0,0,0.75);
    box-shadow: 0px 8px 5px 0px rgba(0,0,0,0.75);
    text-decoration : none;
  }
  </style>
  <body class="h-100">
    <div class="container-fluid">
      <div class="row">
        <!-- Main Sidebar -->
        <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
          <div class="main-navbar">
            <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
              <a class="navbar-brand w-100 mr-0" href="{{route('home')}}" style="line-height: 25px;">
                <div class="d-table m-auto">
                  <!-- <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="{{url('images/shards-dashboards-logo.svg')}}" alt="Shards Dashboard"> -->
                  <span class="d-none d-md-inline ml-1">Badan Wakaf Al-Quran</span>
                </div>
              </a>
              <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons">&#xE5C4;</i>
              </a>
            </nav>
          </div>
          <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
            <div class="input-group input-group-seamless ml-3">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-search"></i>
                </div>
              </div>
              <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
          </form>
          <div class="nav-wrapper">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a @if($halaman == 'home') class="nav-link active" @else class="nav-link" @endif href="{{route('home')}}">
                  <i class="material-icons">edit</i>
                  <span>Dashboard</span>
                </a>
              </li>
              <li class="nav-item">
                <a @if($halaman == 'input') class="nav-link active" @else class="nav-link" @endif class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#input" aria-expanded="false" aria-controls="input">
                  <i class="material-icons">post_add</i>
                  <span>Input</span>
                  <i class="material-icons">expand_more</i>
                </a>
                <div id="input" class="collapse" style="">
                  <div class="bg-sidebar py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Input :</h6>
                    <a href="{{url('/donasi')}}" class="collapse-item">Input Donasi</a>
                    <a href="{{route('inputtransfer')}}" class="collapse-item">Input Bukti Transfer</a>
                  </div>
                </div>
              </li>
              <li class="nav-item fa-disabled">
                <a class="nav-link collapsed disabled" href="#" data-toggle="collapse" data-target="" aria-expanded="false" aria-controls="">
                <i class="fas fa-table"></i>
                  <span>Data Induk</span>
                  <i class="material-icons">expand_more</i>
                </a>
                <div id="" class="collapse" style="">
                  <div class="bg-sidebar py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Induk :</h6>
                    <a href="" class="collapse-item">Program</a>
                    <a href="" class="collapse-item">Project</a>
                    <a href="" class="collapse-item">Jaringan</a>
                    <a href="" class="collapse-item">Kas</a>
                  </div>
                </div>
              </li>
              <li class="nav-item">
                <a @if($halaman == 'wakif') class="nav-link active" @else class="nav-link" @endif href="{{route('wakif')}}">
                  <i class="fas fa-address-card"></i>
                  <span>Daftar Wakif</span>
                </a>
              </li>
              <li class="nav-item">
                <a @if($halaman == 'laporan') class="nav-link active collapsed" @else class="nav-link collapsed" @endif href="#" data-toggle="collapse" data-target="#cekData" aria-expanded="false" aria-controls="cekData">
                  <i class="fas fa-chart-line"></i>
                  <span>Laporan</span>
                  <i class="material-icons">expand_more</i>
                </a>
                <div id="cekData" class="collapse" style="">
                  <div class="bg-sidebar py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Laporan :</h6>
                    <a href="{{url('/donasi/tabledonasi')}}" class="collapse-item">Donasi</a>
                    <a href="{{route('verifikasi')}}" class="collapse-item">Transfer</a>
                  </div>
                </div>
              </li>
              <li class="nav-item">
                <a @if($halaman == 'DataEdc') class="nav-link active collapsed" @else class="nav-link collapsed" @endif href="#" data-toggle="collapse" data-target="#cekDataEdc" aria-expanded="false" aria-controls="cekDataEdc">
                  <i class="fas fa-chart-bar"></i>
                  <span>Laporan EDC</span>
                  <i class="material-icons">expand_more</i>
                </a>
                <div id="cekDataEdc" class="collapse" style="">
                  <div class="bg-sidebar py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Laporan EDC :</h6>
                    <a href="{{url('/DataEdc')}}" class="collapse-item">Seluruh Transaksi EDC</a>
                    <a href="{{route('buktitransfer')}}" class="collapse-item">Detail Transaksi EDC</a>
                  </div>
                </div>
              </li>
              <!-- <li class="nav-item">
                <a @if($halaman == 'keuangan') class="nav-link active" @else class="nav-link" @endif href="{{route('keuangan')}}">
                  <i class="material-icons">account_balance_wallet</i>
                  <span>Data keuangan</span>
                </a>
              </li> -->
              <!-- <li class="nav-item">
                <a @if($halaman == 'dataedc') class="nav-link active" @else class="nav-link" @endif href="{{route('dataedc')}}">
                  <i class="material-icons">account_balance_wallet</i>
                  <span>Data edc</span>
                </a>
              </li> -->
              
            </ul>
          </div>
        </aside>
        <!-- End Main Sidebar -->
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
          <div class="main-navbar sticky-top bg-white">
            <!-- Main Navbar -->
            <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
              <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                <div class="input-group input-group-seamless ml-3">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <!-- tanggal -->
                      <?php 
                        $hari = array("Minggu","Senin",'Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
                        $bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                        $sekarang = $hari[date('N')].', '. date('d'). " " .$bulan[date('n') -1]. " ".date('Y');
                        echo "<div class=''> <i class='fas fa-calendar-alt'></i> ".$sekarang."</div>" ;
                        ?>
                        <div  class="ml-1 "> | <i class="fas fa-clock"></i></div>
                        <div id="jam" class="ml-1  "></div>
                        <div id="menit" class="ml-1  "></div>
                        <div id="detik" class="ml-1  "></div>
                        
                    </div>
                  </div>
                  <!-- <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> -->
                   </div>
              </form>
              <ul class="navbar-nav border-left flex-row ">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    @if(Auth::user()->foto)
                    <img class="user-avatar rounded-circle mr-2" src="{{ url('images/avatars/'.Auth::user()->foto)}}">
                    @else
                    <img class="user-avatar rounded-circle mr-2" src="{{url('images/avatars/dummy.png')}}">
                    @endif
                    <span class="d-none d-md-inline-block">Selamat datang {{Auth::user()->nm_login}}</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-small">
                    <a class="dropdown-item" href="{{route('logout')}}">
                    <i class="material-icons text-danger">&#xE879;</i> {{ __('Logout') }}
                    </a>
                  </div>
                </li>

              </ul>
              <nav class="nav">
                <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left" data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
                  <i class="material-icons">&#xE5D2;</i>
                </a>
              </nav>
            </nav>
          </div>
          <!-- / .main-navbar -->
          <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4 mb-4 border-bottom">
              <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">@yield('title')</span>
                <h3 class="page-title">@yield('sub')</h3>
              </div>
            </div>
            <!-- End Page Header -->
           @yield('konten')
          </div>

          <!-- footer -->
          <footer class="main-footer d-flex p-2 px-3 bg-white border-top">
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
              </li>
            </ul>
            <span class="copyright ml-auto my-auto mr-2">Copyright &copy {{date('Y')}}
              <a href="http://al-faqar.bwa.id:88/intranet/login" rel="nofollow">Team IT BWA</a>
            </span>
          </footer>
        </main>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="{{url('public/js/jquery.inputmask.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script> -->
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
    <script src="{{url('scripts/extras.1.1.0.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <!-- <script src="{{url('scripts/shards-dashboards.1.1.0.min.js')}}"></script> -->
    <!-- <script src="{{url('scripts/app/app-blog-overview.1.1.0.js')}}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>
    <script>
      window.setTimeout("waktu()", 1000);

      function waktu(){
        var waktu = new Date();
        setTimeout("waktu()", 1000);
        document.getElementById("jam").innerHTML = waktu.getHours();
        document.getElementById("menit").innerHTML = waktu.getMinutes();
        document.getElementById("detik").innerHTML = waktu.getSeconds();
      }
    </script>
    @yield('scriptExternal')
    @stack('scripts')
  </body>
</html>