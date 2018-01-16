<?php

namespace App\Listeners;

use Gate;
use App\ReconocimientoRuedaPersona;
use App\ReconocimientoRuedaPersonaWorkflow;
use App\Mail\ReconocimientoRuedaPersonaAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReconocimientoRuedaPersonaSubscriber
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
        $reconocimiento_rueda_persona = ReconocimientoRuedaPersona::find($event->reconocimiento_rueda_persona->id);
        $this->logger->alert('[onAfterTransition] to '.$reconocimiento_rueda_persona->workflow_state);
        $reconocimiento_rueda_persona_workflow = new ReconocimientoRuedaPersonaWorkflow;
        $dependencia_id = $reconocimiento_rueda_persona_workflow->dependencia($reconocimiento_rueda_persona);
        if (!is_null($dependencia_id)) {
          $users = $reconocimiento_rueda_persona_workflow->notification_users($reconocimiento_rueda_persona->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($reconocimiento_rueda_persona, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\ReconocimientoRuedaPersonaAfterTransition',
            'App\Listeners\ReconocimientoRuedaPersonaSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\ReconocimientoRuedaPersonaBeforeTransition',
            'App\Listeners\ReconocimientoRuedaPersonaSubscriber@onBeforeTransition'
        );
    }
}
