@extends('templates.main')

    @section('title','Dashboard')

    @section('sub','Input Donasi')

    @section('konten')
    @if(session('success'))
    <div class="alert alert-success">
      {{session('success')}}
    </div>
    @endif
        <!--start row main conten -->
       <div class="row">
              <div class="col-lg-12 mb-4">
                <div class="card card-small mb-4">
                <form method="post" action="{{url('/editpengesahandonasi/edit/'.$tdonasi->no_kwitansi)}}">
                @method('patch')
                @csrf
                  <div class="card-header border-bottom text-center">
                    <a href="{{route('buktitransfer')}}" class="btn btn-sm btn-outline-info"><i class="fas fa-angle-double-left"></i> Kembali ke data edc</a>
                    <a href="{{route('tabledonasi')}}" class="btn btn-sm btn-outline-primary">Kembali ke seluruh donasi <i class="fas fa-angle-double-right"></i></a>
                    <?php 
                      $data = $tdonasi->no_kwitansi;
                      $cabangedc = substr($data,4,3);
                      $cabangedc = (int) $cabangedc;
                    ?>
                  </div>
                  <ul class="list-group list-group-flush">
                  <!-- section 1  -->
                    <li class="list-group-item p-0 px-3 pt-3">
                      <div class="row">
                        <div class="col-sm-12 col-md-6 mb-3">
                          <div class="form-group">
                              <div class="input-group mb-3">
                                <select name="alur_kerja" id="alur_kerja" class="form-control @error('alur_kerja') is-invalid @enderror">
                                  <option value="">-- Pilih Alur Kerja --</option>
                                  <option value="ENTRI" @if($tdonasi->alur_kerja == 'ENTRI') selected @endif>1 - Entri</option>
                                  <option value="VERIFIKASI" @if($tdonasi->alur_kerja == 'VERIFIKASI') selected @endif>2 - Verifikasi</option>
                                  <option value="SAH" @if($tdonasi->alur_kerja == 'SAH') selected @endif>3 - Pengesahan</option>
                                </select>
                                @error('alur_kerja')
                                  <div class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                          <div class="form-group">
                              <div class="input-group mb-3">
                                <select name="cabang" id="cabang" class="form-control @error('cabang') is-invalid @enderror">
                                  <option value="">-- Pilih Kantor --</option>
                                  @foreach($mcabang as $cabang)
                                  <option value="{{$cabang->ID}}"
                                  @if($tdonasi->kd_cabang == $cabang->ID or $cabangedc == $cabang->ID) selected @endif>{{$cabang->Nm}}</option>
                                  @endforeach
                                </select>
                                @error('cabang')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                              </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <!-- end section 1  -->

                    <!-- section 2  -->
                    <li class="list-group-item p-3 border-danger">
                      <div class="row">
                      <!-- form 1  -->
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                              <div class="input-group mb-3">
                                <select name="kas" id="pembayaran" class="@error('kas') is-invalid @enderror">
                                  <option value="">-- Pilih Pembayaran --</option>
                                  @foreach($mkas as $kas)
                                  <option value="{{$kas->kd_kas}}"
                                  @if($tdonasi->kd_kas == $kas->kd_kas) selected @endif>{{$kas->nm_kas}}</option>
                                  @endforeach
                                </select>
                                @error('kas')
                                <div class="invalid-feedback">
                                  {{$message}}
                                </div>
                                @enderror
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-dark">Kwitansi</span>
                                </div>
                                <input type="text" id="kwitansi" class="form-control @error('kwitansi') is-invalid @enderror" name="no_kwitansi" value="{{$tdonasi->no_kwitansi}}">
                                @error('kwitansi')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="input-group ">
                                <select name="carihp" id="carihp" class="form-control disabled carihp @error('carihp') is-invalid @enderror" disabled></select>
                              </div>
                              <p class="small text-danger">*Harap ketik Nomer hp lebih dari 8 nomer mis:12345678**</p>
                              @error('carihp')
                              <div class="invalid-feedback">
                                {{$message}}
                              </div>
                              @enderror
                            </div>

                        </div>
                        <!-- end form 1  -->
                      <!-- form 2  -->
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-dark">Tgl. Transaksi</span>
                                </div>
                                <input type="date" id="tgl_transaksi" class="form-control @error('tgl_transaksi') is-invalid @enderror" name="tgl_transaksi" value="{{date('Y-m-d', strtotime($tdonasi->tgl_transaksi))}}">
                                @error('tgl_transaksi')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-dark">Tgl. Setor</span>
                                </div>
                                <input type="date" id="tgl_setor" class="form-control @error('tgl_setor') is-invalid @enderror" name="tgl_setor" value="{{date('Y-m-d', strtotime($tdonasi->tgl))}}">
                                @error('tgl_setor')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                              </div>
                            </div>
                        </div>
                      <!-- end form 2  -->
                        <!-- form 3 -->
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                              <div class="input-group mb-3">
                                <select name="jaringan" id="jaringan" class="@error('jaringan') is-invalid @enderror">
                                  <option value="">-- Pilih Jaringan --</option>
                                  @foreach($magen as $agen)
                                  <option value="{{$agen->kd_agen}}"
                                  @if($tdonasi->kd_agen == $agen->kd_agen) selected @endif>{{$agen->nm_agen}}</option>
                                  @endforeach
                                </select>
                                @error('jaringan')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                              </div>
                            </div>
                        </div>
                        <!-- end form 3  -->
                      </div>
                    </li>
                    <!-- end section 2 -->

                    <!-- section 3  -->
                    <li class="list-group-item p-3 border-warning">
                      <div class="row">
                      <!-- form 1  -->
                        <div class="col-sm-12 col-md-4">
                        <input type="hidden" name="kd_pelanggan" id="kd_pelanggan" value="{{$tdonasi->kd_pelanggan}}">
                            <div class="form-group">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-dark">Nama Pendaftar</span>
                                </div>
                                <input type="text" id="nm_lengkap" class="form-control @error('nm_lengkap') is-invalid @enderror" name="nm_lengkap" value="{{$tdonasi->nm_lengkap}}">
                                @error('nm_lengkap')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-dark">Nama Wakif</span>
                                </div>
                                <input type="text" class="form-control @error('nm_wakif') is-invalid @enderror" name="nm_wakif" id="nm_wakif" value="{{$tdonasi->nm_wakif}}">
                                @error('nm_wakif')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                              </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control @error('alamat') is-invalid @enderror" value="{{$tdonasi->alamat}}"></textarea>
                                @error('alamat')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- end form 1  -->

                      <!-- form 2  -->
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-dark">Provinsi</span>
                                </div>
                                <select name="propinsi" id="propinsi" class="form-control @error('propinsi') is-invalid @enderror" >
                                  @foreach($rf_propinsi as $propinsi)
                                  <option value="{{$propinsi->kd_propinsi}}"
                                    @if($tdonasi->propinsi == $propinsi->kd_propinsi) selected @endif>
                                    {{$propinsi->nm_propinsi}}
                                  </option>
                                  @endforeach
                                </select>
                                @error('propinsi')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-dark">Kota</span>
                                </div>
                                <input type="text" class="form-control @error('kota') is-invalid @enderror" id="kota" name="kota" value="{{$tdonasi->kota}}">
                                @error('kota')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-dark">Kode Pos</span>
                                </div>
                                <input type="text" class="form-control @error('pos') is-invalid @enderror" id="pos" name="pos" value="{{$tdonasi->pos}}">
                                @error('pos')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-dark">Telepon</span>
                                </div>
                                <input type="text" class="form-control @error('telp') is-invalid @enderror" id="telp" name="telp" value="{{$tdonasi->telp}}">
                                @error('telp')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-dark">Handphone</span>
                                </div>
                                <input type="text" class="form-control @error('hp') is-invalid @enderror" id="hp" name="hp" value="{{$tdonasi->hp}}">
                                @error('hp')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                              </div>
                            </div>

                        </div>
                      <!-- end form 2  -->

                        <!-- form 3 -->
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-dark">Email</span>
                                </div>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{$tdonasi->email}}">
                                <?php $i = 1; ?>
                                <!-- untuk update tjurnal_dtl actkm_dtl -->
                                @foreach($tdonasi_dtl as $det) 
                                        <td><input type="hidden" name="tdonasi_dtl[{{$loop->index}}][id]" value="{{$i++}}"></td> 
                                        <td><input type="hidden" name="tdonasi_dtl[{{$loop->index}}][kd_program]" value="{{$det->kd_program}}"></td> 
                                        <td><input type="hidden" name="tdonasi_dtl[{{$loop->index}}][kd_project]" value="{{$det->kd_project}}"></td> 
                                        <td><input type="hidden" name="tdonasi_dtl[{{$loop->index}}][qty]" value="{{$det->qty}}"></td> 
                                        <td><input type="hidden" name="tdonasi_dtl[{{$loop->index}}][jmh]" value="{{$det->jmh}}"></td> 
                                @endforeach 
                                @error('email')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="verifikasi">Keterangan Verifikasi</label>  
                              <textarea name="keterangan" id="verifikasi" cols="30" rows="5" class="form-control @error('verifikasi') is-invalid @enderror"></textarea>
                              @error('verifikasi')
                              <div class="invalid-feedback">{{$message}}</div>
                              @enderror
                            </div>
                        </div>
                        <!-- end form 3  -->
                      </div>
                    </li>
                    <!-- end section 3 -->
