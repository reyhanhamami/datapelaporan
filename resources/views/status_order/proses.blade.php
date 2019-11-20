@extends('templates.main')

@section('title','Overview')
@section('sub','Proses Packing')

@section('konten')
<!-- <a href="{{route('add')}}" class="btn btn-outline-primary mb-3"><i class="fas fa-plus-square"></i> Tambah data</a> -->
@if(session('success'))
  <div class="alert alert-success">
    {{session('success')}}
  </div>
@endif
@if(session('delete'))
  <div class="alert alert-danger">
    {{session('delete')}}
  </div>
@endif
@if(session('update'))
  <div class="alert alert-info">
    {{session('update')}}
  </div>
@endif
      <!-- Default Light Table -->
            <div class="row">
              <div class="col">
                <div class="card card-small mb-4 table-responsive">
                  <div class="card-header border-bottom">
                    <h6 class="m-0 d-inline">Detail Order <span class="float-right"></span></h6>
                  </div>
                  <div class="container">
                    <div class="row">
                      <div class="col-3" style="flex: 0 0 20% !important;">
                        <div class="py-3">Order No : {{$order->id_order}}</div>
                      </div>
                      <div class="col-2">
                        @foreach($expedisi as $ex)
                          @if($ex->id_expedisi == $order->expedisi_order)
                          <div class="py-3">Expedisi : {{$ex->nama_expedisi}}</div>
                          @endif
                        @endforeach
                      </div>
                      <div class="col-3">
                        <div class="py-3">No.Resi/Booking : 
                        @if($order->resiotomatis_order == NULL)
                        -
                        @else
                          {{$order->resiotomatis_order}}
                        @endif
                        </div>
                      </div>
                      <div class="col-4">
                      @if($order->pengirim_order != NULL)
                        <div class="py-3">Pengirim : {{$order->pengirim_order}} | {{$order->telepon_order}}</div>
                      @else
                      @foreach($pengirim as $pen)
                        @if($pen->id == $order->reseller_order)
                          <div class="py-3">Pengirim : {{$pen->name}} | {{$pen->telepon}}</div>
                        @endif
                      @endforeach
                      @endif
                      </div>
                    </div>
                    <!-- border  -->
                    <div style="border:1px solid black" class="mb-4">
                      <div class="row container">
                      <!-- penerima disisi kiri  -->
                      <div class="col-6">
                        <div class="font-weight-bold">Penerima :</div>
                        <div class="mt-2">Nama Penerima : {{$order->customer['nama_customer']}}</div>
                        <div>No Telepon : {{$order->customer['telepon_customer']}}</div>
                        <div>Alamat : {{$order->customer['alamat_customer']." ". $order->customer['kelurahan_customer']." ". $order->customer['kecamatan_customer']." ".$order->customer['kota_customer']}}</div>
                        <div>Kecamatan {{$order->customer['kecamatan_customer']}}</div>
                        <div>Kota/Kabupaten {{$order->customer['kota_customer']}}</div>
                        <div>Provinsi {{$order->customer['provinsi_customer']}}</div>
                        <div>Kode Pos {{$order->customer['kodepos_customer']}}</div>
                      </div>
                      <!-- end penerima  -->
                      <!-- produk disisi kiri  -->
                      <div class="col-6" style="border-left:1px dotted black">
                        <div class="font-weight-bold">Product :</div>
                        <small>Order No : {{$order->id_order}}</small>
                          <ul>
                          @foreach($joinbarang as $asd)
                            @if((int)$asd->id_order == $order->id_order)
                            <li>{{$asd->nama_barang}}
                            ({{$asd->stock_berkurang}})
                            </li>
                            @endif
                          @endforeach
                          </ul>
                      </div>
                      </div>
                      <!-- end produck -->
                    </div>
                  </div>
                  <!-- end border  -->
                  <a href="{{url('status_order/PreviewPrint/'.$order->id_order)}}" target="_blank" class="btn btn-secondary"><i class="fas fa-print"></i> Preview For Print</a>
                </div>
              </div>
            </div>
            <!-- End Default Light Table -->
            <!-- cetak -->
             <div class="row">
              <div class="col">
                <div class="card card-small mb-4 table-responsive">
                  <div class="card-header border-bottom">
                    <form action="" enctype="multipart/multiform-data" method="post">
                      <label for="upload">Upload Bukti packing</label>
                      <input type="file" class="form-control" id="upload">
                    </form>
                  </div>
                </div>    
              </div>
            </div>
            <!-- end cetak -->
@endsection('konten')
