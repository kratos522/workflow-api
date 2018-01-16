<?php

namespace App\Listeners;

use Gate;
use App\AnalizarInformacionCriminal;
use App\AnalizarInformacionCriminalWorkflow;
use App\Mail\AnalizarInformacionCriminalAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AnalizarInformacionCriminalSubscriber
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
        $analizar_informacion_criminal = AnalizarInformacionCriminal::find($event->analizar_informacion_criminal->id);
        $this->logger->alert('[onAfterTransition] to '.$analizar_informacion_criminal->workflow_state);
        $analizar_informacion_criminal_workflow = new AnalizarInformacionCriminalWorkflow;
        $dependencia_id = $analizar_informacion_criminal_workflow->dependencia($analizar_informacion_criminal);
        if (!is_null($dependencia_id)) {
          $users = $analizar_informacion_criminal_workflow->notification_users($analizar_informacion_criminal->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($analizar_informacion_criminal, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\AnalizarInformacionCriminalAfterTransition',
            'App\Listeners\AnalizarInformacionCriminalSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\AnalizarInformacionCriminalBeforeTransition',
            'App\Listeners\AnalizarInformacionCriminalSubscriber@onBeforeTransition'
        );
    }
}
