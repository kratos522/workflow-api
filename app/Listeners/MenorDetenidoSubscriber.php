<?php

namespace App\Listeners;

use Gate;
use App\MenorDetenido;
// estos 2 se modifican cuando se llegue a los ultimos pasos
//use App\ObjetoWorkflow;
//use App\Mail\DenunciaMPAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MenorDetenidoSubscriber
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
        $menor_detenido = MenorDetenido::find($event->menor_detenido->id);
        $this->logger->alert('[onAfterTransition] to '.$menor_detenido->workflow_state);
        $menor_detenido_workflow = new ObjetoWorkflow; //modificar esto en los ultimos pasos
        $dependencia_id = $menor_detenido_workflow->dependencia($menor_detenido);
        if (!is_null($dependencia_id)) {
          $users = $menor_detenido_workflow->notification_users($menor_detenido->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($menor_detenido, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\AprehencionMenorInfractorAfterTransition',
            'App\Listeners\MenorDetenidoSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\AprehencionMenorInfractorBeforeTransition',
            'App\Listeners\MenorDetenidoSubscriber@onBeforeTransition'
        );
    }
}
