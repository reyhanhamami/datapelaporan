@extends('templates.main')

@section('title','Edit')
@section('sub','Edit Account User Login')

@section('konten')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{$user->id}}" enctype="multipart/form-data">
                        @method('patch')
                        @csrf

                    <div class="form-group row">
                    <div class="mx-auto">
                    <label for="">Level</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="level" id="inlineRadio1" value="admin" @if($user->level == 'admin') checked @endif>
                            <label class="form-check-label" for="inlineRadio1">Admin</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="level" id="inlineRadio2" value="reseller" @if($user->level == 'reseller') checked @endif>
                            <label class="form-check-label" for="inlineRadio2">Reseller</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="level" id="inlineRadio3" value="gudang" @if($user->level == 'gudang') checked @endif>
                        <label class="form-check-label" for="inlineRadio3">Gudang</label>
                        </div>
                    </div>
                    </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nama</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name ?? old('name') }}"  autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_akun" class="col-md-4 col-form-label text-md-right">Nama Toko</label>
                            <div class="col-md-6">
                                <input id="nama_akun" type="text" class="form-control @error('nama_akun') is-invalid @enderror" name="nama_akun" value="{{$user->nama_akun ?? old('nama_akun') }}"  autocomplete="nama_akun" autofocus>
                                @error('nama_akun')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telepon" class="col-md-4 col-form-label text-md-right">Telepon</label>
                            <div class="col-md-6">
                                <input id="telepon" type="text" class="form-control @error('telepon') is-invalid @enderror" name="telepon" value="{{ $user->telepon ?? old('telepon') }}"  autocomplete="telepon" autofocus>
                                @error('telepon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email ?? old('email') }}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="foto" class="col-md-4 col-form-label text-md-right">Ganti Foto?</label>
                            <div class="col-md-6">
                            @if($user->foto)
                            <img src="{{asset('images/avatars/'.$user->foto)}}" alt="Tidak ada gambar" width="100">
                            @else
                            <img src="{{asset('images/avatars/dummy.jpg')}}" alt="Tidak ada gambar" width="100">
                            @endif
                                <input id="foto" type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" value="{{ $user->foto ?? old('foto') }}"  autocomplete="foto" autofocus>
                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Ganti Password?</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Edit
                                </button>
                                <a href="{{route('reseller')}}" class="btn btn-warning">
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
