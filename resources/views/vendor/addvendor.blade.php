@extends('templates.main')

@section('title','Fungsi Add')
@section('sub','Master Vendor')

@section('konten')
    <div class="row">
        <div class="container">
            <div class="col-md-10 col-sm-12 mx-auto">
                <div class="card">
                  <div class="card-header border-bottom">
                    <h6>Form Inputs</h6>
                </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <form action="{{route('storevendor')}}" method="post">
                        @csrf
                                <div class="form-row">
                                    <div class="col-xl-6">
                                        <label class="d-block" for="nama_vendor">nama vendor</label>
                                        <input type="text" value="{{old('nama_vendor')}}" name="nama_vendor" class="@error('nama_vendor') is-invalid @enderror form-control" id="nama_vendor">
                                        @error('nama_vendor')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-xl-6">
                                        <label class="d-block" for="telepon">telepon</label>
                                        <input type="text" value="{{old('telepon_vendor')}}" name="telepon_vendor" class="@error('telepon_vendor') is-invalid @enderror form-control" id="telepon">
                                        @error('telepon_vendor')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>  
                                </div>
                            <div class="form-group ">
                                <label class="d-block" for="alamat">Alamat</label>
                                <input type="text" value="{{old('alamat_vendor')}}" name="alamat_vendor" class="@error('alamat_vendor') is-invalid @enderror form-control" id="alamat">
                                @error('alamat_vendor')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                            </div>
                            <div class="border-bottom border-info border mt-4"></div>
                            <p class="mb-4 text-center">Data Produk</p>
                            <div class="form-row">
                                    <div class="col-xl-4">
                                        <label class="d-block" for="nama_barang">nama barang</label>
                                        <input type="text" value="{{old('nama_barang')}}" name="nama_barang" class="@error('nama_barang') is-invalid @enderror form-control" id="nama_barang">
                                        @error('nama_barang')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-xl-2">
                                        <label class="d-block" for="Jumlah">Jumlah</label>
                                        <input type="number" value="{{old('jumlah_barang')}}" name="jumlah_barang" class="@error('jumlah_barang') is-invalid @enderror form-control" id="Jumlah">
                                        @error('jumlah_barang')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>  
                                    <div class="col-xl-3">
                                        <label class="d-block" for="beli">Harga Beli</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Rp</span>
                                        </div>
                                        <input type="text" value="{{old('harga_beli')}}" name="harga_beli" class="@error('harga_beli') is-invalid @enderror form-control" id="beli">
                                        @error('harga_beli')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    </div> 
                                    <div class="col-xl-3">
                                        <label class="d-block" for="jual">Harga jual</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" value="{{old('harga_jual')}}" name="harga_jual" class="@error('harga_jual') is-invalid @enderror form-control" id="jual">
                                        @error('harga_jual')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>  
                                    </div>
                                </div>
                           
                            <div class="form-group mt-3">
                                <button class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button> 
                                <a href="{{route('vendor')}}" class="btn btn-warning text-white btn-sm"><i class="fas fa-undo"></i> Kembali</a> 
                            </div>
                          </form>
                    </li>
                  </ul>
                </div>
            </div>
        </div>
    </div>
@endsection('konten')

@section('scriptExternal')
<script type="text/javascript">
    $(document).ready(function(){
    // Format mata uang.
    // $('#jual').mask('000.000.000', {reverse: true});
    // $('#beli').mask('000.000.000', {reverse: true});    
    })
</script>
@endsection('scriptExternal')