<?php

namespace App\Listeners;

use Gate;
use App\InfiltrarOrganizacionCriminal;
use App\InfiltrarOrganizacionCriminalWorkflow;
use App\Mail\InfiltrarOrganizacionCriminalAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class InfiltrarOrganizacionCriminalSubscriber
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
        $infiltrar_organizacion_criminal = InfiltrarOrganizacionCriminal::find($event->infiltrar_organizacion_criminal->id);
        $this->logger->alert('[onAfterTransition] to '.$infiltrar_organizacion_criminal->workflow_state);
        $infiltrar_organizacion_criminal_workflow = new InfiltrarOrganizacionCriminalWorkflow;
        $dependencia_id = $infiltrar_organizacion_criminal_workflow->dependencia($infiltrar_organizacion_criminal);
        if (!is_null($dependencia_id)) {
          $users = $infiltrar_organizacion_criminal_workflow->notification_users($infiltrar_organizacion_criminal->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($infiltrar_organizacion_criminal, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\InfiltrarOrganizacionCriminalAfterTransition',
            'App\Listeners\InfiltrarOrganizacionCriminalSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\InfiltrarOrganizacionCriminalBeforeTransition',
            'App\Listeners\InfiltrarOrganizacionCriminalSubscriber@onBeforeTransition'
        );
    }
}
