<?php

namespace App\Listeners;

use Gate;
use App\CapturaFinExtradicion;
use App\CapturaFinExtradicionWorkflow;
use App\Mail\CapturaFinExtradicionAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CapturaFinExtradicionSubscriber
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
        $captura_fin_extradicion = CapturaFinExtradicion::find($event->captura_fin_extradicion->id);
        $this->logger->alert('[onAfterTransition] to '.$captura_fin_extradicion->workflow_state);
        $captura_fin_extradicion_workflow = new CapturaFinExtradicionWorkflow; //modificar esto en los ultimos pasos
        $dependencia_id = $captura_fin_extradicion_workflow->dependencia($captura_fin_extradicion);
        if (!is_null($dependencia_id)) {
          $users = $captura_fin_extradicion_workflow->notification_users($captura_fin_extradicion->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($captura_fin_extradicion, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\CapturaFinExtradicionAfterTransition',
            'App\Listeners\CapturaFinExtradicionSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\CapturaFinExtradicionBeforeTransition',
            'App\Listeners\CapturaFinExtradicionSubscriber@onBeforeTransition'
        );
    }
}
