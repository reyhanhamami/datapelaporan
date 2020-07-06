<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>PDF</title>
</head>
<body>
<?php ini_set('max_execution_time', 5000); //50 menit  ?>
    <!-- Data wakif-->
    <div class="container text-small">
    <div class="row">
    <div class="col">
            <h5 class="text-center mb-5 font-weight-bold">LAPORAN DONASI</h5>
            <div>
                <img src="{{url('images/bwa.png')}}" alt="" class="float-right img-fluid" width="100">
                <h6>Assalamualaikum wr wb</h6>
                <p class="small">Kepada Yth : Saudara/i {{$cusname}} 
                <br>
                Alamat : @if($address == NULL) - @else {{$address}} @endif
                <br>
                {{$cusno}}
                </p>
                <p class="small">Periode Tahun : @php echo date('Y')-1 @endphp - @php echo date('Y') @endphp</p>
            </div>

        <table class="table table-sm table-bordered small" id="history">
            <thead class="mt-4 text-light" style="background-color: #08a88a !important;">
            <tr>
                <th scope="col" class="border-0">No</th>
                <th scope="col" class="border-0">TGL TRANSAKSI</th>
                <th scope="col" class="border-0">PROGRAM</th>
                <th scope="col" class="border-0 text-sm" >PROJECT</th>
                <th scope="col" class="border-0">NOMINAL</th>
            </tr>
            </thead>
            <tbody>
            <?php $jum = 0; $i = 1;?>
            @while($d = $data->fetch())
            <tr>
                <td>{{$i++}}</td>
                <td>{{date('d M Y', strtotime($d['tgl']))}}</td>
                <td>{{$d['kd_program']}}</td>
                <td>{{$d['nm_project']}}</td>
                <td>Rp. {{number_format($d['jmh'])}}</td>
                <?php $jum += $d['jmh'] ?>
            </tr>
       @endwhile
            </tbody>
            <tr>
              <td class="font-weight-bold">Total :</td>
              <td colspan="4" class="text-right pr-5 font-weight-bold">Rp. <?= number_format($jum); ?></td>
            </tr>
        </table>
    <p class="small">Dengan semangat yang Amanah, Ka'fah dan Ikhlas, saatnya bersinergi dan salurkan wakaf anda melalu BWA, untuk memberi manfaat yang akan terus mengalir pahala dan keberkahannya.</p>
        
        <div class="row">
            <div class="col">
                <img src="{{url('images/bwa.png')}}" alt="" class="float-left img-fluid mr-4" width="100">
                <div class="font-weight-bold">
                    Badan Wakaf Al-quran <br>
                </div>
                    Jl. Tebet Timur Dalam I No.1, Tebet, Jakarta Selatan
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <img src="{{url('images/email.png')}}" alt="" class="float-left img-fluid mr-2" width="20"> <h6> admin@bwa.id</h6>
                <img src="{{url('images/globe.png')}}" alt="" class="float-left img-fluid mr-2" width="20"> <h6> <a href="https://www.bwa.id/">https://www.bwa.id/</a></h6>
                <img src="{{url('images/phone.png')}}" alt="" class="float-left img-fluid mr-2" width="20"> <h6> 021 - 8350084</h6>
                <img src="{{url('images/whatsapp.png')}}" alt="" class="float-left img-fluid mr-2" width="20"> <h6> wa.me/628119101007</h6>
            </div>
        </div>
        
            
       
    </div>
    
    </div>
    </div>
    <!-- End data wakif-->
</body>
</html>