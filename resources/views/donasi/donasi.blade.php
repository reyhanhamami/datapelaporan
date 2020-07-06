@extends('templates.main')

    @section('title','Dashboard')

    @section('sub','Input Donasi')

    @section('konten')
    @if(session('success'))
    <div class="alert alert-success">
      {{session('success')}}
    </div>
    @endif
    @if(session('gagal'))
      <div class="alert alert-danger">
        {{session('gagal')}}
      </div>
    @endif
        <!--start row main conten -->
       <div class="row">
              <div class="col-lg-12 mb-4">
                <div class="card card-small mb-4">
                <form method="post" action="{{route('storedonasi')}}">
                @csrf
                  <div class="card-header border-bottom">
                    <a href="{{route('tabledonasi')}}" class="btn btn-sm btn-outline-info"><i class="fas fa-angle-double-left"></i> Kembali</a>
                  </div>
                  <ul class="list-group list-group-flush">
                  <!-- section 1  -->
                    <li class="list-group-item p-0 px-3 pt-3">
                      <div class="row">
                        <div class="col-sm-12 col-md-6 mb-3">
                          <div class="form-group">
                              <div class="input-group mb-3">
                                <!-- <div class="input-group-prepend">
                                  <span class="input-group-text text-dark" id="basic-addon1">Donasi</span>
                                </div> -->
                                <select name="alur_kerja" id="alur_kerja" class="form-control @error('alur_kerja') is-invalid @enderror">
                                  <option value="">-- Pilih Alur Kerja --</option>
                                  <option value="ENTRI">1 - Entri</option>
                                  <option value="VERIFIKASI">2 - Verifikasi</option>
                                  <option value="SAH">3 - Pengesahan</option>
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
                                <!-- <div class="input-group-prepend">
                                  <span class="input-group-text text-dark" id="basic-addon1">Kantor</span>
                                </div> -->
                                <select name="cabang" id="cabang" class="form-control @error('cabang') is-invalid @enderror">
                                  <option value="">-- Pilih Kantor --</option>
                                  @foreach($mcabang as $cabang)
                                  <option value="{{$cabang->ID}}">{{$cabang->Nm}}</option>
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
                                <!-- <div class="input-group-prepend">
                                  <span class="input-group-text text-dark">Pembayaran</span>
                                
                                </div> -->
                                 @if(Auth::user()->kd_group == 30 or       
                                    Auth::user()->kd_group == 525 or
                                    Auth::user()->kd_group == 521   or    
                                    Auth::user()->kd_group == 506     or  
                                    Auth::user()->kd_group == 504       or
                                    Auth::user()->kd_group == 505       or
                                    Auth::user()->kd_group == 501       or
                                    Auth::user()->kd_group == 502       or
                                    Auth::user()->kd_group == 503       or
                                    Auth::user()->kd_group == 507       or
                                    Auth::user()->kd_group == 523       or
                                    Auth::user()->kd_group == 524       or
                                    Auth::user()->kd_group == 508       or
                                    Auth::user()->kd_group == 516       or
                                    Auth::user()->kd_group == 526       or
                                    Auth::user()->kd_group == 509       or
                                    Auth::user()->kd_group == 520       or
                                    Auth::user()->kd_group == 511       or
                                    Auth::user()->kd_group == 518       or
                                    Auth::user()->kd_group == 522       or
                                    Auth::user()->kd_group == 512       or
                                    Auth::user()->kd_group == 513       or
                                    Auth::user()->kd_group == 519       or
                                    Auth::user()->kd_group == 514       or
                                    Auth::user()->kd_group == 515)
                                <select name="kas" id="pembayaran" class="@error('kas') is-invalid @enderror">
                                    <option value="29">KAS DI TANGAN Rp ( akun 11101)</option>
                                    <option value="01">KAS</option>
                                </select>
                                @error('kas')
                                <div class="invalid-feedback">
                                  {{$message}}
                                </div>
                                @enderror
                                @else 
                              
                                <select name="kas" id="pembayaran" class="@error('kas') is-invalid @enderror">
                                  <option value="">-- Pilih Pembayaran --</option>
                                  @foreach($mkas as $kas)
                                  <option value="{{$kas->kd_kas}}">{{$kas->nm_kas}}</option>
                                  @endforeach
                                   
                                </select>
                                @error('kas')
                                <div class="invalid-feedback">
                                  {{$message}}
                                </div>
                                @enderror
                                @endif
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-dark">Kwitansi</span>
                                </div>
                                <input type="text" id="kwitansi" value="{{old('no_kwitansi')}}"  class="form-control @error('no_kwitansi') is-invalid @enderror" name="no_kwitansi" placeholder="No Kwitansi">
                                @error('no_kwitansi')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="input-group ">
                                <select name="carihp" id="carihp" class="form-control carihp @error('carihp') is-invalid @enderror"></select>
                              </div>
                              <p class="small text-danger">*Harap ketik Nomer hp lebih dari 8 nomer mis:08966308**</p>
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
                                <input type="text" id="tgl_transaksi" value="{{old('tgl_transaksi')}}" onchange='notnow()'  class="form-control @error('tgl_transaksi') is-invalid @enderror" name="tgl_transaksi" >
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
                                <input type="text" value="{{old('tgl_setor')}}"  id="tgl_setor" onchange='notnow()' class="form-control @error('tgl_setor') is-invalid @enderror" name="tgl_setor" >
                                @error('tgl_setor')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="input-group ">
                                <select name="cariemail" id="cariemail" class="form-control cariemail"></select>
                              </div>
                              <p class="small text-danger">*Harap ketik email lebih dari 4 karakter mis:rey@bwa**</p>
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
                                  <option value="{{$agen->kd_agen}}">{{$agen->nm_agen}}</option>
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
                            <input type="hidden" name="kd_pelanggan" id="kd_pelanggan">
                            <div class="form-group">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text text-dark">Nama Pendaftar</span>
                                </div>
                                <input type="text" value="{{old('nm_lengkap')}}"  id="nm_lengkap" class="form-control @error('nm_lengkap') is-invalid @enderror" name="nm_lengkap">
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
                                <input type="text" value="{{old('nm_wakif')}}"  class="form-control @error('nm_wakif') is-invalid @enderror" name="nm_wakif" id="nm_wakif" >
                                @error('nm_wakif')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                              </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" value="{{old('alamat')}}"  id="alamat" cols="30" rows="3" class="form-control @error('alamat') is-invalid @enderror" ></textarea>
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
                                  <option value="">-- Pilih --</option>
                                  @foreach($rf_propinsi as $propinsi)
                                  <option value="{{$propinsi->kd_propinsi}}">{{$propinsi->nm_propinsi}}</option>
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
                                <input type="text" value="{{old('kota')}}"  class="form-control @error('kota') is-invalid @enderror" id="kota" name="kota" >
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
                                <input type="text" class="form-control @error('pos') is-invalid @enderror" id="pos" name="pos" value="{{ old('pos')}}">
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
                                <input type="text" value="{{old('telp')}}"  class="form-control @error('telp') is-invalid @enderror" id="telp" name="telp" >
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
                                <input type="text" value="{{old('hp')}}"  class="form-control @error('hp') is-invalid @enderror" id="hp" name="hp" >
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
                                <input type="text" value="{{old('email')}}"  class="form-control @error('email') is-invalid @enderror" id="email" name="email" >
                                @error('email')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="verifikasi">Keterangan Verifikasi</label>  
                              <textarea name="verifikasi" id="verifikasi" cols="30" rows="5" class="form-control @error('verifikasi') is-invalid @enderror" readonly></textarea>
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
                                    <!-- <div class="form-group mr-auto">
                                       <h6 for="" class="mr-2 text-dark">Total Transfer : </h6>

                                    </div>
                                    <div class="form-group ml-auto">
                                       <label for="" class="mr-2 text-dark">Biaya Bank</label>
                                       <input type="text" class="form-control biaya_bank" name="biaya_bank" id="biaya_bank" >
                                    </div> -->
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
                                       
                                        </tbody>
                                      </table>
                                      <label>TOTAL </label>
                                      <input type="text" id="total" name="total" class="form-control total" readonly>
                                      <button class="btn btn-sm btn-outline-success mt-3"><i class="fas fa-save"></i> Simpan</butt>
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
          </div>
          <!-- end bentuk form  -->

    @endsection('konten')

    @section('scriptExternal')
   
    <script>
    var acak;
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
        <option value="">-- Cari Program --</option>
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
        <option value="">-- Cari Project --</option>
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
                <button type="button" id="remCF_`+ random +`" class="btn btn-danger btn-sm remCF">
                    <i class="fa fa-minus"></i>
                </button>
            </td>
            <td></td>
        </tr>
      `;
      $("#customFields").append(a);
      acak = random;
      // fitur search pada program 
      $('.mprogram').select2();
      // fitur search pada program 
      $('.mproject').select2();

      $(document).ready(function(){
          Inputmask.extendAliases({
              'myCurrency': {
                  alias: 'numeric',
                  prefix: 'Rp ',
                  digits: 0,
                  autoUnmask: true,
                  removeMaskOnSubmit: true,
                  unmaskAsNumber: true,
                  allowPlus: false,
                  allowMinus: false,
            autoGroup: true,
            groupSeparator: ",", 
              }
          });

          Inputmask.extendAliases({
            'myQty' : {
              alias : 'numeric',
              digits: 0,
              autoUnmask: true,
              removeMaskOnSubmit: true,
              unmaskAsNumber: true,
              allowPlus: false,
              allowMinus: false,
            autoGroup: true,
            }
          });
            
          $("#dana_"+acak).inputmask("myCurrency");
          $("#qty_"+acak).inputmask("myQty");
          $(".jmh").inputmask("myCurrency");
          $("#total").inputmask('myCurrency');
          
          $('#dana_'+acak).keypress(function (event) { UpdateTotal(); })
          $('#qty_'+acak).keypress(function (event) { UpdateTotal(); })
        });		

        function UpdateTotal(event)
        {
          var sum = 0;
          sum += $('#dana_'+acak).val() || 0;
          sum *= $('#qty_'+acak).val() || 0;
          $('#jmh_'+acak).val(sum > 0 ? sum : '');

          var totalSum = 0;
          $('.jmh').each(function() {
          var inputVal = $(this).val();
          if ($.isNumeric(inputVal)) {
            totalSum += parseFloat(inputVal);
          }
          });
          // totals = totalSum + parseInt($("#biaya_bank").val())
          $("#total").val(totalSum).trigger('change');
        }
        
        
    });
    
    // script hapus kolom tambah barang 
    $("#customFields").on('click','.remCF',function(){
        $(this).parent().parent().remove();
    });

    // fitur search propinsi menggunakan select2
    // $('#propinsi').select2();
    // fitur search jaringan menggunakan select2
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
        url: '{{route('carihp')}}',
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
    $("#cariemail").select2({
      placeholder : 'Cari email Wakif',
      ajax:{
        url:"{{route("cariemail")}}",
        dataType:"JSON",
        delay:250,
        processResults:function(data) {
          return {
            results: $.map(data, function(item){
              return {
                text: [
                  item.nm_lengkap, ' - ', item.email
                ],
                id: item.kd_pelanggan
              }
            })
          };
        }
      }
    })
    // menampilkan data wakif jika no hp wakif dipilih 
    $(document).on('change',"#carihp", function(){
      var carihp = $(this).val();
      var datas = '{{route('valuewakif')}}?id='+carihp;
      $.get(datas, function(i){
        $("#kd_pelanggan").val(i.kd_pelanggan);
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
    $(document).on('change',"#cariemail", function(){
      var cariemail = $(this).val();
      var datas = '{{route('valuewakif')}}?id='+cariemail;
      $.get(datas, function(i){
        $("#kd_pelanggan").val(i.kd_pelanggan);
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
    // $(document).on('change','.dana', function(){
    //   var dana = $(this).val();
    //   var qty = $("#qty_" + acak).val();
    //   var hasil = dana * qty;
    //   $("#jmh_" + acak).val(hasil).trigger('change');
    // });
    // $(document).on('change','.qty', function(){
    //   var dana = $(this).val();
    //   var qty = $("#dana_" + acak).val();
    //   var hasil = dana * qty;
    //   $("#jmh_" + acak).val(hasil).trigger('change');
    // });

   
    // menghitung total keseluruhan
    // $(document).on('change','.jmh', function(){
    //   var totalSum = 0;
    //   $('.jmh').each(function() {
    //     var inputVal = $(this).val();
       
    //     if ($.isNumeric(inputVal)) {
    //       totalSum += parseFloat(inputVal);
    //     }
    //   });
    //   totals = totalSum + parseInt($("#biaya_bank").val())
    //   $("#total").val(totalSum).trigger('change');
    // });
    // end total keseluruhan 

    // sctipt chaining/Dynamic Dependant Select 
    $("#cabang").change(function(){
      var cabang = $(this).val();
      var token = $("input[name='_token']").val();
      $.ajax({
        url: "{{route("getcabang")}}",
        method: 'POST',
        data: {cabang:cabang, _token:token},
        success:function(data){
          $("#jaringan").html('');
          $("#jaringan").html(data.options);
        }
      });
    });

    // mrogram jika change ambil nilainya 
    $(document).on('change','.mprogram',function(){
      var mprogram = $(this).val();
      var token = $("input[name='_token']").val();
      $.ajax({
        url: "{{route("getdana")}}",
        method:"POST",
        dataType: "JSON",
        data : {mprogram:mprogram, _token:token},
        success:function(data)
        {
          $("#dana_" + acak).val(data.dana);
        }

      })
      
    });
    
    // masking tgl setor tgl_transaksi
    $('#tgl_transaksi').inputmask("datetime", {
      inputFormat: "dd/mm/yyyy",
      outputFormat: "yyyy-mm-dd",
      inputEventOnly:true,
      date.split("/").reverse().join("/");
    });
    $('#tgl_setor').inputmask("datetime", {
      inputFormat : "dd/mm/yyyy",
      outputFormat : "yyyy-mm-dd",
      inputEventOnly : true,
      date.split("/").reverse().join("/");
    });
    // script jika tgl setor lebih besar dari tgl transaksi dan tidak boleh pilih 2 bulan sebelumn
    // function notnow() {
    //   var startDate = new Date(document.getElementById('tgl_transaksi').value);
    //   var tgl_setor = new Date(document.getElementById('tgl_setor').value);
    //   var today = new Date();
    //   var d = new Date();
    //   d.setDate(d.getDate() - 60);

    //   if (startDate > today || tgl_setor > today) {
    //     alert("Tanggal tidak boleh melewati tanggal sekarang");
    //     document.getElementById('tgl_transaksi').value = "";
    //     document.getElementById('tgl_setor').value = "";
    //   }
    //   else if(startDate < d || tgl_setor < d)
    //   {
    //     alert("Tidak boleh menginput tanggal setelah lewat dari 60 hari");
    //     document.getElementById('tgl_transaksi').value = "";
    //     document.getElementById('tgl_setor').value = "";
    //   }
    // }

  
    </script>
 
    @endsection('scriptExternal')