<!-- section 4 -->
<li class="list-group-item p-3 border-success">
    <!-- add barang -->
        <div class="row">
            <div class="col-md-12 otherplace">
                <div class="form-inline clearfix mb-2">
                <div class="form-group mr-auto">
                    <h6 for="" class="mr-2 text-dark">Total Transfer : </h6>

                </div>
                <div class="form-group ml-auto">
                    <label for="" class="mr-2 text-dark">Biaya Bank</label>
                    <input type="text" class="form-control biaya_bank" name="biaya_bank" id="biaya_bank" >
                </div>
                </div>
                <div class="table-responsive">
                  <table class="table m-t-30" id="customFields">
                    <thead>
                    <tr><th>Program</th>
                        <th>project</th>
                        <th>Qty</th>
                        <th>Dana</th>
                        <th>Jumlah</th>
                        <th class="text-right"><i class="fas fa-cogs"></i></th>
                        <th ><a class="btn btn-sm btn-dark align-top addCF text-white" ><i class="fas fa-plus"></i> Tambah</a></th>
                    </tr></thead>
                    <tbody>
                <?php $data = array(); ?>
                @foreach($tdonasi_dtl as $detail)
                <?php 
                  $data[] = array(
                    'kd_program' => $detail->kd_program,
                    'kd_project' => $detail->kd_project,
                    'kd_qty' => $detail->qty,
                    'kd_jmh' => $detail->jmh,
                  );
                ?>
                <tr id="">
                <td>
                <select name="asd[{{$loop->index}}][kd_program]" id="" class="form-control"  disabled>
                    @foreach($mprogram as $program)
                    <option value="{{$program->kd_program}}"
                    @if($detail->kd_program === trim($program->kd_program)) selected @endif>{{$program->nm_program}}</option>
                    @endforeach
                </select>
                </td>
            <td>
                <select name="asd[{{$loop->index}}][kd_project]" id="" class="form-control" disabled>
                    @foreach($mproject as $project)
                    <option value="{{$project->kd_project}}"
                    @if($detail->kd_project == trim($project->kd_project)) selected @endif>{{$project->nm_project}}</option>
                    @endforeach
                </select>
                
            </td>
            <td>
                <input type="text" name="asd[{{$loop->index}}][qty]" id="" class="form-control" value="{{$detail->qty}}" disabled></td>
                <td>
                    <input type="text" name="danas" id="" class="form-control" value="{{$detail->jmh/$detail->qty}}" disabled></td>
                    <td>
                        <input type="text" name="asd[{{$loop->index}}][jmh]" id="" class="form-control" readonly="readonly" value="{{$detail->jmh}}" disabled></td>
                        <td class="text-right">
                        <!-- <button name="add" id="add" type="button" class="btn btn-warning btn-sm add" data-toggle="modal" data-target="#exampleModal">
                          <i class="fa fa-edit"> </i> Edit
                        </button> -->
                        <button type="button" name="edit" id="{{$detail->kd}}" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"> Edit</i></button>
                        <button type="button" name="hapus" id="{{$detail->kd}}" class="hapus btn btn-dark btn-sm"><i class="fas fa-trash"> Hapus</i></button>
                            </div>
                          </div>
                        </div>
                            <!-- <button type="button" id="remCF" class="btn btn-danger btn-sm remCF">
                                <i class="fa fa-minus"></i>
                            </button> -->
                        </td>
                        <td></td>
                    </tr>
                  @endforeach
          </tbody>
        </table>
        <label>TOTAL </label>
        <input type="text" id="total" name="total" class="form-control total" value='{{$tdonasi->total}}' readonly>
        <button class="btn btn-sm btn-outline-info mt-3"><i class="fas fa-save"></i> Edit</butt>
      </div>
      </form>
      </div>
      </div>
  </div>
