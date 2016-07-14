<?php

namespace mchampaneri\timeslicer\model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Timeslice extends Model
{

    /**
     * Generates The Time slices For The Given Input
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
     * Convert's Time Input Having 12 hr clokc into 24 hr clock time
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

    /**
    * Converts 24 hr clock time into 12 hr clock time
    * @param $string
    * @return string
    */
   public static function rTimeConverter($string)
   {
       $time = Carbon::parse($string);
       if($time->hour > 12)
       {
           $time->hour = $time->hour - 12;
           $time = $time->toTimeString();
           return $time = $time.' PM';
       }
       else{
           $time = $time->toTimeString();
           return $time = $time.' AM';
       }
   }

    /**
     * Returns The Object Of Timeslice From The input of the time slice id
     * @param $resource_id
     * @return mixed
     */
    public static function TimeSlices($resource_id)
    {
        $timeslices = Timeslice::where('resource_id',$resource_id)->get();
        return $timeslices;
    }

    /**
     * Books The Current Time Slot For The Selected Consumer Object
     * @param $consumer_id
     */
    public function Book($consumer_id)
    {
        $this->consumer_id = $consumer_id;
        $this->status = 1;
        $this->save();
    }

    /**
     * Makes The Slot Free From The Consumer Object
     */
    public function UnBook()
    {
        $this->obtainers_id = 0;
        $this->status = 0;
        $this->save();
    }

    /**
     * Returns The Object of Resource For Which The Slot Stands
     * @return mixed
     */
    public function OfResource()
    {
        $resource_name = config('timeslicer.namespace').config('timeslicer.resource');
        $resource_object = $resource_name::find($this->resource_id)->get();
        return $resource_object;
    }

    /**
     * Returns The Object of Consumer Which Wants To Consume That Slot
     * @return mixed
     */
    public function ForConsumer()
    {
        $consumer_name = config('timeslicer.namespace').config('timeslicer.consumer');
        $consumer_object = $consumer_name::find($this->consumer_id)->get();
        return $consumer_object;
    }

    /**
   * Returns The List Of The Slots For That Particular Resource
   * @param $id
   */
    public static function SliceOfResource($id)
    {
        $slices = Timeslice::where('resource_id',$id)
                            ->orderby('date','asc')
                            ->get();
        return $slices;
    }


    /**
       * Returns The Array Of TimeSlices Of The Resource For That
       * Particular Date
       * @param $id
       * @param $date
       * @return mixed
       */
      public static function SliceOfResourceDay($id, $for)
      {
          $date = Carbon::parse($for);
          $slices = Timeslice::where('resource_id',$id)
                              ->where('date',$date)
                              ->get();
          return $slices;
      }

      /**
       * Returns List of Reserved slices of the Resource for the date
       * @param $id
       * @param $for
       * @return mixed
       */
      public static function BookedSliceOfResourceDay($id, $for)
      {
          $date = Carbon::parse($for);
          $slices = Timeslice::where('resource_id',$id)
              ->where('date',$date)
              ->where('status',1)
              ->get();
          return $slices;
      }

      /**
    * Returns the unbooked resource slice of the day
    * @param $id
    * @param $for
    * @return mixed
    */
   public static function unBookedSliceOfResourceDay($id, $for)
   {
       $date = Carbon::parse($for);
       $slices = Timeslice::where('resource_id',$id)
           ->where('date',$date)
           ->where('status',0)
           ->get();
       return $slices;
   }

   /**
    * Returns all the slices booked on that particular date
    * @param $on
    * @return mixed
    */
   public static function SliceBookedOnDay($on)
   {
       $date = Carbon::parse($on);
       $slices = Timeslice::whereDate('updated_at','=',$date)
                       ->where('status',1)
                       ->get();
       return $slices;

   }

}
