<!doctype html>
<html class="no-js h-100" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Rumah Cemilan Sehat</title>
    <meta name="description" content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/v4-shims.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0" href="{{url('styles/shards-dashboards.1.1.0.min.css')}}">
    <link rel="stylesheet" href="{{url('styles/extras.1.1.0.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </head>
  <body class="h-100">
  
    
    <div class="container-fluid">
      <div class="row">
        <!-- Main Sidebar -->
        <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
          <div class="main-navbar">
            <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
              <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                <div class="d-table m-auto">
                  <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="{{url('images/shards-dashboards-logo.svg')}}" alt="Shards Dashboard">
                  <span class="d-none d-md-inline ml-1">Rumah Cemilan Sehat</span>
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
                <a @if($halaman == 'keuangan') class="nav-link active" @else class="nav-link" @endif href="#">
                  <i class="material-icons">account_balance_wallet</i>
                  <span>Data keuangan</span>
                </a>
              </li>
              <li class="nav-item">
                <a @if($halaman == 'barang') class="nav-link active" @else class="nav-link" @endif href="{{route('barang')}}">
                  <i class="material-icons">add_shopping_cart</i>
                  <span>Add Stock</span>
                </a>
              </li>
              <li class="nav-item">
                <a @if($halaman == 'customer') class="nav-link active" @else class="nav-link" @endif href="{{route('customer')}}">
                  <i class="material-icons">supervised_user_circle</i>
                  <span>Master customer</span>
                </a>
              </li>
              <li class="nav-item">
                <a @if($halaman == 'vendor') class="nav-link active" @else class="nav-link" @endif href="{{route('vendor')}}">
                  <i class="material-icons">storefront</i>
                  <span>Master vendor</span>
                </a>
              </li>
              <li class="nav-item">
                <a @if($halaman == 'expedisi') class="nav-link active" @else class="nav-link" @endif href="{{route('expedisi')}}">
                  <i class="material-icons">local_shipping</i>
                  <span>Master Expedisi</span>
                </a>
              </li>
              <li class="nav-item">
                <a @if($halaman == 'ecommerce') class="nav-link active" @else class="nav-link" @endif href="{{route('ecommerce')}}">
                  <i class="material-icons">storefront</i>
                  <span>Master E-Commerce</span>
                </a>
              </li>
              <li class="nav-item">
                <a @if($halaman == 'reseller') class="nav-link active" @else class="nav-link" @endif href="{{route('reseller')}}">
                  <i class="material-icons">recent_actors</i>
                  <span>Reseller</span>
                </a>
              </li>
              <li class="nav-item">
                <a @if($halaman == 'order') class="nav-link active" @else class="nav-link" @endif href="{{route('order')}}">
                  <i class="material-icons">business_center</i>
                  <span>Order</span>
                </a>
              </li>
              <li class="nav-item">
                <a @if($halaman == 'status_order') class="nav-link active" @else class="nav-link" @endif href="{{route('status_order')}}">
                  <i class="material-icons">timelapse</i>
                  <span>Status Order</span>
                </a>
              </li>
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
                      <i class="fas fa-search"></i>
                    </div>
                  </div>
                  <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
              </form>
              <ul class="navbar-nav border-left flex-row ">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    @if(Auth::user()->foto)
                    <img class="user-avatar rounded-circle mr-2" src="{{ url('images/avatars/'.Auth::user()->foto)}}">
                    @else
                    <img class="user-avatar rounded-circle mr-2" src="{{url('images/avatars/dummy.jpg')}}">
                    @endif
                    <span class="d-none d-md-inline-block">Selamat datang {{Auth::user()->nama_akun}}</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-small">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="material-icons text-danger">&#xE879;</i> {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                       @csrf
                    </form>
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
            <div class="page-header row no-gutters py-4">
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
            <span class="copyright ml-auto my-auto mr-2">Copyright &copy 2019
              <a href="https://reyhanhamami.000webhostapp.com" rel="nofollow">Reyhan</a>
            </span>
          </footer>
        </main>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
    <script src="{{url('scripts/extras.1.1.0.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script src="{{url('scripts/shards-dashboards.1.1.0.min.js')}}"></script>
    <script src="{{url('scripts/app/app-blog-overview.1.1.0.js')}}"></script>
    @yield('scriptExternal')
  </body>
</html>