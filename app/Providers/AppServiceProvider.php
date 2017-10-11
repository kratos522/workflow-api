<?php

namespace App\Providers;

use App\Task;
// use App\Events\taskAfterB;
// use App\Events\taskBeforeB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{

    private $available_events;

    public function __construct()
    {
        $this->available_events = Array("App\Events\\taskBeforeB","App\Events\\taskAfterB");
    }

    private function raise_event($event_name, $task) {
      $log = new \Log;
      $event_name = camel_case($event_name . '_' . $task->workflow_state) ;
      $event_name = 'App\Events\\'.$event_name;
      $log::alert($event_name);
      if (in_array($event_name,$this->available_events)) {
         event(new $event_name($task));
      }
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        { Schema::defaultStringLength(191); }

        Task::saving(function ($task) {
             $event_name = "task_before";
             $log = new \Log;
             $original = $task->getOriginal();
             if (!($original["workflow_state"] == $task->workflow_state)) {
               //$log::alert('[BEFORE SAVE] original workflow_state '. $original["workflow_state"] . ' changed workflow_state '. $task->workflow_state);
               if (!(is_null($task->workflow_state))){
                 $this->raise_event($event_name, $task);
               }
             }
            //  if (!(is_null($task->workflow_state))) {
            //    $log::alert('[BEFORE SAVE] Task '.$task->title.' has workflow state of '.$task->workflow_state);
            //  }
        });

        Task::saved(function ($task) {
             $event_name = "task_after";
             $log = new \Log;
             $original = $task->getOriginal();
             if (!($original["workflow_state"] == $task->workflow_state)) {
               //$log::alert('[AFTER SAVE] original workflow_state '. $original["workflow_state"] . ' changed workflow_state '. $task->workflow_state);
               if (!(is_null($task->workflow_state))){
                 $this->raise_event($event_name, $task);
               }
             }
            //  if (!(is_null($task->workflow_state))) {
            //    $log::alert('[AFTER SAVE] Task '.$task->title.' has workflow state of '.$task->workflow_state);
            //  }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
