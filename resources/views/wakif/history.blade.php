@extends('templates.main')
    @section('title','')

    @section('sub','')

    @section('konten')
            
    <!-- Data wakif-->
    <div class="row">
    <div class="col">
        <table class="table table-sm table-striped table-responsive-sm mb-0" id="history">
            @foreach($data as $d)
            @if(count($d->soa) >= 1)
            <h3 class="text-center mb-5">LAPORAN DONASI</h3>

            <div>
                <h5>Assamualaikum wr. wb</h5>
                <p>Kepada yth : Saudara/i {{$d->customername}} </p>
                <p>Periode Tahun : @php echo date('Y')-1 @endphp - @php echo date('Y') @endphp</p>
                <a href="{{url('/wakif/urlpdf/'.$d->CustomerNo.'/'.date('ym'))}}" class="btn btn-info float-right"><i class="fas fa-eye"></i> PDF</a>
            </div>
            <thead class="mt-4">
            <tr>
                <th scope="col" class="border-0">TGL TRANSAKSI</th>
                <th scope="col" class="border-0">PROGRAM</th>
                <th scope="col" class="border-0 text-sm" >PROJECT</th>
                <th scope="col" class="border-0">NOMINAL</th>
            </tr>
            </thead>
            <tbody>
            @foreach($d->soa as $s)
            <tr>
                <td>{{date('d M Y', strtotime($s['tgl']))}}</td>
                <td>{{$s['kd_program']}}</td>
                <td>{{$s['kd_project']}}</td>
                <td>Rp.{{number_format($s['jmh'])}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
       @else
       <a href="{{route('wakif')}}" class="btn btn-warning mb-5"><i class="fas fa-chevron-left"> Kembali</i> </a>
       <h1 class="justify-content-center align-content-center d-flex">Tidak ada transaksi antara periode <?= date('Y')-1 ?> - <?= date('Y') ?></h1>
       @endif
    </div>
    <div class="container">
    <div class="row">
    <div class="col-6 mt-5">
        <p>Terimakasih Atas partisipasinya. Semoga pahala Saudara/i {{$d->customername}} mengalir abadi. murah rezeki dan sehat selalu. Aamiin.</p>
        
        <p>Wassalamu'alaikum Wr. wb.</p>
        <strong>
            Badan Wakaf Al-quran
    </div>
    </div>
    </div>
        </strong>
    </div>
       @endforeach
    <!-- End data wakif-->

    @endsection
    
    @section('scriptExternal')
    <script>
    
    </script>
    @endsection('scriptExternal')
