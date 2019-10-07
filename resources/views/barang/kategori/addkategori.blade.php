@extends('templates.main')

@section('title','Fungsi Add')
@section('sub','Master Kategori')

@section('konten')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Tambah - Kategori</div>

                <div class="card-body">
                    <form method="POST" action="{{route('storekategori')}}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label ">Kategori</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="nama_kategori" value="{{ old('nama_kategori') }}"  autocomplete="name" autofocus>
                                @error('nama_kategori')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    Tambah
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
