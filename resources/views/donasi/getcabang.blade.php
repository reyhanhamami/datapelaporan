
        <option value="">-- Select Jaringan --</option>
        @if(!empty($getagen))
            @foreach($getagen as $g)
                <option value="{{$g->kd_agen}}">{{$g->nm_agen}}</option>
            @endforeach
        @endif  
  
