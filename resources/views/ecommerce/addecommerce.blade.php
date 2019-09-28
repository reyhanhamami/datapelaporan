@extends('templates.main')

@section('title','Fungsi Add')
@section('sub','Master E-Commerce')

@section('konten')
    <div class="row">
        <div class="container">
            <div class="col-md-10 col-sm-12 mx-auto">
                <div class="card">
                  <div class="card-header border-bottom">
                    <div class="form-group row">
                            <div class="col-4">
                                <h6>Form Inputs</h6>
                            </div>
                            <!-- kode ecommerce  -->
                            <div class="col-5 ml-auto">
                                <span>Kode Ecommerce</span><input type="text" class="form-control float-right" id="kode" value="{{$kode}}" readonly>
                            </div>
                     </div>
                </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <form action="{{route('store')}}" method="post">
                        @csrf
                        <input type="hidden" name="kode_ecommerce" id="" value="{{$kode}}">
                            <div class="form-group">
                                <div class="form-group ">
                                    <label class="d-block" for="ecommerce">Nama E-Commerce</label>
                                    <input type="text" class="@error('nama_ecommerce') is-invalid @enderror form-control" id="ecommerce" name="nama_ecommerce" focus> 
                                    @error('nama_ecommerce')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                           
                            <div class="form-group ">
                                <button class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button> 
                                <a href="{{route('ecommerce')}}" class="btn btn-warning text-white btn-sm"><i class="fas fa-undo"></i> Kembali</a> 
                            </div>

                          </form>
                    </li>
                  </ul>
                </div>
            </div>
        </div>
    </div>
@endsection('konten')