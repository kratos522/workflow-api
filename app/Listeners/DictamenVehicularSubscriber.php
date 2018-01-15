<?php

namespace App\Listeners;

use Gate;
use App\DictamenVehicular;
// estos 2 se modifican cuando se llegue a los ultimos pasos
//use App\ObjetoWorkflow;
//use App\Mail\DenunciaMPAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DictamenVehicularSubscriber
{
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle($event)
    {
        // var_dump($event->task['title'].' was inside handle!');
    }

    public function onBeforeTransition($event) {
        $this->logger->alert('[onBeforeTransition]');
    }

    public function onAfterTransition($event) {
        // dd($event);
        $dictamen_vehicular = DictamenVehicular::find($event->dictamen_vehicular->id);
        $this->logger->alert('[onAfterTransition] to '.$dictamen_vehicular->workflow_state);
        $dictamen_vehicular_workflow = new ObjetoWorkflow; //modificar esto en los ultimos pasos
        $dependencia_id = $dictamen_vehicular_workflow->dependencia($dictamen_vehicular);
        if (!is_null($dependencia_id)) {
          $users = $dictamen_vehicular_workflow->notification_users($dictamen_vehicular->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($dictamen_vehicular, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\RealizarDictamenVehicularAfterTransition',
            'App\Listeners\DictamenVehicularSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\RealizarDictamenVehicularBeforeTransition',
            'App\Listeners\DictamenVehicularSubscriber@onBeforeTransition'
        );
    }
}
