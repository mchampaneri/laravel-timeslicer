<?php

namespace mchampaneri\timeslicer\model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Timeslice extends Model
{

    /**
     * @param $start_date
     * @param $end_date
     * @param $interval
     * @param $start_time
     * @param $end_time
     * @param $interval
     * @param $resource_id
     * @return int
     */
    public static function MakeSlices($start_date, $end_date, $start_time, $end_time, $interval, $resource_id)
    {
        $date = Carbon::parse($start_date);
        $end_date = Carbon::parse($end_date);

        while( $date->lte( $end_date) )
        {
            $day_start = Carbon::parse($start_time);
            $day_end =  Carbon::parse($end_time);
            $add_minute = Carbon::parse($interval)->minute;
            $add_hour = Carbon::parse($interval)->hour;
            $slot_start = $day_start;

            $slot_end =  Carbon::parse($start_time);

            $slot_end = $slot_end->addMinutes($add_minute);
            $slot_end = $slot_end->addHours($add_hour);

            while( $slot_end->lte ( $day_end ) )
            {
                // New Slot Object //
                $slot = new Timeslice();
                $slot->date = $date;
                $slot->start_time = $slot_start;
                $slot->end_time = $slot_end ;
                $slot->resource_id = $resource_id;
                // Error Catching In Case Of SQL Time Stamp Error Generation //
                try {
                    $slot->save();
                } catch(\Illuminate\Database\QueryException $e){
                    die($e);
                    return 1;
                }
                // Time Manipulation  //
                $slot_start = $slot_start->addMinutes($add_minute);
                $slot_start = $slot_start->addHours($add_hour);
                $slot_end = $slot_end->addMinutes($add_minute);
                $slot_end = $slot_end->addHours($add_hour);
                // Ready For Next Iteration //
            }
            $date =  $date->addDay();

        }

        return 0;
    }

    /**
     * @param $string
     * @return static
     */
    public static function TimeConverter($string)
    {
        $raw_time =  str_replace(' ', '', $string);
        $time_use = substr($raw_time, 0, -2);
        $time = Carbon::parse($time_use);
        $time_phase = substr($string,-2);
        $time_phase == "PM" ? $time=$time->addHours(12):  $time=$time->addHours(0);

        return $time;
    }

    public static function timeslices($resource_id)
    {
        $timeslices = Timeslice::where('resource_id',$resource_id)->get();
        return $timeslices;
    }

    public static function book($timeslice_id,$obtainer_id)
    {
        $timeslice = Timeslice::find($timeslice_id);
        $timeslice->obtainers_id = $obtainer_id;
        $timeslice->save();
    }
}
