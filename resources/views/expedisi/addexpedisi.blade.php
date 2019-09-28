@extends('templates.main')

@section('title','Fungsi Add')
@section('sub','Master Expedisi')

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
                         <!-- kode customer  -->
                        <div class="col-5 ml-auto">
                            <span>Kode Expedisi</span><input type="text" class="form-control float-right" id="kode" value="{{$kode}}" readonly>
                        </div>
                     </div>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <form action="{{route('storeexpedisi')}}" method="post">
                        @csrf
                        <input type="hidden" name="kode_expedisi" id="" value="{{$kode}}">
                            <div class="form-group">
                                <div class="form-group ">
                                    <label class="d-block" for="expedisi">Nama Expedisi</label>
                                    <input type="text" class="@error('nama_expedisi') is-invalid @enderror form-control" id="expedisi" name="nama_expedisi" focus> 
                                    @error('nama_expedisi')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                           
                            <div class="form-group ">
                                <button class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button> 
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