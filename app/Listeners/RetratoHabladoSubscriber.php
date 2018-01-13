<?php

namespace App\Listeners;

use Gate;
use App\RetratoHablado;
// estos 2 se modifican cuando se llegue a los ultimos pasos
//use App\ObjetoWorkflow;
//use App\Mail\DenunciaMPAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RetratoHabladoSubscriber
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
        $retrato_hablado = RetratoHablado::find($event->retrato_hablado->id);
        $this->logger->alert('[onAfterTransition] to '.$retrato_hablado->workflow_state);
        $retrato_hablado_workflow = new ObjetoWorkflow; //modificar esto en los ultimos pasos
        $dependencia_id = $retrato_hablado_workflow->dependencia($retrato_hablado);
        if (!is_null($dependencia_id)) {
          $users = $retrato_hablado_workflow->notification_users($retrato_hablado->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($retrato_hablado, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\UnidadRetratoHabladoAfterTransition',
            'App\Listeners\RetratoHabladoSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\UnidadRetratoHabladoBeforeTransition',
            'App\Listeners\RetratoHabladoSubscriber@onBeforeTransition'
        );
    }
}