</div>

<!-- end barang  -->
          </li>
          <!-- end section 4 -->
        </ul>
<!-- untuk update tdonasi detail -->

<!-- end untuk update tdonasi detail  -->
<!-- Modal -->
<div id="formModal" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <span id="form_result"></span>
        <form method="post" id="sample_form">
        @csrf
      <div class="form-group">
        <label for="recipient-name" class="col-form-label float-left">Program:</label>
        <select id="progss" name="progss" class="form-control">
             @foreach($mprogram as $program)
              <option value="{{trim($program->kd_program)}}">{{$program->nm_program}}</option>
            @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="message-text" class="col-form-label float-left">Project:</label>
        <select name="proj" id="proj" class="form-control" >
            @foreach($mproject as $project)
            <option value="{{trim($project->kd_project)}}">{{$project->nm_project}}</option>
            @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="message-text" class="col-form-label float-left qt">Qty:</label>
        <input type="text" name="qty" id="qt" class="form-control" value="" >
      </div>
      <div class="form-group">
        <label for="message-text" class="col-form-label float-left dan">Dana:</label>
        <input type="text" name="dana" id="dan" class="form-control" value="">
      </div>
      <div class="form-group">
        <label for="message-text" class="col-form-label float-left jm">Jumlah:</label>
        <input type="text" name="jm" id="jm" class="form-control" readonly="readonly" value="" disabled>
      </div>
      <div class="form-group">
        <input type="hidden" name="kd" id="kd" class="form-control kd" >
        <input type="hidden" name="no_kwitansi" id="no_kwitansi" class="form-control no_kwitansi" >
        <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Update" />
      </div>
    </form>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-primary">Update</button> -->
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
      </div>
      <!-- end modal  -->
