<?php
/**
 * Created by PhpStorm.
 * User: Manish Champaneri
 * Date: 22-06-2016
 * Time: 20:01
 */

Route::get('timeslicer',['as'=>'timeslicer.index' ,'uses'=>'Mcodes\TimeSlicer\TimeSlicerController@index']);
Route::post('timeslicer',['as'=>'timeslicer.store', 'uses'=>'Mcodes\TimeSlicer\TimeSlicerController@store']);
Route::get('timeslicer/{id}',['as'=>'timeslicer.confirm','uses'=>'Mcodes\TimeSlicer\TimeSlicerController@confirm']);
Route::post('timeslicer/{id}',['as'=>'timeslicer.booked','uses'=>'Mcodes\Timeslicer\TimeslicerController@booked']);