@extends('templates.main')

    @section('title','Dashboard')

    @section('sub','Data Notifikasi pembayaran reseller')

    @section('konten')

    @if(session('update'))
    <div class="alert alert-success">
      {{session('update')}}
    </div>
    @endif

            @if(Auth::user()->level == 'reseller')
            <div class="row">
              <!-- Reseller hutang-->
              <div class="col-12 mb-4">
                <div class="card shadow">
                  <div class="card-header border-bottom">
                    <h6 class="m-0 d-inline">
                    Data Notifikasi pembayaran reseller
                    </h6>
                  </div>
                  <div class="card-body p-0">
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Reseller</th>
                        <th scope="col">Nama Toko</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">No Order</th>
                        <th scope="col">Hutang</th>
                        <th scope="col"><i class="fas fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($join as $or)
                        @if($or->input_bukti and $or->foto_bukti)
                        <tr>
                        <!-- looping hutang  -->
                        <td>{{$loop->iteration}}</td>
                        <td>{{$or->name}}</td>
                        <td>{{$or->nama_akun}}</td>
                        <td>{{$or->tanggal_order}}</td>
                        <td>{{$or->id_order}}</td>
                        <td class="font-weight-bold">Rp.{{number_format($or->total)}}</td>
                        <td><a href="{{url('/keuangan/validasipembayaran/'.$or->id_pembayaran)}}" class="btn btn-warning"><i class="fas fa-spinner"> Proses validasi</i></a></td>
                        <!-- end looping hutang  -->
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    </table>
                  </div>
            
                </div>
              </div>
              <!-- End reseller hutang-->
            </div>
            @endif

    @endsection
