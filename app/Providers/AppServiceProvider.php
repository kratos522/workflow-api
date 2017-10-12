<?php

namespace App\Providers;

use App\Task;
use App\DenunciaMP;
use App\Tools;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{

    private $available_events;
    private $tools;
    private $log;

    public function __construct()
    {
        $this->available_events = Array("App\Events\\taskBeforeB","App\Events\\taskAfterB","App\Events\\DenunciaMPAfterTransition", "App\Events\\DenunciaMPBeforeTransition" );
        $this->tools = new Tools;
        $this->log = new \Log;
    }

    private function raise_event($event_name, $objeto) {
      $log = new \Log;
      if( $event_name == "task_after" ){
        $event_name = camel_case($event_name . '_' . $objeto->workflow_state) ;
      } else {
        $event_name = ucfirst(camel_case($event_name));
      }
      $event_name = ucfirst(camel_case($event_name)); ## old version = . '_' . $objeto->workflow_state) ;
      $event_name = 'App\Events\\'.$event_name;
      //$log::alert($event_name);
      if (in_array($event_name,$this->available_events)) {
         event(new $event_name($objeto));
      }
    }

    private function after_object($event_name, $objeto) {
      $log = new \Log;
      $log::alert(['AFTER_EVENT']);
      $original = $objeto->getOriginal();
      if (!($original["workflow_state"] == $objeto->workflow_state)) {
        //$log::alert('[AFTER SAVE] original workflow_state '. $original["workflow_state"] . ' changed workflow_state '. $task->workflow_state);
        if (!(is_null($objeto->workflow_state))){
          $this->raise_event($event_name, $objeto);
        }
      }
    }

    private function before_object($event_name, $objeto) {
      $log = new \Log;
      $log::alert(['BEFORE_EVENT']);
      //$original = $objeto->getOriginal();
      //if (!($original["workflow_state"] == $objeto->workflow_state)) {
      if (!(is_null($objeto->workflow_state))){
        $this->raise_event($event_name, $objeto);
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
            //  $event_name = "task_before";
            //  $log = new \Log;
            //  $original = $task->getOriginal();
            //  if (!($original["workflow_state"] == $task->workflow_state)) {
            //    //$log::alert('[BEFORE SAVE] original workflow_state '. $original["workflow_state"] . ' changed workflow_state '. $task->workflow_state);
            //    if (!(is_null($task->workflow_state))){
            //      $this->raise_event($event_name, $task);
            //    }
            //  }
        });

        Task::saved(function ($task) {
             $event_name = "task_after";
             $res = $this->after_object($event_name, $task);
            //  $log = new \Log;
            //  $original = $task->getOriginal();
            //  if (!($original["workflow_state"] == $task->workflow_state)) {
            //    //$log::alert('[AFTER SAVE] original workflow_state '. $original["workflow_state"] . ' changed workflow_state '. $task->workflow_state);
            //    if (!(is_null($task->workflow_state))){
            //      $this->raise_event($event_name, $task);
            //    }
            //  }
        });

        DenunciaMP::saving(function ($denuncia_mp) {
             // check has delitos asignados
             $res = $this->tools->DenunciaMPonBeforeTransition($denuncia_mp);
             $this->log::alert('$res@::saving is .. ' . var_export($res, true));
             if ($res) {
               // launch other events for other listeners
               $event_name = "denuncia_m_p_before_transition";
               $result = $this->before_object($event_name, $denuncia_mp);
             }
             return $res;
        });

        DenunciaMP::saved(function ($denuncia_mp) {
             $event_name = "denuncia_m_p_after_transition";
             $res = $this->after_object($event_name, $denuncia_mp);
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
