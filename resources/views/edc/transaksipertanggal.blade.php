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
                    <a href="{{route('buktitransfer')}}" class="btn btn-outline-warning"><i class="far fa-hand-point-left"> Kembali ke donasi edc</i></a>
                    <a href="{{route('buktitransfer')}}" class="btn btn-outline-warning"><i class="far fa-hand-point-left"> Kembali ke seluruh donasi</i></a>
                    </h6>
                  </div>
                  <div class="card-body">
                    <table class="table table-striped table-responsive" id="dataedc" style="width:100% !important">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">No_kwitansi</th>
                        <th scope="col">Merchant id / reference</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tgl Settlement</th>
                        <th scope="col">Total</th>
                        <th scope="col"><i class="fas fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- looping pembayaran  -->
                        <?php 
                          $sum = 0;
                        ?>
                        @foreach($detail as $det)
                        <?php
                            if ($det->payment_type == "SD") {
                            $det->payment_type =  str_replace($det->payment_type, "KDT_", $det->payment_type);
                            }
                            elseif ($det->payment_type == "TB") {
                            $det->payment_type = str_replace($det->payment_type, "FIN_", $det->payment_type);
                            } else
                            {
                            $det->payment_type =  str_replace($det->payment_type, "AJA_", $det->payment_type);
                            }

                            $kode = substr_replace($det->code,$det->payment_type,0,0);
                            $kodeubah = str_replace('.','_',$kode);

                            $sum+=$det->Amt;

                            $curl = curl_init();

                            curl_setopt_array($curl, array(
                              CURLOPT_URL => "http://localhost/donasi/api/v1/tdonasi/".$kodeubah,
                              CURLOPT_RETURNTRANSFER => true,
                              CURLOPT_ENCODING => "",
                              CURLOPT_MAXREDIRS => 10,
                              CURLOPT_TIMEOUT => 0,
                              CURLOPT_FOLLOWLOCATION => true,
                              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST => "GET",
                            ));

                            $response = curl_exec($curl);

                            curl_close($curl);

                            $response = json_decode($response,true);

                            $alur_kerja = $response[0]['alur_kerja'];
                        ?>
                        <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$kodeubah}}
                          @if($alur_kerja == 'SAH')
                            <i class="fas fa-check-circle text-success"></i>
                          @endif
                        </td>
                        <td>{{$det->RefID}}</td>
                        <td>{{$det->name}}</td>
                        <td>{{$det->TglSettlement}}</td>
                        <td>Rp.{{number_format($det->Amt),0,0}}</td>
                        <td>
                            <!-- <a href="{{url('/editpengesahandonasi/'.$kodeubah)}}" class="btn btn-outline-dark"><i class="fas fa-edit"> Edit</i></a> -->
                            <button type="button" name="verif" id="{{$kodeubah}}" class="verif btn my-2 btn-success btn-sm"><i class="fas fa-clipboard-check"> <span class="small"> Verif Otomatis</small></i></button>

                        </td>
                        </tr>
                        @endforeach
                        <!-- end looping pembayaran  -->
                    </tbody>
                    </table>
                        <p>Total Keseluruhan transaksi: Rp.{{number_format($sum)}}</p>
                  </div>
            
                </div>
              </div>
            </div>
            <!-- End data pelanggan-->
    @endsection

    @section('scriptExternal')
    <script>
        $(document).ready( function () {
            var no_kwitansi;
        // verif
        $(document).on('click','.verif',function(){
            no_kwitansi = $(this).attr('id');
            $.ajax({
                url: "../verifotomatis/"+no_kwitansi+"",
                success:function(data)
                {
                  location.reload();
                  alert('Data berhasil di Verif');
                }
            });
        });

        
        });
    </script>
    @endsection('scriptExternal')
