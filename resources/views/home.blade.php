@extends('templates.main')

    @section('title','Dashboard')

    @section('sub','Data Penjualan')

    @section('konten')
     <!-- Small Stats Blocks -->
            <div class="row">
              <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Stock Produk</span>
                        <i class="fas fa-tags"></i>
                        <h6 class="stats-small__value count my-3">2,390</h6>
                      </div>
                      <div class="stats-small__data">
                        <span class="stats-small__percentage stats-small__percentage--increase">4.7%</span>
                      </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-1"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Total Produk</span>
                        <i class="fas fa-cubes"></i>
                        <h6 class="stats-small__value count my-3">182</h6>
                      </div>
                      <div class="stats-small__data">
                        <span class="stats-small__percentage stats-small__percentage--increase">12.4%</span>
                      </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-2"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg col-md-4 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Total Utang Reseller</span>
                        <i class="fas fa-balance-scale"></i>
                        <h6 class="stats-small__value count my-3">20.128,147</h6>
                      </div>
                      <div class="stats-small__data">
                        <span class="stats-small__percentage stats-small__percentage--decrease">3.8%</span>
                      </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-3"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg col-md-4 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Packing</span>
                        <i class="fas fa-hand-holding-heart"></i>
                        <h6 class="stats-small__value count my-3">1,413</h6>
                      </div>
                      <div class="stats-small__data">
                        <span class="stats-small__percentage stats-small__percentage--increase">12.4%</span>
                      </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-4"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg col-md-4 col-sm-12 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Pesanan belum selesai</span>
                        <i class="fas fa-truck-loading"></i>
                        <h6 class="stats-small__value count my-3">17,281</h6>
                      </div>
                      <div class="stats-small__data">
                        <span class="stats-small__percentage stats-small__percentage--decrease">2.4%</span>
                      </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-5"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Small Stats Blocks section 1-->
            <!-- start section 2  -->
            <div class="row">

              <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Notif Pembayaran Reseller</span>
                      </div>
                      <div class="nav-link-icon__wrapper text-center">
                        <i class="fas fa-wallet"></i>
                        <span class="badge badge-pill badge-info">2</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Pesanan telah selesai</span>
                      </div>
                      <div class="nav-link-icon__wrapper text-center">
                        <i class="fas fa-truck-loading"></i>
                        <span class="badge badge-pill badge-success">5</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
               
            </div><!-- end row  section 2-->

            <div class="row">
              <!-- Top Referrals Component section 3-->
              <div class="col-12 mb-4">
                <div class="card shadow">
                  <div class="card-header border-bottom">
                    <h6 class="m-0 d-inline">List Reseller</h6>
                    <!-- search  -->
                     <form action="#" class="main-sidebar__search border-left d-sm-flex float-right">
                      <div class="input-group input-group-seamless ml-3">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-search"></i>
                          </div>
                        </div>
                        <input class="navbar-search form-control" type="text" placeholder="Cari Reseller..." aria-label="Search"> </div>
                    </form>
                    <!-- end search  -->
                  </div>
                  <div class="card-body p-0">
                    <ul class="list-group list-group-small list-group-flush">
                      <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">warungSebelah</span>
                        <span class="ml-auto text-right text-semibold text-reagent-gray">depok</span>
                      </li>
                      <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">Kelontongan</span>
                        <span class="text-semibold text-fiord-blue ml-2">Total Hutang : Rp.200.000</span>
                        <span class="ml-auto text-right text-semibold text-reagent-gray">Jakarta Timur</span>
                        <a href="#" class="ml-2 text-right text-danger">Tagih</a>
                      </li>
                      <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">Gretongan</span>
                        <span class="ml-auto text-right text-semibold text-reagent-gray">Jakarta Selatan</span>
                      </li>
                      <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">TokoAja</span>
                        <span class="ml-auto text-right text-semibold text-reagent-gray">Pekayon</span>
                      </li>
                      <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">GelarLapak</span>
                        <span class="ml-auto text-right text-semibold text-reagent-gray">Cibubur</span>
                      </li>
                      <li class="list-group-item d-flex px-3">
                        <span class="text-semibold text-fiord-blue">KakiLima</span>
                        <span class="ml-auto text-right text-semibold text-reagent-gray">Jogja</span>
                      </li>
                    </ul>
                  </div>
                  <div class="card-footer border-top">
                    <div class="row">
                      <div class="col">
                        <select class="custom-select custom-select-sm">
                          <option selected>Last Week</option>
                          <option value="1">Today</option>
                          <option value="2">Last Month</option>
                          <option value="3">Last Year</option>
                        </select>
                      </div>
                      <div class="col text-right view-report">
                        <a href="#">Full report &rarr;</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Top Referrals Component section 3-->
            </div>
    @endsection
