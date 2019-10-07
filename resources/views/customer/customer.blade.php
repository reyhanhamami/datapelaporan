@extends('templates.main')

@section('title','Overview')
@section('sub','Data Customer')

@section('konten')
<a href="{{route('addcustomer')}}" class="btn btn-outline-primary mb-3"><i class="fas fa-plus-square"></i> Tambah data</a>
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
                    <h6 class="m-0 d-inline">Data Customer</h6>
                    <!-- search  -->
                     <form action="{{route('caricustomer')}}" class="main-sidebar__search border-left d-sm-flex float-right" method="get">
                      <div class="input-group input-group-seamless ml-3">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-search"></i>
                          </div>
                        </div>
                        <input class="navbar-search form-control" value="{{$customer->cari ?? old('cari')}}" name="cari" type="text" placeholder="Cari Customer..." aria-label="Search"> </div>
                    </form>
                    <!-- end search  -->
                  </div>
                  <div class="card-body p-0 pb-3 ">
                    <table class="table mb-0 table-responsive-md">
                      <thead class="bg-light">
                        <tr>
                          <th scope="col" class="border-0">Kode</th>
                          <th scope="col" class="border-0">Nama</th>
                          <th scope="col" class="border-0">Telepon</th>
                          <th scope="col" class="border-0">Alamat</th>
                          <th scope="col" class="border-0">Kode pos</th>
                          <th scope="col" class="border-0"><i class="fas fa-cogs"></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- looping table -->
                        @foreach($customer as $c)
                        @if($c->kode_customer == 'CUS001')
                        @else
                        <tr>
                          <td>{{$c->kode_customer}}</td>
                          <td>{{$c->nama_customer}}</td>
                          <td>{{$c->telepon_customer}}</td>
                          <td >{{$c->alamat_customer}} Kel. {{$c->kelurahan_customer}} Kec. {{$c->kecamatan_customer}} Kota/Kab. {{$c->kota_customer}} Provinsi {{$c->provinsi_customer}}</td>
                          <td>{{$c->kodepos_customer}}</td>
                          <td>
                              <a href="{{url('customer/edit/'.$c->id_customer)}}" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i>Edit</a>
                              <form action="{{url('customer/'.$c->id_customer)}}" class="d-inline" method="post">
                              @method('delete')
                              @csrf
                                <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i>Hapus</button>
                              </form>
                          </td>
                        </tr>
                        @endif
                        @endforeach
                        <!-- end looping  -->
                      </tbody>
                      <tfoot>
                      {{$customer->links()}}
                      </tfoot>

                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Default Light Table -->
@endsection('konten')
