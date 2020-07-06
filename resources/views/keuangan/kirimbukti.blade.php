@extends('templates.main')

@section('title','Overview')
@section('sub','Kirim bukti pembayaran')

@section('konten')

    <!-- Data Pelanggan-->
            <div class="row">
              <div class="col-12 mb-4">
                <div class="card shadow">
                  <div class="card-header border-bottom">
                    <h6 class="m-0 d-inline">
                    <a href="{{route('keuangan')}}" class="btn btn-sm btn-outline-info"><i class="fas fa-angle-left"></i> Kembali</a>
                    </h6>
                  </div>
                  <div class="card-body p-0">
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">No Kwitansi</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Program</th>
                        <th scope="col">Project</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- looping pembayaran  -->
                        @foreach($detail as $det)
                        <tr>
                        <td>{{$det->no_kwitansi}}</td>
                        <td>{{$det->nm_wakif}}</td>
                        <td>{{$det->nm_program}}</td>
                        <td>{{$det->nm_project}}</td>
                        <td>{{$det->qty}}</td>
                        <td>{{$det->jmh}}</td>
                        </tr>
                        @endforeach
                      
                      
                        <!-- end looping pembayaran  -->
                    <div class="float-right">
                    </div>
                    </tbody>
                    <tfoot>
                    </tfoot>
                    </table>
                  </div>
            
                </div>
              </div>
            </div>
            <!-- End data pelanggan-->
           
@endsection('konten')
