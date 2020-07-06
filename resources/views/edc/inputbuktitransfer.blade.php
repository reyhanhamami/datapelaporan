@extends('templates.main')

@section('title','Dashboard')
@section('sub','Input Bukti Transfer')
@section('konten')
<div class="row">
              <div class="col-12 mb-4">
                <div class="card card-small mb-4">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Form Inputs</h6>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item p-0 px-3 pt-3">
                      <div class="row">
                        <div class="col-sm-12 col-md-4 mb-3">
                        <!-- rekening penerima Input Groups -->
                        <form method="POST" enctype="multipart/form-data" action="{{route('savebuktitransfer')}}">
                        @csrf
                        <strong class="text-muted d-block mb-2">Rekening Penerima</strong>
                        <div class="input-group mb-3">
                          <div class="input-group input-group-seamless">
                            <!-- <span class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">local_atm</i>
                              </span>
                            </span> -->
                            <select class="form-control @error('rekening_penerima') is-invalid @enderror" name="rekening_penerima" id="kas"> 
                                <option value=""></option>
                                @foreach($kas as $k)
                                <option value="{{$k->nm_kas}}">{{$k->nm_kas}}</option>
                                @endforeach
                            </select>  
                            @error('rekening_penerima')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group input-group-seamless">
                            <span class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">local_atm</i>
                              </span>
                            </span>
                            <input type="text" class="form-control" id="form2-password" value="Badan Wakaf Al-Quran" disabled>
                          </div>
                        </div>
                        <!-- / Rekening Penerima Input Groups -->
                        </div>
                        <div class="col-sm-12 col-md-4 mb-3">
                        <!-- rekening Pengirim Input Groups -->
                        <strong class="text-muted d-block mb-2">Rekening Pengirim <button type="button" data-toggle="modal" data-target="#add"><i class="material-icons">add_circle</i></button></strong>
                        
                        <div class="input-group mb-3">
                          <div class="input-group input-group-seamless">
                            <!-- <select class="form-control" id="carinama" name="nama">
                            <option value=""></option> 
                            @foreach($z_bank_sumber as $z)
                            <option value="{{$z->nama}}">{{$z->nama}} - {{$z->norek}}</option>
                            @endforeach
                            </select> -->
                            <input type="text" class="form-control @error('rekening_sumber') is-invalid @enderror" name="rekening_sumber" id="rekening_sumber" placeholder="Rekening Sumber">
                            @error('rekening_sumber')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                            </div>
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group input-group-seamless">
                            <span class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">local_atm</i>
                              </span>
                            </span>
                            <input type="text" class="form-control @error('norek_sumber') is-invalid @enderror" name="norek_sumber" id="norek_sumber" placeholder="No Rek. Sumber">
                            @error('norek_sumber')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                          </div>
                        </div>
                        <!-- / Rekening Pengirim Input Groups -->
                        </div>
                        <div class="col-sm-12 col-md-4 mb-3">
                          <!-- rekening Pengirim Input Groups -->
                        <strong class="text-muted d-block mb-2">Tanggal dan jumlah Transfer</strong>
                        <div class="input-group mb-3">
                          <div class="input-group input-group-seamless">
                            <span class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="material-icons">date_range</i>
                              </span>
                            </span>
                            <input type="date" class="form-control @error('TglTRF') is-invalid @enderror" name="TglTRF" id="TglTRF"> </div>
                            @error('TglTRF')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group input-group-seamless">
                            <span class="input-group-prepend">
                              <span class="input-group-text">
                                <small>Rp.</small>
                              </span>
                            </span>
                            <input type="text" class="form-control @error('RecAmt') is-invalid @enderror" name="RecAmt" id="RecAmt" placeholder="100000">
                            @error('RecAmt')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                          </div>
                        </div>
                        <!-- / Rekening Pengirim Input Groups -->
                        </div>
                      </div>
                    </li>
                   
                  </ul>
                  <button type="submit"  class="btn btn-dark">Simpan Bukti Transfer <i class="material-icons">save</i></button>
                  </form>
                </div>
              </div>
              </div>
              
              <!-- modal -->
              <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Simpan Rekening sumber baru</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{route('zsimpan')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nama Rekening Sumber:</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="recipient-name">
                                    @error('nama')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Nomer Rekening Sumber:</label>
                                    <input type="text" class="form-control @error('norek') is-invalid @enderror" name="norek" id="message-text">
                                    @error('norek')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Simpan <i class="material-icons">save</i></button>
                            </div>
                            </div>
                                </form>
                        </div>
                        </div>
                        <!-- end modal  -->
@endsection

@section('scriptExternal')
<script>
    $('#kas').select2({
        allowClear:true,
        placeholder: '  Pilih No Rekening BWA'
    });

    $('#carinama').select2({
        allowClear:true,
        placeholder:'Pilih Rekening Sumber'
    });
    
    // fitur search cari nama rekening dengan menyimpan data berbentuk json 
    // $("#carinama").select2({
    //     placeholder: 'Cari No Rekening sumber',
    //     ajax:{
    //         url : '/carinama',
    //         dataType:'json',
    //         delay: 250,
    //         processResults: function(data) {
    //             return {
    //                 results: $.map(data, function(item){
    //                     return {
    //                         text: [
    //                             item.nama, ' - ', item.norek
    //                         ],
    //                         id: item.nama
    //                     }
    //                 })
    //             };
    //         }
    //     }
    // });
    // menampilkan norek jika nama rekening dipilih
    // $(document).on('change','#carinama', function(){
    //     var carinama = $(this).val();
    //     var datas = '/getvaluenama?id='+carinama;
    //     $.get(datas,function(i){
    //         $("#norek").val(i.norek);
    //     });
    // });
</script>
@endsection