# laravel-timeslicer
Laravel 5 package for generating time slots for a time duration

## Changes
  - 'GUI support Removed '
  - 'Enhanced backend support with new functions'
  
## Description

  laravel-timeslicer is a s package that generates time slots of same length from starting time to ending time for a range
  of days,months or even years. You can create slots of differnt time lengths or/and differnt starting or/and ending time for differnt
  interval of days by changing the inputs accordingly.

## Installation

  First Get It Through The Composer
  ```
    composer require mchampaneri/timeslice
  ```

  Second You have to publish the package
  ```
    php artisan vendor:publish
  ```
    This command will publish all assets file need by the package at appropriate direcotries.

  Third do Migrate
  ```
    php artisan migrate
  ```
    Here migrate is neccesary because this package has its own table to manage timeslots and related data

  After This Three Steps are ready to use the timeslicer

## Setup  
   At first you have to set the config file of timeslicer. Define the name of your resource model, consumer model and 
   namespace of your model files.
   
     Resource model : Model For Which You Want To Genreate The Time Slots
            for example doctors, resturant's table, class of school
     Consumer Model : Model Which are going to relate with Resource object throgh Timeslice
            for example patient, customer , subject 
     
   Here this names are **Case Sensitive** so add this name carefully.
   
   In the second step you are ready to use this package where ever  you want
   
## Functions   
  
   ```
   MakeSlices($start_date, $end_date, $start_time, $end_time, $interval, $resource_id)
   ``` 
   Function generates the unique time slices based on the date, start time and end time for start date to the end date
   here all variables are the fields of the table.
    
   ```
   Book($consumer_id)
   ```
   Here Consumer_id is The id of a consumer object. This function will book the current timeslice for the 
   consumer object which's id is passed as argument.
   
   ```
   UnBook()
   ```
   Unbook the current timeslice from the reservation
   
   ```
   OfResource()
   ```
   Returns the resource object which is related with the current timeslice.
   
   ```
   ForConsumer()
   ```
   Returns the consumer object which is related with the current timeslice.