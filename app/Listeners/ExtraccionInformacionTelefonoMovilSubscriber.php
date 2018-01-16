<?php

namespace App\Listeners;

use Gate;
use App\ExtraccionInformacionTelefonoMovil;
use App\ExtraccionInformacionTelefonoMovilWorkflow;
use App\Mail\ExtraccionInformacionTelefonoMovilAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExtraccionInformacionTelefonoMovilSubscriber
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
$extraccion_informacion_telefono_movil = ExtraccionInformacionTelefonoMovil::find($event->extraccion_informacion_telefono_movil->id);
        $this->logger->alert('[onAfterTransition] to '.$extraccion_informacion_telefono_movil->workflow_state);
        $extraccion_informacion_telefono_movil_workflow = new ExtraccionInformacionTelefonoMovilWorkflow;
        $dependencia_id = $extraccion_informacion_telefono_movil2_workflow->dependencia($extraccion_informacion_telefono_movil);
        if (!is_null($dependencia_id)) {
          $users = $extraccion_informacion_telefono_movil_workflow->notification_users($extraccion_informacion_telefono_movil->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($extraccion_informacion_telefono_movil, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\ExtraccionInformacionTelefonoMovilAfterTransition',
            'App\Listeners\ExtraccionInformacionTelefonoMovilSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\ExtraccionInformacionTelefonoMovilBeforeTransition',
            'App\Listeners\ExtraccionInformacionTelefonoMovilSubscriber@onBeforeTransition'
        );
    }
}
