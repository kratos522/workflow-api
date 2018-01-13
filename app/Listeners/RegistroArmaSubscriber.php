<?php

namespace App\Listeners;

use Gate;
use App\RegistroArma;
// estos 2 se modifican cuando se llegue a los ultimos pasos
//use App\ObjetoWorkflow;
//use App\Mail\DenunciaMPAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistroArmaSubscriber
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
        $registro_arma = RegistroArma::find($event->registro_arma->id);
        $this->logger->alert('[onAfterTransition] to '.$registro_arma->workflow_state);
        $registro_arma_workflow = new ObjetoWorkflow; //modificar esto en los ultimos pasos
        $dependencia_id = $registro_arma_workflow->dependencia($registro_arma);
        if (!is_null($dependencia_id)) {
          $users = $registro_arma_workflow->notification_users($registro_arma->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($registro_arma, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\RealizarRegistroArmaAfterTransition',
            'App\Listeners\RegistroArmaSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\RealizarRegistroArmaBeforeTransition',
            'App\Listeners\RegistroArmaSubscriber@onBeforeTransition'
        );
    }
}
