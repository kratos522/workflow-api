<?php

namespace App\Listeners;

use Gate;
use App\CotejamientoDactilar;
// estos 2 se modifican cuando se llegue a los ultimos pasos
//use App\ObjetoWorkflow;
//use App\Mail\DenunciaMPAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CotejamientoDactilarSubscriber
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
        $cotejamiento_dactilar = CotejamientoDactilar::find($event->cotejamiento_dactilar->id);
        $this->logger->alert('[onAfterTransition] to '.$cotejamiento_dactilar->workflow_state);
        $cotejamiento_dactilar_workflow = new ObjetoWorkflow; //modificar esto en los ultimos pasos
        $dependencia_id = $cotejamiento_dactilar_workflow->dependencia($cotejamiento_dactilar);
        if (!is_null($dependencia_id)) {
          $users = $cotejamiento_dactilar_workflow->notification_users($cotejamiento_dactilar->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($cotejamiento_dactilar, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\CotejamientoDactilarAfterTransition',
            'App\Listeners\CotejamientoDactilarSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\CotejamientoDactilarBeforeTransition',
            'App\Listeners\CotejamientoDactilarSubscriber@onBeforeTransition'
        );
    }
}
