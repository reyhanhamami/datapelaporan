@extends('templates.main')


@section('title','Dashboard')
@section('sub','Bukti Transfer')

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
<div class="row">
    <div class="col">
     <div class="card card-small overflow-hidden mb-4">
     <div class="card-header bg-dark">
        <h6 class="m-0 text-white">
        <a href="{{route('inputtransfer')}}" class="mr-auto">
            <span class="material-icons">library_add</span> 
            <i>Tambah bukti transfer</i>
        </a>
        </h6>
     </div>
     <table class="table table-sm" id="ac_tbuku_bank">
  <thead>
    <tr>
      <th scope="col">Rekening</th>
      <th scope="col">Bank</th>
      <th scope="col">Tanggal</th>
      <th scope="col">Deskripsi</th>
      <th scope="col">Ref.</th>
      <th scope="col">Debet</th>
      <th scope="col">ID</th>
      <th scope="col">Sales</th>
      <th scope="col">Keterangan</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

    </div>
    </div>
    </div>
@endsection('konten')


@section('scriptExternal')
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
   $('#ac_tbuku_bank').DataTable({
       "deferRender": true,
        "processing": true,
        "serverSide": true,
        "ajax": 'http://localhost/donasi/api/v1/ac_tbuku_bank',
        "columns": [
            {data: 'nm_kas', name: 'nm_kas', searchable: false},
            {data: 'bank', name: 'bank', searchable: false},
            {data: 'tgl', name: 'tgl'},
            {data: 'deskripsi', name: 'deskripsi'},
            {data: 'kd', name: 'kd'},
            {data: 'debet', name: 'debet'},
            {data: 'id_tr', name: 'id_tr'},
            {data: 'sales', name: 'sales'},
            {data: 'ket', name: 'ket'}
        ]
    });
</script>
    

@endsection('scriptExternal')