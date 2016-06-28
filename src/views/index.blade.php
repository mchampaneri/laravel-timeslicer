<!-- Essentisal Resource Files To Be Included
    For Working Of TimeSlicer Plugin        -->
<script   src="https://code.jquery.com/jquery-3.0.0.min.js"
          integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0="
          crossorigin="anonymous">
</script>
<link rel="stylesheet" href="{{asset('mchampaneri/timeslicer/assets/datepicker/css/datepicker.min.css')}}">
<link rel="stylesheet" href="{{asset('mchampaneri/timeslicer/assets/timepicker/wickedpicker.min.css')}}">
<script src="{{asset('mchampaneri/timeslicer/assets/datepicker/js/datepicker.min.js')}}"></script>
<script src="{{asset('mchampaneri/timeslicer/assets/timepicker/wickedpicker.min.js')}}"></script>
<!-- End Of Resource Files -->

<div class="card" >
    <div class="card-block">
        <form action="{{route('timeslicer.store')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label">Start Date</label>
                <input type='text' class="datepicker-here form-control"   name="start_date" id="start_date" />
            </div>
            <div class="form-group">
                <label class="control-label">End Date</label>
                <input type='text' class="datepicker-here form-control"  name="end_date" id="end_date" />
            </div>
            <div class="form-group">
                <label class="control-label">Start Time</label>
                <input type="text" class="form-control timepicker" name="start_time">
            </div>
            <div class="form-group">
                <label class="control-label">End Time</label>
                <input type="text" class="form-control timepicker" name="end_time">
            </div>
            <div class="form-group">
                <label class="control-label">Time Interval</label>
                <input type="text" class="form-control " name="time_interval">
            </div>
            <div class="form-group">
                <label for=""> Select Resource </label>
                <select name="resource_id" id="" class="form-control">
                    @if(isset($resources))
                        @foreach($resources as $resource)
                            <option value="{{$resource->id}}" >{{$resource->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>


            <div class="form-group">
                <input type="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
<!-- Script To Init The Plugins -->
<script src="{{asset('mchampaneri/timeslicer/assets/datepicker/js/i18n/datepicker.en.js')}}"></script>
<script type="text/javascript">

    $(document).ready(function() {
        // Initialization
        $('#start_date').datepicker({
            language : 'en',
            minDate: new Date()
        });
        $('#end_date').datepicker({
            language : 'en',
            minDate: new Date()
        });
        // Access instance of plugin
        $('#start_date').data('datepicker');
        $('#end_date').data('datepicker');

        $('.timepicker').wickedpicker();
    });

</script>
