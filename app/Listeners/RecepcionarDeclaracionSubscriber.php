<?php

namespace App\Listeners;

use Gate;
use App\RecepcionarDeclaracion;
// estos 2 se modifican cuando se llegue a los ultimos pasos
//use App\ObjetoWorkflow;
//use App\Mail\DenunciaMPAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecepcionarDeclaracionSubscriber
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
        $recepcionar_declaraciones = RecepcionarDeclaracion::find($event->recepcionar_declaraciones->id);
        $this->logger->alert('[onAfterTransition] to '.$recepcionar_declaraciones->workflow_state);
        $recepcionar_declaraciones_workflow = new ObjetoWorkflow; //modificar esto en los ultimos pasos
        $dependencia_id = $recepcionar_declaraciones_workflow->dependencia($recepcionar_declaraciones);
        if (!is_null($dependencia_id)) {
          $users = $recepcionar_declaraciones_workflow->notification_users($recepcionar_declaraciones->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($recepcionar_declaraciones, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\RecepcionarDeclaracionAfterTransition',
            'App\Listeners\RecepcionarDeclaracionSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\RecepcionarDeclaracionBeforeTransition',
            'App\Listeners\RecepcionarDeclaracionSubscriber@onBeforeTransition'
        );
    }
}
