    <style>
      .kecil {
        font-size:12px;
      }
    </style>
    
     <div class="container">
                    <div class="row">
                      <div class="" style="flex: 0 0 20% !important;">
                        <div class=" kecil">Order No : {{$order->id_order}}</div>
                      </div>
                      <div class="">
                        @foreach($expedisi as $ex)
                          @if($ex->id_expedisi == $order->expedisi_order)
                          <div class=" kecil">Expedisi : {{$ex->nama_expedisi}}</div>
                          @endif
                        @endforeach
                      </div>
                      <div class="">
                        <div class=" kecil">No.Resi/Booking : 
                        @if($order->resiotomatis_order == NULL)
                        -
                        @else
                          {{$order->resiotomatis_order}}
                        @endif
                        </div>
                      </div>
                      <div class="">
                      @if($order->pengirim_order != NULL)
                        <div class=" kecil">Pengirim : {{$order->pengirim_order}} | {{$order->telepon_order}}</div>
                      @else
                      @foreach($pengirim as $pen)
                        @if($pen->id == $order->reseller_order)
                          <div class=" kecil">Pengirim : {{$pen->name}} | {{$pen->telepon}}</div>
                        @endif
                      @endforeach
                      @endif
                      </div>
                    </div>
                    <!-- border  -->
                    <table style="border:1px solid black ">
                      <thead class="row container">
                      <!-- penerima disisi kiri  -->
                      <tr>
                        <th class="font-weight-bold">Penerima :</th>
                        <th class="font-weight-bold">Product : <span class="kecil" style="border:1px dotted black"><br>Order No : {{$order->id_order}}</span></th>
                      </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class=" kecil">Nama Penerima : {{$order->customer['nama_customer']}}</div>
                            <div class="kecil">No Telepon : {{$order->customer['telepon_customer']}}</div>
                            <div class="kecil">Alamat : {{$order->customer['alamat_customer']." ". $order->customer['kelurahan_customer']." ". $order->customer['kecamatan_customer']." ".$order->customer['kota_customer']}}</div>
                            <div class="kecil">Kecamatan {{$order->customer['kecamatan_customer']}}</div>
                            <div class="kecil">Kota/Kabupaten {{$order->customer['kota_customer']}}</div>
                            <div class="kecil">Provinsi {{$order->customer['provinsi_customer']}}</div>
                            <div class="kecil">Kode Pos {{$order->customer['kodepos_customer']}}</div>
                          </td>
                          <td>
                            @foreach($joinbarang as $asd)
                            @if((int)$asd->id_order == $order->id_order)
                            <li class="kecil" style="padding-left:25px">{{$asd->nama_barang}}
                            ({{$asd->stock_berkurang}})
                            </li>
                            @endif
                          @endforeach
                          </td>
                        </tr>
                      </tbody>
                      <!-- end penerima  -->
                      <!-- produk disisi kiri  -->
                     
                         
                  
                      <!-- end produck -->
                    </table>
                  </div>