<?php

namespace App\Listeners;

use Gate;
use App\Seguimiento;
use App\SeguimientoWorkflow;
use App\Mail\SeguimientoAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SeguimientoSubscriber
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
        $seguimiento = Seguimiento::find($event->seguimiento->id);
        $this->logger->alert('[onAfterTransition] to '.$seguimiento->workflow_state);
        $seguimiento_workflow = new SeguimientoWorkflow;
        $dependencia_id = $seguimiento_workflow->dependencia($seguimiento);
        if (!is_null($dependencia_id)) {
          $users = $seguimiento_workflow->notification_users($seguimiento->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($seguimiento, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\RealizarVigilanciaSeguimientoAfterTransition',
            'App\Listeners\SeguimientoSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\RealizarVigilanciaSeguimientoBeforeTransition',
            'App\Listeners\SeguimientoSubscriber@onBeforeTransition'
        );
    }
}
