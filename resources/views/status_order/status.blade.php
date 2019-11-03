@extends('templates.main')

@section('title','Overview')
@section('sub','Status Order Customer')

@section('konten')
<!-- <a href="{{route('add')}}" class="btn btn-outline-primary mb-3"><i class="fas fa-plus-square"></i> Tambah data</a> -->
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
                    <h6 class="m-0 d-inline">Status Order Customer</h6>
                
                  </div>
                  <div class="card-body p-0 pb-3 ">
                    <table class="table mb-0">
                      <thead class="bg-light">
                        <tr>
                          <th scope="col" class="border-0">#</th>
                          <th scope="col" class="border-0">Tanggal Order</th>
                          <th scope="col" class="border-0">Data Customer</th>
                          <th scope="col" class="border-0">Order barang</th>
                          <th scope="col" class="border-0">Status packing</th>
                          <th scope="col" class="border-0">Foto packing</th>
                          <th scope="col" class="border-0"><i class="fas fa-cogs"></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- looping table -->
                        @foreach($order as $as)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$as->tanggal_order}}</td>
                          <td>{{$as->customer->nama_customer}}</td>
                          <td>
                            <ul>
                            @foreach($as->barang as $bar)
                              <li>{{$bar->nama_barang}}</li>
                            @endforeach
                            </ul>
                        
                          </td>
                          <td><i class="fas fa-circle text-danger"></i> Belum dipacking</td>
                          <td><img src="{{url('images/avatars/foto.png')}}" width="70"></td>
                          <td>
                              <a href="#" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i>Edit</a>
                              <a href="#" class="btn btn-outline-primary btn-sm"><i class="fas fa-info-circle"></i>Detail</a>
                              <form action="" method="post" class="d-inline">
                              @csrf 
                              @method('delete')
                                <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i>Hapus</button>
                              </form>
                          </td>
                        </tr>
                        @endforeach
                        <!-- end looping  -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Default Light Table -->
@endsection('konten')
