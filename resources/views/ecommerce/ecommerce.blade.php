@extends('templates.main')

@section('title','Overview')
@section('sub','Data E-Commerce')

@section('konten')
<a href="{{route('add')}}" class="btn btn-outline-primary mb-3"><i class="fas fa-plus-square"></i> Tambah data</a>
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
                    <h6 class="m-0 d-inline">Data E-Commerce</h6>
                
                  </div>
                  <div class="card-body p-0 pb-3 ">
                    <table class="table mb-0">
                      <thead class="bg-light">
                        <tr>
                          <th scope="col" class="border-0">#</th>
                          <th scope="col" class="border-0">Kode E-Commerce</th>
                          <th scope="col" class="border-0">Nama E-Commerce</th>
                          <th scope="col" class="border-0"><i class="fas fa-cogs"></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- looping table -->
                        @foreach($ecommerce as $e)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$e->kode_ecommerce}}</td>
                          <td>{{$e->nama_ecommerce}}</td>
                          <td>
                              <a href="ecommerce/edit/{{$e->id_ecommerce}}" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i>Edit</a>
                              <form action="ecommerce/{{$e->id_ecommerce}}" method="post" class="d-inline">
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
