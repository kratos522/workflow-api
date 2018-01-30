<?php

namespace App\Listeners;

use Gate;
use App\IntervencionComunicacion;

use App\IntervencionComunicacionWorkflow;
use App\Mail\IntervencionComunicacionAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class IntervencionComunicacionSubscriber
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
        $intervencion_comunicacion = IntervencionComunicacion::find($event->intervencion_comunicacion->id);
        $this->logger->alert('[onAfterTransition] to '.$intervencion_comunicacion->workflow_state);
        $intervencion_comunicacion_workflow = new IntervencionComunicacionWorkflow;
        $dependencia_id = $intervencion_comunicacion_workflow->dependencia($intervencion_comunicacion);
        if (!is_null($dependencia_id)) {
          $users = $intervencion_comunicacion_workflow->notification_users($intervencion_comunicacion->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($intervencion_comunicacion, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\IntervencionComunicacionAfterTransition',
            'App\Listeners\IntervencionComunicacionSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\IntervencionComunicacionBeforeTransition',
            'App\Listeners\IntervencionComunicacionSubscriber@onBeforeTransition'
        );
    }
}
