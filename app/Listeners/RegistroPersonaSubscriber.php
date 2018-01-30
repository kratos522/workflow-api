<?php

namespace App\Listeners;

use Gate;
use App\RegistroPersona;
use App\RegistroPersonaWorkflow;
use App\Mail\RegistroPersonaAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistroPersonaSubscriber
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
        $registro_persona = RegistroPersona::find($event->registro_persona->id);
        $this->logger->alert('[onAfterTransition] to '.$registro_persona->workflow_state);
        $registro_persona_workflow = new RegistroPersonaWorkflow;
        $dependencia_id = $registro_persona_workflow->dependencia($registro_persona);
        if (!is_null($dependencia_id)) {
          $users = $registro_persona_workflow->notification_users($registro_persona->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($registro_persona, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\RealizarRegistroPersonalAfterTransition',
            'App\Listeners\RegistroPersonaSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\RealizarRegistroPersonalBeforeTransition',
            'App\Listeners\RegistroPersonaSubscriber@onBeforeTransition'
        );
    }
}
