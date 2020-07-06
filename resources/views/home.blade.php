@extends('templates.main')

    @section('title','Dashboard')

    @section('sub','Data')

    @section('konten')
    <div class="col col-md-12 col-sm-12 mb-4">
      <div class="card card-small">
        <div class="card-header border-bottom">
          <h6 class="m-0">Shortcut</h6>
        </div>
        <div class="card-body p-0">
          <div class="container my-3">
            <h6 class="text-center text-success"><i class="fas fa-plus-circle"></i> Tambah data</h6>
            <div class="row ">
              <div class="col justify-content-center d-flex">
                <a href="{{route('donasi')}}" class="btn btn-success btn-sm mr-2"><i class="fas fa-plus"></i> Add Donasi</a>
                <a href="" class="btn btn-success btn-sm mr-2 disabled"><i class="fas fa-plus"></i> Add Program</a>
                <a href="" class="btn btn-success btn-sm mr-2 disabled"><i class="fas fa-plus"></i> Add Project</a>
                <a href="" class="btn btn-success btn-sm mr-2 disabled"><i class="fas fa-plus"></i> Add Jaringan</a>
                <a href="" class="btn btn-success btn-sm mr-2 disabled"><i class="fas fa-plus"></i> Add Kas</a>
                <a href="" class="btn btn-success btn-sm mr-2 disabled"><i class="fas fa-plus"></i> Add User</a>
                <a href="{{route('inputtransfer')}}" class="btn btn-success btn-sm mr-2"><i class="fas fa-plus"></i> Add bukti trf EDC</a>
              </div>
            </div>
            <h6 class="text-center text-danger mt-3"><i class="fas fa-book"></i> Lihat Data</h6>
            <div class="row ">
              <div class="col justify-content-center d-flex">
                <a href="{{route('tabledonasi')}}" class="btn btn-danger btn-sm text-white mr-2"><i class="fas fa-eye"></i> Donasi</a>
                <a href="" class="btn btn-danger btn-sm text-white mr-2 disabled"><i class="fas fa-eye"></i> Donasi Per Rekening</a>
                <a href="" class="btn btn-danger btn-sm text-white mr-2 disabled"><i class="fas fa-eye"></i> Donasi Per Jaringan</a>
                <a href="" class="btn btn-danger btn-sm text-white mr-2 disabled"><i class="fas fa-eye"></i> Donasi Per Fundraiser</a>
                <a href="" class="btn btn-danger btn-sm text-white mr-2 disabled"><i class="fas fa-eye"></i> Donasi Per Project</a>
                <a href="{{route('verifikasi')}}" class="btn btn-danger btn-sm text-white mr-2"><i class="fas fa-eye"></i> Donasi Per EDC</a>
                <a href="{{route('buktitransfer')}}" class="btn btn-danger btn-sm text-white mr-2"><i class="fas fa-eye"></i> Bukti Transfer</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-lg-2 col-md-2 col-sm-2 mb-4 justify-content-center d-flex">
          <a href="{{route('wakif')}}" class="stats-small stats-small--1 card card-small btn btn-light">
            <div class="card-body p-0 d-flex">
              <div class="d-flex flex-column m-auto">
              <i class="fas fa-users text-primary"></i>
                <div class="stats-small__data text-center">
                  <span class="stats-small__label text-uppercase text-primary">Jumlah Seluruh Wakif</span>
                </div>
                <div class="stats-small__data mt-2">
                  <!-- <i class="text-primary"><?= number_format($wakif) ?></i> -->
                </div>
              </div>
              <canvas height="76" class="blog-overview-stats-small-1 chartjs-render-monitor" style="display: block; width: 191px; height: 76px;" width="191"></canvas>
            </div>
          </a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 mb-4">
          <a href="{{route('tabledonasi')}}" class="stats-small stats-small--1 card card-small btn btn-light">
            <div class="card-body p-0 d-flex">
              <div class="d-flex flex-column m-auto">
              <i class="fas fa-hand-holding-usd text-primary"></i>
                <div class="stats-small__data text-center">
                  <span class="stats-small__label text-uppercase text-primary">Total donasi Tahun <?= date('Y') ?></span>
                </div>
                <div class="stats-small__data mt-2">
                  <!-- <i class="text-primary">Rp. <?= number_format($jmh) ?></i> -->
                </div>
              </div>
              <canvas height="80" class="blog-overview-stats-small-2 chartjs-render-monitor" style="display: block; width: 191px; height: 76px;" width="191"></canvas>
            </div>
          </a>
        </div>
        </div>
    </div>
    @endsection
