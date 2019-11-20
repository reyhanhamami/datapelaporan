@extends('templates.main')

@section('title','Overview')
@section('sub','Proses Packing')

@section('konten')
<div class="row">
        <div class="container">
            <div class="col-md-10 col-sm-12 mx-auto">
                <div class="card">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                    <a href="{{route('status_order')}}" class="btn btn-warning float-right mb-3"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
                        <form action="{{url('status_order/inputresi/'.$order->id_order)}}" method="post">
                        @method('patch')
                        @csrf
                            <div class="form-group">
                                <div class="form-group ">
                                    <label class="d-block" for="resiotomatis_order">Input Resi</label>
                                    <input type="text" class="@error('resiotomatis_order') is-invalid @enderror form-control" id="resiotomatis_order" name="resiotomatis_order"> 
                                    @error('resiotomatis_order')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                           
                            <div class="form-group ">
                                <button class="btn btn-primary btn-sm">Next <i class="fas fa-long-arrow-alt-right"></i></button> 
                            </div>

                          </form>
                    </li>
                  </ul>
                </div>
            </div>
        </div>
    </div>
           
@endsection('konten')
