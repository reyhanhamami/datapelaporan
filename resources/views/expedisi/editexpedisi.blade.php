@extends('templates.main')

@section('title','Fungsi Edit')
@section('sub','Master Expedisi')

@section('konten')
    <div class="row">
        <div class="container">
            <div class="col-md-10 col-sm-12 mx-auto">
                <div class="card">
                  <div class="card-header border-bottom">
                    <h6>Form Edit</h6>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <form action="{{url('expedisi/edit/'.$expedisi->id_expedisi)}}" method="post">
                        @method('patch')
                        @csrf
                            <div class="form-group">
                                <div class="form-group ">
                                    <label class="d-block" for="expedisi">Nama Expedisi</label>
                                    <input type="text" class="@error('nama_expedisi') is-invalid @enderror form-control" id="expedisi" name="nama_expedisi" value="{{$expedisi->nama_expedisi}}"> 
                                    @error('nama_expedisi')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                           
                            <div class="form-group ">
                                <button class="btn btn-primary btn-sm"><i class="fas fa-clipboard"></i> Edit</button> 
                                <a href="{{route('expedisi')}}" class="btn btn-warning text-white btn-sm"><i class="fas fa-undo"></i> Kembali</a> 
                            </div>

                          </form>
                    </li>
                  </ul>
                </div>
            </div>
        </div>
    </div>
@endsection('konten')