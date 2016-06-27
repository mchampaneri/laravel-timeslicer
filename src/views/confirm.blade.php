<div>
    <h1> Hello</h1>
    <h5> You are going to book for the </h5>

    <form action="{{route('timeslicer.booked',['id'=>$timeslice->id])}}" method="post">
        {{ csrf_field() }}
        <input type="text" name="obtainer_id">
        <input type="hidden" name="resource_id" value="{{$timeslice->id}}">
        <input type="submit">
    </form>
</div>