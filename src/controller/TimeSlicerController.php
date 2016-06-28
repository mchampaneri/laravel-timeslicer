<?php

namespace mchampaneri\timeslicer\controller;

use mchampaneri\timeslicer\model\Timeslice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;

class TimeSlicerController extends Controller
{
    public function index()
    {
        return view('mchampaneri.timeslicer.index');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {

        $start_time = Timeslice::TimeConverter($request->start_time);
        $end_time = Timeslice::TimeConverter($request->end_time);

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $time_interval = $request->time_interval;

        $resource_id = $request->resource_id;

        Timeslice::MakeSlices($start_date ,$end_date, $start_time, $end_time, $time_interval, $resource_id);
    }

    public function confirm($id)
    {
        $timeslice = Timeslice::find($id);
        return view('mchampaneri.timeslicer.confirm')->with('timeslice',$timeslice);
    }

    public function booked($id,Request $request)
    {
        Timeslice::book($id,$request->obtainer_id);
        return 'done';
    }

}
