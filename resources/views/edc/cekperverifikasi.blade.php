@extends('templates.main')
    @section('cssExternal')


    @section('title','Dashboard')

    @section('sub','Cek Per verifikasi')

    @section('konten')
            @if(count($tbuku_bank) > 0)
            <!-- Data Pelanggan-->
            <div class="row">
              <div class="col-12 mb-4">
                <div class="card shadow">
                  <div class="card-header border-bottom">
                    <h6 class=" d-inline">
                    <a href="{{route('buktitransfer')}}" class="btn btn-outline-warning"><i class="far fa-hand-point-left"> Kembali</i></a>
                    </h6>
                  </div>
                  <h6>Bukti Transfer masuk ke rek bwa</h6>
                  <div class="card-body">
                    <table class="table table-striped table-responsive table-sm" id="dataedc" style="width:100%">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Rekening</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Debet</th>
                        <th scope="col">ID</th>
                        <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- looping cek per verifikasi  -->
                        @if(count($tbuku_bank) > 0)
                        @foreach($tbuku_bank as $buku_bank)
                        <input type="hidden" name="id_tr" id="id_tr" value="{{$buku_bank->id_tr}}">
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$buku_bank->nm_kas}}</td>
                            <td>{{$buku_bank->tgl}}</td>
                            <td>{{$buku_bank->deskripsi}}</td>
                            <td>Rp.{{number_format($buku_bank->debet)}}</td>
                            <td>{{$buku_bank->id_tr}}</td>
                            <td>
                            @if($buku_bank->ket == 'NULL')
                            {{$buku_bank->ket}}
                            <a href="" class='btn btn-sm btn-dark'>Edit Ket.</a>
                            @else 
                            <a href="" class='btn btn-sm btn-dark'>Tambah Ket.</a>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr >
                            <td colspan='9'>Data tidak ditemukan, kemungkinan terdapat selisih angka, tolong cek di <a href="http://mymgm.bwa.id:300/" class="btn btn-sm btn-outline-danger">Mymgm:300</a> dengan kata kunci <span class="text-info">{{$sumber}}</span> pada tanggal <span class="text-info">{{$tanggal}}</span></td>
                        </tr>
                        @endif
                        <!-- end looping cek per verifikasi  -->
                    </tbody>
                    </table>
                  </div>
            
                </div>
              </div>
            </div>
            <!-- End data pelanggan-->

            <!-- Data Pelanggan-->
            <div class="row">
              <div class="col-12 mb-4">
                <div class="card shadow">
                  <div class="card-header border-bottom">
                    <h6 class=" d-inline">
                     <h5>verifikasi</h5>
                    </h6>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-3">
                        <select name="cabang" id="cabang" class="form-control">
                          @foreach($mcabang as $cab)
                          <option value="{{$cab->ID}}">{{$cab->Nm}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-3">
                        <select name="agen" id="agen" class="form-control">
                          <option value="712">Edc</option>
                          <option value="181">Duta Keberkahan</option>
                        </select>
                      </div>
                    </div>
                    <table class="table table-striped table-responsive-md" id="dataedc" style="width:100% !important">
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
                          $i = 1;
                        ?>
                        @while($det = $detail->fetch())
                        <?php
                            if ($det['payment_type'] == "SD") {
                            $det['payment_type'] =  str_replace($det['payment_type'], "KDT_", $det['payment_type']);
                            }
                            elseif ($det['payment_type'] == "TB") {
                            $det['payment_type'] = str_replace($det['payment_type'], "FIN_", $det['payment_type']);
                            }
                            elseif ($det['payment_type'] == "LAJ") {
                            $det['payment_type'] = str_replace($det['payment_type'], "LAJ_", $det['payment_type']);
                            }
                            else
                            {
                            $det['payment_type'] =  str_replace($det['payment_type'], "AJA_", $det['payment_type']);
                            }

                            $kode = substr_replace($det['code'],$det['payment_type'],0,0);
                            $kodeubah = str_replace('.','_',$kode);

                            $sum+=$det['Amt'];

                        ?>
                        <tr>
                        <td>{{$i++}}</td>
                        <td>{{$kodeubah}}
                        @if($det['to_mgm'] == 'Y')
                          <span class="fas fa-check-circle text-success"></span>
                        @endif
                        </td>
                        <td>{{$det['RefID']}}</td>
                        <td>{{$det['name']}}</td>
                        <td>{{$det['TglSettlement']}}</td>
                        <td>Rp.{{number_format($det['Amt']),0,0}}</td>
                        <td>
                            <!-- <a href="{{url('/editpengesahandonasi/'.$kodeubah)}}" class="btn btn-outline-dark"><i class="fas fa-edit"> Edit</i></a> -->
                            @if($det['to_mgm'] == 'Y')
                            <button type="button"  class="btn my-2 btn-success btn-sm" disabled><span class=""> Sudah Di Verif</small></button>
                            @else
                            <button type="button" name="verif" id="{{$kodeubah}}" class="verif btn my-2 btn-success btn-sm"><i class="fas fa-clipboard-check"> <span class="small"> Verif Otomatis</small></i></button>
                            @endif
                        </td>
                        </tr>
                        @endwhile
                        <!-- end looping pembayaran  -->
                    </tbody>
                    </table>
                        <p>Total Keseluruhan transaksi: Rp.{{number_format($sum)}}</p>
                  </div>
            
                </div>
              </div>
            </div>
            @else
              @section('scriptExternal')
              <script>
                $(document).ready(function(){
                  alert('Dana Belum ada di buku bank');
                  window.location = 'http://localhost/donasi/buktitransfer';
                })
              </script>
              @endsection('scriptExternal')
            @endif
            <!-- End data pelanggan-->
    @endsection

    @section('scriptExternal')
    <script>
      var no_kwitansi;
      var id_tr = $('#id_tr').val();
      var cabang;
      var agen;
        // verif
        $(document).on('click','.verif',function(){
            cabang = $('#cabang').on('change').val();
            agen = $('#agen').on('change').val();
            no_kwitansi = $(this).attr('id');
            
            $.ajax({
                url: "../../../../../verifotomatis/"+no_kwitansi+"/"+id_tr+"/"+agen+"/"+cabang+"",
                success:function(data)
                {
                  location.reload();
                  alert('Data berhasil di Verif');
                }
            });
        });
    </script>
    @endsection('scriptExternal')
