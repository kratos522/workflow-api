<?php

namespace App\Listeners;

use Gate;
use App\ReseniaFotografica;
use App\ReseniaFotograficaWorkflow;
use App\Mail\ReseniaFotograficaAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReseniaFotograficaSubscriber
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
        $reseña_fotografica = ReseniaFotografica::find($event->reseña_fotografica->id);
        $this->logger->alert('[onAfterTransition] to '.$reseña_fotografica->workflow_state);
        $reseña_fotografica_workflow = new ReseniaFotograficaWorkflow;
        $dependencia_id = $reseña_fotografica_workflow->dependencia($reseña_fotografica);
        if (!is_null($dependencia_id)) {
          $users = $reseña_fotografica_workflow->notification_users($reseña_fotografica->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($reseña_fotografica, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\RealizarReseñaFotograficaAfterTransition',
            'App\Listeners\ReseniaFotograficaSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\RealizarReseñaFotograficaBeforeTransition',
            'App\Listeners\ReseniaFotograficaSubscriber@onBeforeTransition'
        );
    }
}
