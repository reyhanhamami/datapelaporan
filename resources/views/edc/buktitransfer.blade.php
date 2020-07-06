@extends('templates.main')


@section('title','Dashboard')
@section('sub','Bukti Transfer')

@section('konten')
@if(session('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>
@endif
@if(session('pengesahan'))
<div class="alert alert-info">
    {{session('pengesahan')}}
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
        <a href="{{route('inputtransfer')}}" class="\ btn btn-sm btn-info">
            <span class="material-icons">library_add</span> 
            <i>Tambah bukti transfer</i>
        </a>

        <button class="btn btn-primary upload" id="upload" type="button"><i class="fas fa-upload"></i> Upload Excel</button>
        </h6>
     </div>
     <table class="table table-sm" id="z_trf" >
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">TglTransaksi</th>
      <th scope="col">Rek. Penerima</th>
      <th scope="col">Rek. Sumber</th>
      <th scope="col">Jml. Transfer</th>
      <th scope="col"><i class="fas fa-cogs"></i></th>
      <!-- <th id="detail" scope="col">Detail</th> -->
    </tr>
  </thead>
  <tbody>
 
    <!-- end looping  -->
  </tbody>
</table>
    </div>
    </div>
    </div>

    <!-- modal uplaod -->
  <div class="modal fade" id="modal_upload" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload File Excel</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <span id="result_upload"></span>
                <form action="" id="form_upload" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="upload" class="bmd-label-static">Upload Excel</label>
                        <input type="file"  class="form-control @error('upload') is-invalid @enderror" name="upload" id="upload" value="">
                    </div>
                    </div>
                </div>
                <input type="submit" name="upload_excel" id="upload_excel" class="upload_excel btn btn-primary pull-right mt-3" value="Upload"></input>
                <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
  </div>

<!-- modal edit  -->
<div class="modal fade" role="dialog" id="modal_edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit data</h5>
        <button class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
                <span id="form_result"></span>
                <form action="" id="area_form" method="post">
                @csrf
                 <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">RecAmt</label>
                        <input type="text" id="RecAmt" class="form-control "  name="RecAmt">
                </div>
              
               <input type="hidden" id="idedit" name="idedit">
                <button type="submit" class="button_edit btn btn-primary pull-right mt-3">Update</button>
                <div class="clearfix"></div>
                </form>
            </div>
    </div>
  </div>
</div>


@endsection

@section('scriptExternal')
    <script type="text/javascript">
        $(document).ready( function () {
            $('#z_trf').DataTable({
              processing : true,
              serverSide : true,
              ajax : {
                url : '{{route('jsonbuktitransfer')}}'
              },
              columns : [
                {data:'DT_RowIndex', name:'DT_RowIndex', searchable: false , orderable : false},
                {data:'TglTRF', name:'TglTRF', searchable: false , orderable : false},
                {data:'rekening_penerima', name:'rekening_penerima', searchable: false , orderable : false},
                {data:'rekening_sumber', name:'rekening_sumber', searchable: false , orderable : false},
                {data:'RecAmt', name:'RecAmt', searchable: false , orderable : false},
                {data:'button', name:'button', searchable: false , orderable : false},
              ]
            });
        });

        // show modal edit 
    
        $(document).on('click','.edit', function(){
          var id_edit = $(this).attr('id');
          $.ajax({
            url: "/donasi/buktitransfer/"+id_edit,
            dataType:"JSON",
            success:function(data)
            {
              $('#RecAmt').val(data.RecAmt);
              $("#modal_edit").modal('show');
            }
          });
        });

        $("form_edit").on('submit', function(event){
          event.preventDefault();
           $.ajax({
                url:'{{route('postbuktitransfer')}}',
                method:'POST',
                data: new FormData(this),
                cache: false,
                processData:false,
                contentType:false,
                dataType: 'JSON',
                success:function(data)
                {
                    var html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        for (var count = 0; count < data.errors.length; count++) {
                            html += '<p>'+data.errors[count]+'</p>';
                        }
                        html += '</div>';
                    }
                    if(data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                    }
                    $('#form_result').html(html);
                }
            });
        });

        // show modal uplad file excel 
        $(document).on('click','.upload', function(){
            $("#modal_upload").modal('show');
        });
        // upload excel
        $('#form_upload').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url : "{{route('edc.upload')}}",
                method:"POST",
                data: new FormData(this),
                cache: false,
                processData:false,
                contentType:false,
                dataType: 'JSON',
                success:function(data)
                {
                  var html = '';
                    if (data.erorrs) {
                      html = '<div class="alert alert-danger">';
                      for (var count = 0; count < data.erorrs.length; count++) {
                        html += '<p>'+data.erorrs[count]+'</p>';
                      }
                      html += '</div>';
                    }
                    if(data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#z_trf').DataTable().ajax.reload();
                      }
                    $('#result_upload').html(html);
                }
            });
        });
        

    </script>
   
@endsection('scriptExternal')