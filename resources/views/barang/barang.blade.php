@extends('templates.main')

@section('title','Overview')
@section('sub','Data Stock Barang')

@section('konten')
@if(Auth::user()->level == 'admin')
<a href="{{route('addbarang')}}" class="btn btn-outline-primary mb-3"><i class="fas fa-plus-square"></i> Tambah data</a>
<a href="{{route('addkategori')}}" class="btn btn-outline-warning mb-3"><i class="fas fa-random"></i> Tambah Kategori</a>
@endif
@if(session('successkategori'))
<div class="alert alert-success">
  {{session('successkategori')}}
</div>
@endif
@if(session('success'))
<div class="alert alert-success">
  {{session('success')}}
</div>
@endif
@if(session('deletekategori'))
<div class="alert alert-danger">
  {{session('deletekategori')}}
</div>
@endif
@if(session('delete'))
<div class="alert alert-danger">
  {{session('delete')}}
</div>
@endif
@if(session('updatekategori'))
<div class="alert alert-info">
  {{session('updatekategori')}}
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
                    <h6 class="m-0 d-inline">Data Stock barang</h6>
                    <!-- search  -->
                     <form action="{{route('caribarang')}}" class="main-sidebar__search border-left d-sm-flex float-right">
                      <div class="input-group input-group-seamless ml-3">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-search"></i>
                          </div>
                        </div>
                        <input name="cari" class="navbar-search form-control" type="text" placeholder="Cari barang..." aria-label="Search"> </div>
                    </form>
                    <!-- end search  -->
                  </div>
                  <div class="card-body p-0 pb-3 ">
                    <table class="table mb-0">
                      <thead class="bg-light">
                        <tr>
                          <th scope="col" class="border-0">#</th>
                          <th scope="col" class="border-0">Nama Barang</th>
                          <th scope="col" class="border-0">Foto Barang</th>
                          <th scope="col" class="border-0">Stock Barang</th>
                          <th scope="col" class="border-0">Harga Jual</th>
                          <th scope="col" class="border-0"><i class="fas fa-cogs"></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- looping table -->
                        @foreach($join as $joins)
                          <td class="bg-dark text-white" colspan="6">
                          @if($joins->id_kategori == $joins->kategori_barang)
                          Kategori : <span class='text-info'>{{$joins->nama_kategori}}</span> 
                          @endif
                          @if(Auth::user()->level == 'admin')
                          <a href="{{url('barang/kategori/edit/'.$joins->id_kategori)}}" class="btn btn-outline-info"><i class="fas fa-edit"> Edit</i></a>
                          <form action="{{url('barang/kategori/hapus/'.$joins->id_kategori)}}" class="d-inline" method="post">
                          @method('delete')
                          @csrf
                            <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"> Hapus</i></button>
                          </form>
                          @endif
                          </td>
                        <tr> 
                          <td>{{$loop->iteration}}</td>
                          <td>{{$joins->nama_barang}}</td>
                          <td>
                            @if($joins->foto_barang)
                            <img src="{{url('images/barang/'.$joins->foto_barang)}}" alt="" width="50">
                            @else                          
                            <img src="{{url('images/avatars/dummy.jpg')}}" alt="" width="50">
                            @endif
                          </td>
                          <td>{{$joins->stock_barang}} Pcs</td>
                          <td>Rp.{{$joins->harga_jual}}</td>
                          <td>
                              <a href="{{url('barang/edit/'.$joins->id_barang)}}" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i>Edit</a>
                              <form action="{{url('barang/delete/'.$joins->id_barang)}}" method="post" class="d-inline">
                              @method('delete')
                              @csrf
                                <button href="" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i>Hapus</button>
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
