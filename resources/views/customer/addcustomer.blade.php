@extends('templates.main')

@section('title','Fungsi Add')
@section('sub','Master Customer')

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
                        <span>Kode Customer</span><input type="text" class="form-control float-right" id="kode" value="{{$kode}}" readonly>
                    </div>
                </div>   
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <form action="{{route('storecustomer')}}" method="post">
                        @csrf
                        <input type="hidden" value="{{$kode}}" name="kode_customer">
                            <div class="form-row">
                                <div class="col-xl-6 col-md-7">
                                    <label class="d-block" for="customer">Nama Customer</label>
                                    <input type="text" value="{{old('nama_customer')}}" class="@error('nama_customer') is-invalid @enderror form-control" id="customer" name="nama_customer" focus> 
                                    @error('nama_customer')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-xl-6 col-md-5">
                                    <label class="d-block" for="telepon">No Telepon</label>
                                    <input value="{{old('telepon_customer')}}" type="text" class="@error('telepon_customer') is-invalid @enderror form-control" id="telepon" name="telepon_customer" focus> 
                                    @error('telepon_customer')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                                <div class="form-row ">
                                    <!-- alamat  -->
                                    <div class="col-xl-10">
                                    <label class="d-block" for="alamat">Alamat</label>
                                    <input type="text" value="{{old('alamat_customer')}}" name="alamat_customer" class="@error('alamat_customer') is-invalid @enderror form-control" id="alamat">
                                    @error('alamat_customer')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                    </div>
                                    <!-- provinsi -->
                                    <div class="col-xl-2">
                                    <label class="d-block" for="provinsi">Provinsi</label>
                                    <input type="text" value="{{old('provinsi_customer')}}" name="provinsi_customer" class="@error('provinsi_customer') is-invalid @enderror form-control" id="provinsi">
                                    @error('provinsi_customer')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-3 col-sm-6">
                                        <label class="d-block" for="kelurahan">kelurahan</label>
                                        <input type="text" value="{{old('kelurahan_customer')}}" name="kelurahan_customer" class="@error('kelurahan_customer') is-invalid @enderror form-control" id="kelurahan">
                                        @error('kelurahan_customer')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-xl-3 col-sm-6">
                                        <label class="d-block" for="kecamatan">kecamatan</label>
                                        <input type="text" value="{{old('kecamatan_customer')}}" name="kecamatan_customer" class="@error('kecamatan_customer') is-invalid @enderror form-control" id="kecamatan">
                                        @error('kecamatan_customer')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>  
                                    <div class="col-xl-3 col-sm-6">
                                        <label class="d-block" for="kota">kota</label>
                                        <input type="text" value="{{old('kota_customer')}}" name="kota_customer" class="@error('kota_customer') is-invalid @enderror form-control" id="kota">
                                        @error('kota_customer')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>  
                                    <div class="col-xl-3 col-sm-6">
                                        <label class="d-block" for="telepon">Kode pos</label>
                                        <input value="{{old('kodepos_customer')}}" type="number" class="@error('kodepos_customer') is-invalid @enderror form-control" id="telepon" name="kodepos_customer" focus> 
                                        @error('kodepos_customer')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>  
                                </div>
                            <div class="form-group mt-3">
                                <button class="btn btn-primary "><i class="fas fa-save"></i> Simpan</button> 
                                <a href="{{route('customer')}}" class="btn btn-warning text-white "><i class="fas fa-undo"></i> Kembali</a> 
                            </div>

                          </form>
                    </li>
                  </ul>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection('konten')