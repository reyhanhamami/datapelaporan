<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
   <div class="container mt-5 py-3">
    <div class="row justify-content-center">
        <div class="col-md-5">
            @if(session('gagal'))
                    <div class="alert alert-danger">
                      {{session('gagal')}}
                </div>
            @endif()
            <div class="card">
                <div class="mx-auto mt-3">
                    <img class="rounded" src="{{url('images/avatars/logo.png')}}" width="100" height="100">
                </div>
                <div class="card-body shadow">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nm_login" class="col-md-4 col-form-label text-md-right">{{ __('Nama Login') }}</label>

                            <div class="col-md-8">
                                <input id="nm_login" type="text" class="form-control @error('nm_login') is-invalid @enderror" name="nm_login" value="{{ old('nm_login') }}"   autofocus>
                            
                                @error('nm_login')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pwd" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-8">
                                <input id="pwd" type="password" class="form-control @error('pwd') is-invalid @enderror" name="pwd" >

                                @error('pwd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <!-- <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> -->

                                    <!-- <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label> -->
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                              
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
</body>
</html>


