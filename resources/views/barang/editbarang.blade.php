@extends('templates.main')

@section('title','Fungsi Edit')
@section('sub','Master Barang')

@section('konten')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit data stock barang</div>

                <div class="card-body">
                    <form method="POST" action="{{url('barang/edit/'.$barang->id_barang)}}" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="form-group row">
                            <label for="nama_barang" class="col-md-4 col-form-label text-md-right">Nama Barang</label>
                            <div class="col-md-6">
                                <input id="nama_barang" type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" value="{{$barang->nama_barang ?? old('nama_barang') }}"  autocomplete="nama_barang" autofocus>
                                @error('nama_barang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="kategori_barang" class="col-md-4 col-form-label text-md-right">Kategori</label>
                            <div class="col-md-6">
                            <select name="kategori_barang" id="kategori_barang" class="form-control">
                                @foreach($kategori as $kat)
                                    <option 
                                    value="{{$kat->id_kategori}}" 
                                    @if($kat->id_kategori == $barang->kategori_barang)  selected @endif
                                    >
                                    {{$kat->nama_kategori ?? old('nama_kategori')}}</option>
                                @endforeach
                            </select>
                                @error('kategori_barang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="foto_barang" class="col-md-4 col-form-label text-md-right">Foto barang</label>
                            <div class="col-md-6">
                                @if($barang->foto_barang)
                                <img src="{{url('images/barang/'.$barang->foto_barang)}}" alt="" class="img-thumbnail" width="100">
                                @else
                                <img src="{{url('images/avatars/dummy.jpg')}}" alt="" class="img-thumbnail" width="100">
                                @endif
                                <input id="foto_barang" type="file" class="form-control @error('foto_barang') is-invalid @enderror" name="foto_barang" value="{{ old('foto_barang') }}"  autocomplete="foto_barang" autofocus>
                                @error('foto_barang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="harga_jual" class="col-md-4 col-form-label text-md-right">Harga Jual</label>
                            <div class="col-md-6">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                                <input id="harga_jual" type="text" class="form-control @error('harga_jual') is-invalid @enderror" name="harga_jual" value="{{$barang->harga_jual ?? old('harga_jual') }}"  autocomplete="harga_jual" autofocus>
                                @error('harga_jual')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stock_barang" class="col-md-4 col-form-label text-md-right">Stock</label>
                            <div class="col-md-6">
                            <div class="input-group">
                                <input id="stock_barang" type="text" class="form-control @error('stock_barang') is-invalid @enderror" name="stock_barang" value="{{ $barang->stock_barang ?? old('stock_barang') }}"  autocomplete="stock_barang" autofocus>
                            <div class="input-group-append">
                                <span class="input-group-text">Pcs</span>
                            </div>
                                @error('stock_barang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Ubah
                                </button>
                                <a href="{{route('barang')}}" class="btn btn-warning">
                                    kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('konten')
@section('scriptExternal')
    <script>
        $(document).ready(function(){
            // $('#harga_jual').mask('000,000,000', {reverse:true});
            // $('#stock_barang').mask('000,000,000',{reverse:true});
        });
    </script>
@endsection('scriptExternal')
