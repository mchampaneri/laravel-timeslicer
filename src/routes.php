<?php
Route::get('timeslicer',['as'=>'timeslicer.index' ,'uses'=>'mchampaneri\timeslicer\Controller\TimeSlicerController@index']);
Route::post('timeslicer',['as'=>'timeslicer.store', 'uses'=>'mchampaneri\timeslicer\Controller\TimeSlicerController@store']);
Route::get('timeslicer/{id}',['as'=>'timeslicer.confirm','uses'=>'mchampaneri\timeslicer\Controller\TimeSlicerController@confirm']);
Route::post('timeslicer/{id}',['as'=>'timeslicer.booked','uses'=>'mchampaneri\timeslicer\Controller\TimeslicerController@booked']);
