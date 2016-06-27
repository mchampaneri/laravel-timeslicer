<div>
    <h1> Created Slots For The Resource_id {{ $resource_id }}</h1>

    <div class="row">
        @foreach( \Mcodes\Timeslicer\Timeslice::timeslices($resource_id) as $timeslice)
            <div class="col-md-3">
                <a href="{{route($route,['id'=>$timeslice->id])}}"
                   class =" @if( $timeslice->obtainers_id != 0) btn btn-danger @else btn btn-success @endif ">
                    {{$timeslice->start_time}} -  {{$timeslice->end_time}}
                </a>
            </div>
        @endforeach

    </div>

</div>