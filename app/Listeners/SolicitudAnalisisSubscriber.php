<?php

namespace App\Listeners;

use Gate;
use App\SolicitudAnalisis;
use App\SolicitudAnalisisWorkflow;
use App\Mail\SolicitudAnalisisfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SolicitudAnalisisSubscriber
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
        $solicitud_analisis = SolicitudAnalisis::find($event->solicitud_analisis->id);
        $this->logger->alert('[onAfterTransition] to '.$solicitud_analisis->workflow_state);
        $solicitud_analisis_workflow = new SolicitudAnalisisWorkflow; //modificar esto en los ultimos pasos
        $dependencia_id = $solicitud_analisis_workflow->dependencia($solicitud_analisis);
        if (!is_null($dependencia_id)) {
          $users = $solicitud_analisis_workflow->notification_users($solicitud_analisis->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($solicitud_analisis, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\SolicitudAnalisisAfterTransition',
            'App\Listeners\SolicitudAnalisisSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\SolicitudAnalisisBeforeTransition',
            'App\Listeners\SolicitudAnalisisSubscriber@onBeforeTransition'
        );
    }
}
