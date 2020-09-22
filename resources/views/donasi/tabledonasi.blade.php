@extends('templates.main')
    @section('title','Donasi')

    @section('sub','Daftar Donasi')

    @section('konten')
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
    @if(session('failed'))
        <div class="alert alert-danger">
            {{session('failed')}}
        </div>
    @endif
    @if(session('edit'))
        <div class="alert alert-warning">
            {{session('edit')}}
        </div>
    @endif
    <!-- Data donasi-->
    <div class="row">
    <div class="col">
    <div class="card card-small mb-4">
        <div class="card-header border-bottom">
            <div class="row mt-2">
                <div class="col-md-2">
                    <select name="filter_pembayaran" id="filter_pembayaran" class="form-control">
                        <option value="">-Semua pembayaran-</option>
                        @foreach($pembayaran as $pem)
                            <option value="{{$pem->kd_kas}}">{{$pem->nm_kas}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="filter_cabang" id="filter_cabang" class="form-control">
                        <option value="">-Semua cabang-</option>
                        @foreach($cabang as $cab)
                            <option value="{{$cab->ID}}">{{$cab->Nm}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="text" name="filter_no_kwitansi" id="filter_no_kwitansi" class="form-control" placeholder="Dari Kwintasi"  />
                </div>
                <div class="col-md-2">
                    <input type="text" name="filter_no_kwitansis" id="filter_no_kwitansis" class="form-control" placeholder="Sampai Kwitansi"  />
                </div>
                <div class="col-md-2 input-daterange">
                    <input type="text" name="from_date" id="from_date" class="form-control" placeholder="Dari Tanggal"  />
                </div>
                <div class="col-md-2 input-daterange">
                    <input type="text" name="to_date" id="to_date" class="form-control" placeholder="Sampai Tanggal"  />
                </div>
            </div>
            <div class="row mt-2 d-flex justify-content-end">
                <div class="col-md-2">
                    <select name="filter_status" id="filter_status" class="form-control">
                        <option value="">-pilih Status-</option>
                        <option value="ENTRI">1 - Entri</option>
                        <option value="VERIFIKASI">2 - Verifikasi</option>
                        <option value="SAH">3 - Pengesahan</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="button" name="filter" id="filter" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
                    <button type="button" name="refresh" id="refresh" class="btn btn-dark"><i class="fas fa-sync-alt"></i> Refresh</button>
                    <a href="{{route('donasi')}}" class=" btn btn-success small btn-small">
                        <i class="fas fa-plus"> Tambah</i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body p-0 pb-3 text-center">
        
        <table class="table small  table-striped table-sm table-responsive mb-0" id="donasi" width="100%">
            <thead class="bg-light">
            <tr>
                <th scope="col" class="border-0">Sah</th>
                <th scope="col" class="border-0">NoKwitansi</th>
                <th scope="col" class="border-0">Tgl Setor</th>
                <th scope="col" class="border-0 text-sm" >Tgl Trs</th>
                <th scope=  "col" class="border-0">Tgl Input</th>
                <th scope="col" class="border-0">Kd.Jurnal</th>
                <th scope="col" class="border-0">Nama Wakif</th>
                <th scope="col" class="border-0">Pendaftar</th>
                <th scope="col" class="border-0">Alamat</th>
                <th scope="col" class="border-0">Hp</th>
                <th scope="col" class="border-0">email</th>
                <th scope="col" class="border-0">Dana</th>
                <th scope="col" class="border-0"><i class="fas fa-cogs"></i></th>
            </tr>
            </thead>
            <tbody>
            <!-- looping -->
          
            <!-- end looping  -->
            </tbody>
        </table>
        </div>
    </div>
    </div>
<!-- confirm Modal  -->
 <div class="modal fade" role="dialog" id="confirmModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 align="center" id="isi" style="margin:0;">Apa anda yakin ingin menghapus donasi ini?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">Iya</button>
        <button type="button" class="btn btn-dark" data-dismiss="modal">Tidak</button>
      </div>
    </div>
  </div>
</div>   
<!-- end confirm modal  -->

<!-- upload Modal  -->
 <div class="modal fade" role="dialog" id="upload">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 align="center" id="isi" style="margin:0;">Yakin Upload?</h4>
        <p class="text-muted text-center">Note : upload ke web jika data sudah divalidasi </p>
      </div>
      <div class="modal-footer">
        <button type="button" name="upload_button" id="upload_button" class="btn btn-info">Iya</button>
        <button type="button" class="btn btn-dark" data-dismiss="modal">Tidak</button>
      </div>
    </div>
  </div>
</div>   
<!-- end upload modal  -->

    </div>
    <!-- End data wakif-->

    @endsection

    @section('scriptExternal')
    <script>
    $(document).ready(function() {
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        load_data();
        function load_data(filter_pembayaran = '', filter_cabang = '', filter_no_kwitansi = '', filter_no_kwitansis = '',from_date = '', to_date = '', filter_status = '')
        {
        // datatable 
        var table = $("#donasi").DataTable({
            "dom": 'rt<"bottom"lpi><"clear">',
            processing: true,
            serverSide: true,
            searching: false,
            language:{
                'processing' : '<div class="fixed-top"><div  class="spinner-grow" style="width: 3rem; height: 3rem;" role="status"></div><p class="text-white bg-dark mt-2">Memuat data, Harap tunggu yaa..</p> </div>',
                'search' : 'Cari No Kwitansi',
                'zeroRecords' : 'Data tidak ditemukan'
            },
            ajax:{
                url:'{{route('jsontdonasi')}}',
                data:{filter_pembayaran:filter_pembayaran, filter_cabang:filter_cabang,filter_no_kwitansi:filter_no_kwitansi,filter_no_kwitansis:filter_no_kwitansis,from_date:from_date, to_date:to_date,filter_status:filter_status}
            }, 
            columns : [
                {data:'sah', name:'sah', searchable:false,orderable:false},
                {data:'no_kwitansi', name:'tdonasi.no_kwitansi'},
                {data:'tgl',name:'tdonasi.tgl', searchable: false},
                {data:'tgl_transaksi',name:'tdonasi.tgl_transaksi', searchable: false},
                {data:'tgl_tambah',name:'tdonasi.tgl_tambah', searchable: false},
                {data:'kd_tkm',name:'tdonasi.kd_tkm', searchable: false},
                {data:'nm_wakif',name:'tdonasi.nm_wakif', searchable: false},
                {data:'nm_lengkap',name:'mpelanggan.nm_lengkap', searchable: false},
                {data:'alamat',name:'mpelanggan.alamat', searchable: false},
                {data:'hp',name:'mpelanggan.hp', searchable: false},
                {data:'email',name:'mpelanggan.email', searchable: false},
                {data:'total',name:'tdonasi.total', searchable: false},
                {data:'edit',name:'edit', orderable: false , searchable:false},
            ]
        });
        }

        $('#filter').click(function(){
            var filter_pembayaran = $('#filter_pembayaran').val();
            var filter_cabang = $('#filter_cabang').val();
            var filter_no_kwitansi = $('#filter_no_kwitansi').val();
            var filter_no_kwitansis = $('#filter_no_kwitansis').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var filter_status = $('#filter_status').val();
            // if (filter_cabang != '' ) {
            // if (filter_cabang != '' && filter_pembayaran != '' && from_date != '' && to_date != '') {
                $('#donasi').DataTable().destroy();
                load_data(filter_pembayaran,filter_cabang,filter_no_kwitansi,filter_no_kwitansis,from_date, to_date,filter_status);
            // }
            // else
            // {
            //     alert('Wajib memilih semua untuk memfilter');
            // }
        });
        $('#refresh').click(function(){
            $('#filter_pembayaran').val('');
            $('#filter_cabang').val('');
            $('#filter_status').val('');
            $('#filter_no_kwitansi').val('');
            $('#filter_no_kwitansis').val('');
            $('#from_date').val('');
            $('#to_date').val('');
            $('#donasi').DataTable().destroy();
            load_data();
        })
        
        var no_kwitansi;
        // delete
        $(document).on('click','.delete',function(){
            no_kwitansi = $(this).attr('id');
            $('#confirmModal').modal('show');
            $('#ok_button').text('Iya');
        });

        $('#ok_button').click(function(){
            $.ajax({
                url: "../deletedonasi/"+no_kwitansi,
                beforeSend:function(){
                    $('#ok_button').text('Deleting...');
                },
                success:function(data)
                {
                    setTimeout(function(){
                        $('#confirmModal').modal('hide');
                        $('#donasi').DataTable().ajax.reload();
                        alert('Data Berhasil Didelete');
                    }, 2000);
                },
            })
        });

        // upload 
        $(document).on('click','.upload', function(){
            no_kwitansi = $(this).attr('id');
            $('#upload').modal('show');
            $('#upload_button').text('Iya');
        });

        $('#upload_button').click(function(){
            $.ajax({
                url: "../uploadweb/"+no_kwitansi+"",
                beforeSend: function(){
                    $('#upload_button').text('Uploading...')
                },
                success:function(data)
                {
                    setTimeout(function(){
                        $('#upload').modal('hide');
                        $('#donasi').DataTable().ajax.reload();
                        alert('Data berhasil di kirim');
                    }, 2000);
                }
            })
        });

    });
    
    </script>
    @endsection('scriptExternal')
