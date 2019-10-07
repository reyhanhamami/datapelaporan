@extends('templates.main')

@section('title','Overview')
@section('sub','Data Reseller')

@section('konten')
<a href="{{route('registerreseller')}}" class="btn btn-primary mb-3"><i class="fas fa-user-plus"></i> Create Account Login</a>
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
                    <h6 class="m-0 d-inline">Data Reseller</h6>
                    <!-- search  -->
                     <form action="{{url('/reseller/cari')}}" class="main-sidebar__search border-left d-sm-flex float-right">
                      <div class="input-group input-group-seamless ml-3">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-search"></i>
                          </div>
                        </div>
                        <input class="navbar-search form-control" value="{{ old('cari') }}" type="text" name="cari" placeholder="Cari Reseller..." aria-label="Search"> </div>
                    </form>
                    <!-- end search  -->
                  </div>
                  <div class="card-body p-0 pb-3 text-center table-responsive">
                    <table class="table mb-0 ">
                      <thead class="bg-light">
                        <tr>
                          <th scope="col" class="border-0">#</th>
                          <th scope="col" class="border-0">Nama</th>
                          <th scope="col" class="border-0">Nama Toko</th>
                          <th scope="col" class="border-0">Email</th>
                          <th scope="col" class="border-0">No.Telepon</th>
                          <th scope="col" class="border-0">Foto</th>
                          <th scope="col" class="border-0">Role</th>
                          <th scope="col" class="border-0"><i class="fas fa-cogs"></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- looping table -->
                        @foreach($user as $u)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$u->name}}</td>
                          <td>{{$u->nama_akun}}</td>
                          <td>{{$u->email}}</td>
                          <td>{{$u->telepon}}</td>
                          <td>
                            @if($u->foto)
                            <img src="{{asset('images/avatars/'.$u->foto)}}" alt="Tidak ada gambar" width="100">
                            @else
                            <img src="{{asset('images/avatars/dummy.jpg')}}" alt="Tidak ada gambar" width="100">
                            @endif
                          </td>
                          <td>{{$u->level}}</td>
                          <td>
                              <a href="{{url('reseller/edit/'.$u->id)}}" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i>Edit</a>
                              @if($u->id != 1)
                              <form action="{{url('reseller/'.$u->id)}}" class="d-inline" method="post">
                              @method('delete')
                              @csrf
                                <button href="" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i>Hapus</button>
                              </form>
                              @endif
                          </td>
                        </tr>
                        @endforeach
                        <!-- end looping  -->
                      </tbody>
                    </table>
                    <div class="text-xs-center">
                      {{$user->links()}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Default Light Table -->
@endsection('konten')
