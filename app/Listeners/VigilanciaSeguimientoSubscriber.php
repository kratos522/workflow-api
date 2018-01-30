<?php

namespace App\Listeners;

use Gate;
use App\VigilanciaSeguimiento;
use App\VigilanciaSeguimientoWorkflow;
use App\Mail\VigilanciaSeguimientoAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VigilanciaSeguimientoSubscriber
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
        $vigilancia_seguimiento = VigilanciaSeguimiento::find($event->vigilancia_seguimiento->id);
        $this->logger->alert('[onAfterTransition] to '.$vigilancia_seguimiento->workflow_state);
        $vigilancia_seguimiento_workflow = new VigilanciaSeguimientoWorkflow;
        $dependencia_id = $vigilancia_seguimiento_workflow->dependencia($vigilancia_seguimiento);
        if (!is_null($dependencia_id)) {
          $users = $vigilancia_seguimiento_workflow->notification_users($vigilancia_seguimiento->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($vigilancia_seguimiento, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\RealizarVigilanciaSeguimientoAfterTransition',
            'App\Listeners\VigilanciaSeguimientoSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\RealizarVigilanciaSeguimientoBeforeTransition',
            'App\Listeners\VigilanciaSeguimientoSubscriber@onBeforeTransition'
        );
    }
}
