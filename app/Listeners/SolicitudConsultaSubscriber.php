<?php

namespace App\Listeners;

use Gate;
use App\SolicitudConsulta;
use AppSolicitudConsultaWorkflow;
use App\Mail\SolicitudConsultaAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SolicitudConsultaSubscriber
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
        $solicitud_consulta = SolicitudConsulta::find($event->solicitud_consulta->id);
        $this->logger->alert('[onAfterTransition] to '.$solicitud_consulta->workflow_state);
        $solicitud_consulta_workflow = new SolicitudConsultaWorkflow;
        $dependencia_id = $solicitud_consulta2_workflow->dependencia($solicitud_consulta);
        if (!is_null($dependencia_id)) {
          $users = $solicitud_consulta_workflow->notification_users($solicitud_consulta->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($solicitud_consulta, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\SolicitudConsultaAfterTransition',
            'App\Listeners\SolicitudConsultaSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\SolicitudConsultaBeforeTransition',
            'App\Listeners\SolicitudConsultaSubscriber@onBeforeTransition'
        );
    }
}
