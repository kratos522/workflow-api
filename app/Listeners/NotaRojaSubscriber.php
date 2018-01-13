<?php

namespace App\Listeners;

use Gate;
use App\NotaRoja;
// estos 2 se modifican cuando se llegue a los ultimos pasos
//use App\ObjetoWorkflow;
//use App\Mail\DenunciaMPAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotaRojaSubscriber
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
        $nota_roja = NotaRoja::find($event->nota_roja->id);
        $this->logger->alert('[onAfterTransition] to '.$nota_roja->workflow_state);
        $nota_roja_workflow = new ObjetoWorkflow; //modificar esto en los ultimos pasos
        $dependencia_id = $nota_roja_workflow->dependencia($nota_roja);
        if (!is_null($dependencia_id)) {
          $users = $nota_roja_workflow->notification_users($nota_roja->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($nota_roja, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\RetencionNotaRojaAfterTransition',
            'App\Listeners\NotaRojaSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\RetencionNotaRojaBeforeTransition',
            'App\Listeners\NotaRojaSubscriber@onBeforeTransition'
        );
    }
}
