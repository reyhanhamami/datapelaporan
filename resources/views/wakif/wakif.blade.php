@extends('templates.main')
    @section('title','Wakif')

    @section('sub','Daftar Wakif')

    @section('konten')
            
    <!-- Data wakif-->
    <div class="row">
    <div class="col">
    <div class="card card-small mb-4">
        <div class="card-header border-bottom">
        <h6 class="m-0">Daftar Wakif</h6>
        </div>
        <div class="card-body p-0 pb-3 text-center">
        <table class="table table-sm table-striped table-responsive-sm mb-0" id="wakif">
            <thead class="bg-light">
            <tr>
                <th scope="col" class="border-0">Kode</th>
                <th scope="col" class="border-0">Nama Lengkap</th>
                <th scope="col" class="border-0 text-sm" >Alamat</th>
                <th scope="col" class="border-0">Hp</th>
                <th scope="col" class="border-0">Email</th>
                <th scope="col" class="border-0">Kota</th>
                <th scope="col" class="border-0"><i class="fas fa-cogs"></i></th>
            </tr>
            </thead>
            <tbody>
          
            </tbody>
        </table>
       
        </div>
    </div>
    </div>
    </div>
    <!-- End data wakif-->

    @endsection
    
    @section('scriptExternal')
    <script>
    $(document).ready(function(){
        $('#wakif').DataTable({
            processing:true,
            serverSide:true,
            ajax:{
                url: "{{route('jsonwakif')}}",
            },
            columns:[
                {data:'CustomerNo', name:'CustomerNo'},
                {data:'customername', name:'customername'},
                {data:'address', name:'address'},
                {data:'MobilePhone', name:'MobilePhone'},
                {data:'customeremail', name:'customeremail'},
                {data:'city', name:'city'},
                {data:'button', name:'button', searchable:false,orderable:false},
            ]
        });
    });
    </script>
    @endsection('scriptExternal')
