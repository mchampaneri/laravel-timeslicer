# laravel-timeslicer
Laravel 5 package for generating time slots for a time duration

## Description

  laravel-timeslicer is a self contained package that generates time slots of same length from starting time to ending time for a range 
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
  
## Useage

  laravel-timeslicer has it's own
  - views
  - migration
  - css+js assets
  
  So to use this package you only have to do is include the partial of this packge where it fits in you system with required information
  and it will start working
  
  view partials of This package
  - index.blade
  - show.blade
  
##### index.blade 
  index.blade file includes a form that will get data from you to **generate the time slice**. It requires the **list of resoruce** in
  form of **array of object** to having property **id** and **name**.
  
  ```  
  @include('mchampaneri.timeslicer.index',['resources'=>[ (object)['id'=>'0','name'=>'first'],
                                                             (object)['id'=>'1','name'=>'second'],
                                                             (object)['id'=>'2','name'=>'third']
                                                             ]
                                                             ]);
  
  
  ```
  
##### show.blade
  show.blade file gives the list of all slots generate for that particular resource. so it requires the object of resource for which 
  you want to show the list of timeslots, the second parameter it require is the route to which you want to redirect on clicking the
  particular time slot.
  
  ```
       @include('mchampaneri.timeslicer.show',['resource_id'=>0,'route'=>'timeslicer.confirm']);
  ```
  
  Your redirecting route should have $id as parameter, so can get the timeslice object from that id and can pass it to your
  next view where you can generate your obtainer object.
  
  In the method where you want book the slot you have to call this method
  ```
     public static function book($timeslice_id,$obtainer_id)
  ```
  So it's preferable that you store your obtainer object and book the appointment in the same method
