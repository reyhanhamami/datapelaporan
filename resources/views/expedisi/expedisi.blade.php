@extends('templates.main')

@section('title','Overview')
@section('sub','Data Expedisi')

@section('konten')
<a href="{{route('addexpedisi')}}" class="btn btn-outline-primary mb-3"><i class="fas fa-plus-square"></i> Tambah data</a>
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
                    <h6 class="m-0 d-inline">Data Expedisi</h6>
                    <!-- search  -->
                     <!-- <form action="#" class="main-sidebar__search border-left d-sm-flex float-right">
                      <div class="input-group input-group-seamless ml-3">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-search"></i>
                          </div>
                        </div>
                        <input class="navbar-search form-control" type="text" placeholder="Cari Reseller..." aria-label="Search"> </div>
                    </form> -->
                    <!-- end search  -->
                  </div>
                  <div class="card-body p-0 pb-3">
                    <table class="table mb-0">
                      <thead class="bg-light">
                        <tr>
                          <th scope="col" class="border-0">#</th>
                          <th scope="col" class="border-0">Kode Expedisi</th>
                          <th scope="col" class="border-0">Nama Expedisi</th>
                          <th scope="col" class="border-0"><i class="fas fa-cogs"></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- looping table -->
                        @foreach($expedisi as $e)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$e->kode_expedisi}}</td>
                          <td>{{$e->nama_expedisi}}</td>
                          <td>
                              <a href="{{url('expedisi/'.$e->id_expedisi)}}" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i>Edit</a>
                              <form action="expedisi/{{$e->id_expedisi}}" class="d-inline" method="post">
                              @method('delete')
                              @csrf
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
