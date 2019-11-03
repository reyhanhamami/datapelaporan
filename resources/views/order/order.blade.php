@extends('templates.main')

    @section('title','Dashboard')

    @section('sub','Input Order')

    @section('konten')
        <!--start row main conten -->
        <div class="row">
             <!-- bentuk form start  -->
            <div class="col-12 mb-4">
                <div class="card card-small mb-4">
                  <div class="card-header border-bottom">
                    <h6 class="m-0">Form Inputs</h6>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                      <div class="row">
                        <div class="col-sm-12 col-md-12">
                          <strong class="text-muted d-block mb-2">Input pesanan</strong>
                          <form method="post" action="{{route('storeorder')}}">
                          @csrf
                          <input type="hidden" name="reseller_order" value="{{Auth::user()->id}}" id="">
                          <div class="form-group">
                                <div class="form-row">
                                    <div class="form-group col-xl-9 col-md-12">
                                        <select name="customer_order" id="inputState" class="customer_order form-control @error('customer_order') is-invalid @enderror">
                                        @error('customer_order')
                                          <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                        </select>
                                        <div class="text-info small">*jika nomer telepon customer tidak ditemukan silahkan klik tombol tambah customer baru</div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <a href="{{route('addcustomer')}}" class="btn btn-outline-info"><i class="fas fa-user-plus"></i> Tambah Customer</a> 
                                    </div>
                                </div>
                            </div>
                            <!-- checkbox dropship  -->
                            <div class="form-group">
                             <div class="custom-control custom-switch ml-5">
                                <input type="checkbox" class="custom-control-input"  id="changeShip"> Dropship?
                                <label class="custom-control-label" for="changeShip"></label>
                              </div>
                            </div>
                              <div id="changeShipInputs">
                                <div class="form-group">
                              <div class="form-row">
                                <div class="col-6">
                                  <label for="">Nama Dropship / Nama Pengirim Dropship</label>
                                  <input type="text" class="form-control" name="pengirim_order" id="pengirimorder">
                                </div>  
                                <div class="col-6">
                                  <label for="">No Telepon pengirim (Dropship)</label>
                                  <input type="text" class="form-control @error('telepon_order') is-invalid @enderror" name="telepon_order" id="teleponorder">
                                  @error('telepon_order')
                                  <div class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                  @enderror
                                </div>  
                              </div>
                            </div>
                              </div>
                            <!-- end dropship  -->
                            <div class="form-row">
                            <div class="form-group col-md-5">
                                    <select name="ecommerce_order" class="form-control">
                                    <option value="">-- Pilih Ecommerce --</option>
                                    @foreach($ecommerce as $eco)
                                    <option value="{{$eco->id_ecommerce}}">{{$eco->nama_ecommerce}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                              <label for="">Resi Otomatis <span class="text-primary small">*jika tidak kosongkan</span></label>
                              <input type="text" class="form-control col-6" name="resiotomatis_order">
                            </div>
                            <div class="form-group">
                              <div class="form-row">
                                <div class="col-5">
                                <select id="inputState" class="form-control" name="expedisi_order">
                                    <option selected="">Pilih Expedisi...</option>
                                    @foreach($expedisi as $exp)
                                    <option value="{{$exp->id_expedisi}}">{{$exp->nama_expedisi}}</option>
                                    @endforeach
                                </select>
                                </div>  
                                <div class="col-4">
                                  <input type="text" id="ongkir_order" placeholder="ongkoskirim" name="ongkir_order" class="@error('ongkir_order') is-invalid @enderror form-control ongkir_order">
                                </div>  
                              </div>
                            </div>

                            <!-- add barang -->
                            <div class="row">
                                <div class="col-md-12 otherplace">
                                    <div class="form-inline clearfix mb-2">
                                    <div class="form-group ml-auto">
                                       <button type="button" class="btn btn-primary btn-sm addCF"><i class="fa fa-plus"></i>Tambah Barang</button>
                                    </div>
                                    </div>
                                    <div class="table-responsive">
                                      <table class="table m-t-30" id="customFields">
                                       <thead>
                                        <tr><th>Nama barang</th>
                                            <th>Stock</th>
                                            <th>Harga</th>
                                            <th>beli berapa</th>
                                            <th>Diskon</th>
                                            <th>Catatan</th>
                                            <th>sub total</th>
                                            <th class="text-right"><i class="fas fa-cogs"></i></th>
                                        </tr></thead>
                                        <tbody>
                                        </tbody>
                                      </table>
                                      <label>Harga Total </label>
                                      <input type="text" id="total" name="total" class="form-control total" readonly>
                                   </div>
                                   </div>
                                   </div>
                                </div>
                            </div>
                            <!-- end barang  -->

                        </div>
                            <div class="form-group ">
                                <button class="btn btn-primary"><i class="fas fa-shipping-fast"></i> Proses Order</button> 
                                <a class="btn btn-warning text-white"><i class="fas fa-undo"></i> Kembali</a> 
                            </div>
                          </form>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
                  <!-- end bentuk form  -->
              
            

        </div><!-- end row  -->

    @endsection('konten')

    @section('scriptExternal')
   
    <script>
    var acak;
    // script tambah barang 
    $(".addCF").click(function(){
  
      var random = Math.floor((Math.random() * 100000) + 1);
      a = `
      <tr id="id_barang_`+ random +`">
        <td style="width:143px">
          <select name="barang_order[]" id="barang_order_`+ random +`" class="form-control barang_order"></select>
        </td>
        <td>
          <input type="text" name="stock_barang[]" id="stock_barang_`+ random +`" class="form-control stock_barang" readonly>
        </td>
        <td>
          <input type="text" name="harga_jual[]" id="harga_jual_`+ random + `" class="form-control harga_jual" readonly>
        </td>
        <td>
          <input type="text" name="beliberapa_order[]" id="beliberapa_order_`+ random +`" class="form-control beliberapa_order">
        </td>
        <td>
          <input type="text" name="diskon_order[]" id="diskon_order_`+ random +`" class="form-control diskon_order">
        </td>
        <td>
          <input type="text" name="note_order[]" id="note_order_`+ random +`" class="form-control note_order">
        </td>
        <td>
          <input type="text" name="subtotal[]" id="subtotal_`+ random + `" class="form-control subtotal" readonly>
        </td>
       <td class="text-right">
        <button type="button" class="btn btn-danger btn-sm remCF"><i class="fa fa-minus"></i></button>
        </td>
      </tr>
      `;
      $("#customFields").append(a);
      acak = random;
    });
    // end script tambah barang 
    // script hapus kolom tambah barang 
    $("#customFields").on('click','.remCF',function(){
        $(this).parent().parent().remove();
    });
    // end script hapus kolom tambah barang 

    // script cari barang
    $(document).on('click','.barang_order',function(){
        var tes =  $(this).select2({
            placeholder: 'Pilih Barang',
            ajax: {
              url: '/caribarang',
              dataType: 'json',
              delay: 250,
              processResults: function (data) {
                return {
                  results: $.map(data, function (item) {
                    return {
                      text:item.nama_barang,
                      id: item.id_barang
                    }
                  })
                };
              },
            }
          });
    });
    // end script cari barang 
      $(".addCF").prop("disabled",true);
    $(document).on('change','.ongkir_order', function(){
          var ongkir = $(this).val();
          $(".ongkir_order").val(ongkir);
          $(".addCF").prop("disabled",false);
    });
    // menampilkan stock dan harga jual jika barang dipilih
    $(document).on('change','.barang_order', function(){
        var barang_order = $(this).val();
        var datas = '/getbarang?id='+barang_order; 
        $.get(datas , function(data){
          $("#stock_barang_" + acak).val(data.stock_barang);
          $("#harga_jual_"+ acak).val(data.harga_jual).trigger('change');
        });
    });
    // end barang dipilih

    // subtotal untuk beli berapa di kali sama harga jual
    $(document).on('change','.beliberapa_order', function(){
      var barang_order = $(this).val();
      var jumlah = $("#beliberapa_order_" + acak).val();
      var total = parseInt(jumlah) * $("#harga_jual_"+acak).val();
      $("#subtotal_"+acak).val(total).trigger('change');
    });
    // end subtotal 

    // subtotal untuk diskon
    $(document).on('change','.diskon_order', function(){
      var diskon_order = $(this).val();
      var diskon = $("#diskon_order_" + acak).val();
      var kurang = $("#subtotal_"+ acak).val() - parseInt(diskon);
      $("#subtotal_"+acak).val(kurang).trigger('change');
    });

    // menghitung total keseluruhan
    $(document).on('change','.subtotal', function(){
      var totalSum = 0;
      $('.subtotal').each(function() {
        var inputVal = $(this).val();
        console.log(inputVal);
        if ($.isNumeric(inputVal)) {
          totalSum += parseFloat(inputVal);
        }
      });
      totals = totalSum + parseInt($("#ongkir_order").val())
      $("#total").val(totals).trigger('change');
    });
    // end total keseluruhan 

    // get customer phone dengan select2 
     $(".customer_order").select2({
      placeholder: 'Pilih No HP Customer...',
      ajax: {
        url: '/cari-telepon',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
            return {
              text: [item.telepon_customer, ' - ' ,item.nama_customer," ", item.alamat_customer],
              id: item.id_customer
            }
          })
        };
          },
          cache: true
        }
      });
      // end get customer 
    </script>
 
    <!-- script dropship hide / show when checkbox ceklis  -->
    <script >
     var checkbox = $('#changeShip'),
        chShipBlock = $('#changeShipInputs');

      chShipBlock.hide();

      checkbox.on('click', function() {
        if ($(this).is(':checked')) {
          chShipBlock.show();
          chShipBlock.find('input').attr('required', true);
        } else {
          chShipBlock.hide();
          chShipBlock.find('input').attr('required', false);
        }
      })

    </script>
    <!-- end script dropship  -->

    @endsection('scriptExternal')
