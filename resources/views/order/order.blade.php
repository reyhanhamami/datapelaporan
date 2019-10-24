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
                                        <select name="customer_order form-control" id="inputState" class="customer_order form-control @error('customer_order') is-invalid @enderror">
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
                                  <input type="text" placeholder="ongkoskirim" name="ongkir_order" class="@error('ongkir_order') is-invalid @enderror form-control">
                                </div>  
                                <div class="col-3">
                                  <input type="text" placeholder="Total Keseluruhan Harga"  name="total_order" class="form-control">
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
                                            <th>Catatan</th>
                                            <th>sub total</th>
                                            <th class="text-right"><i class="fas fa-cogs"></i></th>
                                        </tr></thead>
                                        <tbody>
                                        </tbody>
                                      </table>
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
    // script tambah barang 
    $(".addCF").click(function(){
      $("#customFields").append(`
      <tr>
        <td>
          <select name="barang_order[]" id="barang_order" class="form-control barang_order"></select>
        </td>
        <td>
          <input type="text" name="stock_barang[]" class="form-control stock_barang" readonly></select>
        </td>
        <td>
          <input type="text" name="harga_jual[]" class="form-control harga_jual" readonly></select>
        </td>
        <td>
          <input type="text" name="beliberapa_order[]" class="form-control beliberapa_order"></select>
        </td>
        <td>
          <input type="text" name="note_order[]" class="form-control note_order"></select>
        </td>
        <td>
          <input type="text" name="subtotal[]" class="form-control subtotal" readonly></select>
        </td>
       <td class="text-right">
        <button type="button" class="btn btn-danger btn-sm remCF"><i class="fa fa-minus"></i></button>
        </td>
      </tr>
      `);
    });
    // end script tambah barang 
    // script hapus kolom tambah barang 
    $("#customFields").on('click','.remCF',function(){
        $(this).parent().parent().remove();
    });
    // end script hapus kolom tambah barang 

    $(document).on('click','.barang_order',function(){
        $('.barang_order').each(function(){
          $(this).select2({
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
              cache: true
            }
          });
        });
    });
    
    $(document).on('change','.barang_order', function(){
        var barang_order = $(this).val();
        console.log(barang_order);
        $.get('/getbarang?id='+barang_order, function(data){
          $(".stock_barang").val(data.stock_barang);
          $(".harga_jual").val(data.harga_jual).trigger('change');
        });
    });

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

    <script type="text/javascript">
    $(document).ready(function(){
      $("#barang_order").select2({
        placeholder: 'Pilih Produk...',
        ajax: {
          url: '/caribarang',
          dataType: 'json',
          delay:250,
          processResults: function (data) {
            return {
              results: $.map(data, function (item) {
                return {
                  text: [item.nama_barang,' - ', "Stock:",item.stock_barang,' Harga: ', item.harga_jual],
                  id: item.id_barang
                }
              })
            };
          },
          cache: true
        }
      });
    })
    </script>

    @endsection('scriptExternal')
