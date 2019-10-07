@extends('templates.main')

@section('title','Overview')
@section('sub','Data Vendor')

@section('konten')
<a href="{{route('addvendor')}}" class="btn btn-outline-primary mb-3"><i class="fas fa-plus-square"></i> Tambah data</a>
      @if(session('success'))
        <div class="alert alert-success">
          {{session('success')}}
        </div>
      @endif
      @if(session('delete'))
        <div class="alert alert-danger">
          {{session('delete')}}
        </div>
      @endif
      @if(session('update'))
        <div class="alert alert-info">
          {{session('update')}}
        </div>
      @endif
      <!-- Default Light Table -->
            <div class="row">
              <div class="col">
                <div class="card card-small mb-4">
                  <div class="card-header border-bottom">
                    <h6 class="m-0 d-inline">Data Vendor</h6>
                    <!-- search  -->
                     <form action="{{route('carivendor')}}" class="main-sidebar__search border-left d-sm-flex float-right" method="get">
                      <div class="input-group input-group-seamless ml-3">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-search"></i>
                          </div>
                        </div>
                        <input class="navbar-search form-control" value="{{ old('cari')}}" name="cari" type="text" placeholder="Cari Vendor..." aria-label="Search"> </div>
                    </form>
                    <!-- end search  -->
                  </div>
                  <div class="card-body p-0 pb-3 ">
                    <table class="table mb-0 table-responsive-xl">
                      <thead class="bg-light">
                        <tr>
                          <th scope="col" class="border-0">Nama</th>
                          <th scope="col" class="border-0">Telepon</th>
                          <th scope="col" class="border-0">Alamat</th>
                          <th scope="col" class="border-0">Barang</th>
                          <th scope="col" class="border-0">Stock</th>
                          <th scope="col" class="border-0">Harga Beli</th>
                          <th scope="col" class="border-0">Harga Jual</th>
                          <th scope="col" class="border-0"><i class="fas fa-cogs"></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- looping table -->
                        @foreach($vendor as $ven)
                        <tr>
                         <td>{{$ven->nama_vendor}}</td>
                         <td>{{$ven->telepon_vendor}}</td>
                         <td>{{$ven->alamat_vendor}}</td>
                         <td>{{$ven->nama_barang}}</td>
                         <td>{{$ven->jumlah_barang}}</td>
                         <td>Rp. {{$ven->harga_beli}}</td>
                         <td>Rp. {{$ven->harga_jual}}</td>
                          <td>
                              <a href="{{url('vendor/edit/'.$ven->id_vendor)}}" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i>Edit</a>
                              <form action="{{url('vendor/'.$ven->id_vendor)}}" class="d-inline" method="post">
                              @method('delete')
                              @csrf
                                <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i>Hapus</button>
                              </form>
                          </td>
                        </tr>
                        @endforeach
                        <!-- end looping  -->
                      </tbody>
                      <tfoot>
                      </tfoot>

                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Default Light Table -->
@endsection('konten')
