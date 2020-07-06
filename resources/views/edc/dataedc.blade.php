@extends('templates.main')
 

    @section('title','Dashboard')

    @section('sub','Data Keuangan')

    @section('konten')
            
            <!-- Data Pelanggan-->
            <div class="row">
              <div class="col-12 mb-4">
                <div class="card shadow">
                  <div class="card-header border-bottom">
                    <h6 class=" d-inline">
                    </h6>
                  </div>
                  <div class="card-body ">
                    <table class="display table-sm table-responsive" id="dataedc" style="width:100%">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">No_kwitansi</th>
                        <th scope="col">Merchant id / reference</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Hp</th>
                        <th scope="col">Tgl Transaksi</th>
                        <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- looping pembayaran  -->
                        @foreach($stock_movement as $movement)
                        <?php
                            if ($movement->payment_type == "SD") {
                            $movement->payment_type =  str_replace($movement->payment_type, "KDT_", $movement->payment_type);
                            }
                            elseif ($movement->payment_type == "TB") {
                            $movement->payment_type = str_replace($movement->payment_type, "FIN_", $movement->payment_type);
                            } else
                            {
                            $movement->payment_type =  str_replace($movement->payment_type, "AJA_", $movement->payment_type);
                            }

                            $kode = substr_replace($movement->code,$movement->payment_type,0,0);
                            $kodeubah = str_replace('.','_',$kode);
                        ?>
                        <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><?php echo $kodeubah ?></td>
                        <td>{{$movement->reference}}</td>
                        <td>{{$movement->name}}</td>
                        <td>{{$movement->mobile}}</td>
                        <td>{{date('Y-m-d', strtotime($movement->payment_completed_at))}}</td>
                        <td>{{$movement->total}}</td>
                        </tr>
                        @endforeach
                        <!-- end looping pembayaran  -->
                    </tbody>
                    </table>
                  </div>
            
                </div>
              </div>
            </div>
            <!-- End data pelanggan-->
    @endsection

    @section('scriptExternal')
    <script>
        $(document).ready( function () {
            $('#dataedc').DataTable({
              language : {
                searchPlaceholder: "Input merchantid+Ymd"
              }
            });
        });
    </script>
    @endsection('scriptExternal')