</div>
<!-- end bentuk form  -->

    @endsection('konten')

    @section('scriptExternal')
   
    <script>
    // delete
    $(document).on('click','.hapus',function(){
      var kd = $(this).attr('id');
        $.ajax({
          url: "../tdonasidetaildelete/"+kd,
          method:"POST",
          data:$(this).serialize(),
          datatype:"json",
          beforeSend:function(){
              $('.hapus').text('Hapus...');
          },
          success:function(data)
          {
              location.reload();
          },
        })
    });

    // edit 
    $('#sample_form').on('submit', function(){
      
      event.preventDefault();
      var action_url = "{{route('tdonasi.update')}}";

      $.ajax({
        url: action_url,
        method:"POST",
        data:$(this).serialize(),
        datatype:"json",
        success:function(data)
        {
          var html = '';
          if (data.errors) {
            html = '<div class="alert alert-danger>"';
            for (var count = 0; count < data.errors.length; count++) {
              html += '<p>' + data.errors[count] + '</p>';              
            }
            html += '</div>';
          }
          if (data.success) {
              html = '<div class="alert alert-success">' + data.success +  '</div>';
              $('#sample_form')[0].reset();
              location.reload();
          }
          $('#form_result').html(html);
        }
      });
    });
    $(document).on('click','.edit', function(){
      var kd = $(this).attr('id');
      $('#formModal').modal('show');
      $('#form_result').html('');
      $.ajax({
        url: "../tdonasidetaileditkd/"+kd,
        dataType: "json",
        success: function(data)
        {
          $('#progss option[value="'+data.kd_program+'"]').prop('selected', true);
          $('#proj option[value="'+data.kd_project+'"]').prop('selected', true);
          $('#qt').val(data.qty);
          $('#dan').val(data.jmh/data.qty);
          $('#kd').val(kd);
          $('#no_kwitansi').val(data.no_kwitansi);
          $('#jm').val(data.jmh);
          $('#formModal').modal('show');
        }
      });
    });
    // change when click edit
    $(document).on('change','#dan', function(){
        var dana = $(this).val();
        var qty = $("#qt").val();
        var hasil = dana * qty;
        $("#jm").val(hasil).trigger('change');
      });
      $(document).on('change','#qt', function(){
        var dana = $(this).val();
        var qty = $("#dan").val();
        var hasil = dana * qty;
        $("#jm").val(hasil).trigger('change');
      });
    // end change when click edit
    // script tambah barang 

    $(".addCF").click(function(){
  
      var random = Math.floor((Math.random() * 100000) + 1);
      a = `
    <tr id="kd_program_`+ random +`">
    <td>
    <select
        name="mprogram[]"
        id="mprogram_`+ random +`"
        class="form-control mprogram">
        <option value="">-- Pilih --</option>
        @foreach($mprogram as $program)
        <option value="{{$program->kd_program}}">{{$program->nm_program}}</option>
        @endforeach
    </select>
    </td>
<td>
    <select
        name="mproject[]"
        id="mproject_`+ random +`"
        class="form-control mproject">
        <option value="">-- Pilih --</option>
        @foreach($mproject as $project)
        <option value="{{$project->kd_project}}">{{$project->nm_project}}</option>
        @endforeach
    </select>
</td>
<td>
    <input type="text" name="qty[]" id="qty_`+ random +`" class="form-control qty"></td>
    <td>
        <input type="text" name="dana[]" id="dana_`+ random +`" class="form-control dana"></td>
        <td>
            <input
                type="text"
                name="jmh[]"
                id="jmh_`+ random +`"
                class="form-control jmh"
                readonly="readonly"></td>
            <td class="text-right">
                <button type="button" id="remCF`+ random +`" class="btn btn-danger btn-sm remCF">
                    <i class="fa fa-minus"></i>
                </button>
            </td>
            <td></td>
        </tr>
      `;
      $("#customFields").append(a);
      acak = random;
    });
    
    // script hapus kolom tambah barang 
    $("#customFields").on('click','.remCF',function(){
        $(this).parent().parent().remove();
    });

    // fitur search pada program 
    $('.mprogram').select2();
    // fitur search pada program 
    $('.mproject').select2();
     // fitur search jarigan menggunakan select2
    $('#jaringan').select2();
    // fitur search pembayaran menggunakan select2
    $('#pembayaran').select2();
    // fitur search cabang menggunakan select2
    $('#cabang').select2();
    // fitur search alur_kerja menggunakan select2
    $('#alur_kerja').select2();
    // fitur search carihp dengan menyimpan data berbentuk json
    $("#carihp").select2({
    placeholder: 'Cari No Hp Wakif',
    ajax: {
        url: '/carihp',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: [
                            item.nm_lengkap, ' - ', item.hp
                        ],
                        id: item.kd_pelanggan
                    }
                })
            };
          }
        }
    });
    // menampilkan data wakif jika no hp wakif dipilih 
    $(document).on('change',"#carihp", function(){
      var carihp = $(this).val();
      var datas = '/getvaluewakif?id='+carihp;
      $.get(datas, function(i){
        $("#nm_lengkap").val(i.nm_lengkap);
        $("#alamat").val(i.alamat);
        $("#kota").val(i.kota);
        $("#pos").val(i.pos);
        $("#propinsi").val(i.propinsi);
        $("#telp").val(i.telp);
        $("#hp").val(i.hp);
        $("#email").val(i.email);
      });
    });
    // menampilkan data wakif jika email wakif dipilih

    // mengisi jumlah otomatis berdasarkan qty * dana 
    $(document).on('change','.dana', function(){
      var dana = $(this).val();
      var qty = $("#qty_" + acak).val();
      var hasil = dana * qty;
      $("#jmh_" + acak).val(hasil).trigger('change');
    });
    $(document).on('change','.qty', function(){
      var dana = $(this).val();
      var qty = $("#dana_" + acak).val();
      var hasil = dana * qty;
      $("#jmh_" + acak).val(hasil).trigger('change');
    });
  
    // menghitung total keseluruhan
    $(document).on('change','.jmh', function(){
      var tdonasi = `{{$tdonasi->total}}`;
      var totalSum = 0;
      $('.jmh').each(function() {
        var inputVal = $(this).val();
       
        if ($.isNumeric(inputVal)) {
          totalSum += parseFloat(inputVal) ;
        }
      });
      real = totalSum + parseInt(tdonasi) ;
      // totals = totalSum + parseInt($("#biaya_bank").val())
      $("#total").val(real).trigger('change');
    });
    // end total keseluruhan 
    </script>
 
    @endsection('scriptExternal')