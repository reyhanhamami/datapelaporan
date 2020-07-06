@extends('templates.main')
   
    @section('title','Dashboard')

    @section('sub','Data Keuangan')

    @section('konten')
            
            <!-- Data Pelanggan-->
            <div class="row">
              <div class="col-12 mb-4">
                <div class="card shadow">
                  <div class="card-header border-bottom">
                    <h6 class="d-inline">
                    </h6>
                  </div>
                  <div class="card-body">
                    <table class="display" id="datakeuangan">
                    <thead>
                        <tr>
                        <th scope="col">No Kwitansi</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kas</th>
                        <th scope="col">Tgl Transaksi</th>
                        <th scope="col">Total</th>
                        <th scope="col">kd_jurnal</th>
                        <th scope="col">Cabang</th>
                        <th scope="col">Alur Kerja</th>
                        <th scope="col"><i class="fas fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- looping pembayaran  -->
                        @foreach($tdonasi as $donasi)
                        <tr>
                        <td>{{$donasi->no_kwitansi}}</td>
                        <td>{{$donasi->nm_wakif}}</td>
                        <td>{{$donasi->nm_kas}}</td>
                        <td>{{$donasi->tgl_transaksi}}</td>
                        <td>{{$donasi->total}}</td>
                        <td>{{$donasi->kd_tkm}}</td>
                        <td>{{$donasi->Nm}}</td>
                        <td>{{$donasi->alur_kerja}}</td>
                        <td><a href="{{url('/keuangan/bukti/'.$donasi->id)}}" class="btn btn-sm btn-outline-info"><i class="fas fa-info-circle"></i> Detail</a></td>
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
            $('#datakeuangan').DataTable({
              serverSide:true
            });
        });
    </script>
    @endsection('scriptExternal')
