<?php

namespace App\Listeners;

use Gate;
use App\SolicitudAllanamiento;
// estos 2 se modifican cuando se llegue a los ultimos pasos
//use App\ObjetoWorkflow;
//use App\Mail\DenunciaMPAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SolicitudAllanamientoSubscriber
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
        $solicitud_allanamiento = SolicitudAllanamiento::find($event->solicitud_allanamiento->id);
        $this->logger->alert('[onAfterTransition] to '.$solicitud_allanamiento->workflow_state);
        $solicitud_allanamiento_workflow = new ObjetoWorkflow; //modificar esto en los ultimos pasos
        $dependencia_id = $solicitud_allanamiento_workflow->dependencia($solicitud_allanamiento);
        if (!is_null($dependencia_id)) {
          $users = $solicitud_allanamiento_workflow->notification_users($solicitud_allanamiento->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($solicitud_allanamiento, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\RealizarAllanamientoAfterTransition',
            'App\Listeners\SolicitudAllanamientoSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\RealizarAllanamientoBeforeTransition',
            'App\Listeners\SolicitudAllanamientoSubscriber@onBeforeTransition'
        );
    }
}
