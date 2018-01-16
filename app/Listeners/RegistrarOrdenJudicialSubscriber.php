<?php

namespace App\Listeners;

use Gate;
use App\RegistrarOrdenJudicial;
use App\RegistrarOrdenJudicialWorkflow;
use App\Mail\RegistrarOrdenJudicialAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrarOrdenJudicialSubscriber
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
        $registrar_orden_judicial = RegistrarOrdenJudicial::find($event->registrar_orden_judicial->id);
        $this->logger->alert('[onAfterTransition] to '.$registrar_orden_judicial->workflow_state);
        $registrar_orden_judicial_workflow = new RegistrarOrdenJudicialWorkflow;
        $dependencia_id = $registrar_orden_judicial_workflow->dependencia($registrar_orden_judicial);
        if (!is_null($dependencia_id)) {
          $users = $registrar_orden_judicial_workflow->notification_users($registrar_orden_judicial->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($registrar_orden_judicial, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\RegistrarOrdenJudicialAfterTransition',
            'App\Listeners\RegistrarOrdenJudicialSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\RegistrarOrdenJudicialBeforeTransition',
            'App\Listeners\RegistrarOrdenJudicialSubscriber@onBeforeTransition'
        );
    }
}
