@extends('templates.main')

@section('title','Overview')
@section('sub','Validasi pembayaran')

@section('konten')

<div class="row">
        <div class="container">
            <div class="col-md-10 col-sm-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div>Bukti pembayaran dari Reseller <span class="font-weight-bold">@foreach($user as $us) @if($bukti_pembayaran->id_reseller == $us->id) "{{$us->name}}" @endif @endforeach</span></div>
                        <small>Total hutang <span class="font-weight-bold">Rp.{{number_format($bukti_pembayaran->total)}}</span></small>
                    </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                    <a href="{{route('notifpembayaran')}}" class="text-secondary float-right mb-3 font-weight-bold"><i class="fas fa-chevron-left"></i> Kembali</a>
                        <form action="{{url('/keuangan/prosesvalidasi/'.$bukti_pembayaran->id_pembayaran)}}" method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                            <div class="form-group">
                                <div class="form-group ">
                                    <label class="d-block" for="input_bukti">Input pembayaran</label>
                                    <input type="hidden" name="input_bukti" value="0">
                                    <input type="hidden" name="total" value="0">
                                    <input type="text" class="@error('input_bukti') is-invalid @enderror form-control" id="input_bukti" value="{{$bukti_pembayaran->input_bukti ?? old('input_bukti')}}" disabled> 
                                </div>
                                <div class="form-group ">
                                    <label class="d-block" for="foto_bukti">bukti pembayaran</label>
                                    <a href="{{url('/images/buktipembayaran/'.$bukti_pembayaran->foto_bukti)}}" class="perbesar">
                                    <img src="{{url('/images/buktipembayaran/'.$bukti_pembayaran->foto_bukti)}}" alt="" width="200">
                                    </a>
                                </div>

                                <div class="form-group ">
                                    <label class="d-block font-weight-bold" for="foto_bukti">bukti pembayaran sudah sesuai?</label>
                                    <select name="status_bukti"  class="form-control">
                                        <option value="iya">Iya</option>
                                        <option value="tidak">Tidak</option>
                                    </select>
                                </div>
                            </div>
                           
                            <div class="form-group ">
                                <button class="btn btn-primary btn-sm">Simpan bukti</button> 
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
    $(".perbesar").fancybox();
  })
</script>
@endsection('scriptExternal')