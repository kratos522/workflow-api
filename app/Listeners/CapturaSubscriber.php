<?php

namespace App\Listeners;

use Gate;
use App\Captura;
use App\CapturaWorkflow;
use App\Mail\CapturaAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CapturaSubscriber
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
        $captura = Captura::find($event->captura->id);
        $this->logger->alert('[onAfterTransition] to '.$captura->workflow_state);
        $captura_workflow = new CapturaWorkflow;
        $dependencia_id = $captura_workflow->dependencia($captura);
        if (!is_null($dependencia_id)) {
          $users = $captura_workflow->notification_users($captura->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($captura, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\RealizarCapturaAfterTransition',
            'App\Listeners\CapturaSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\RealizarCapturaBeforeTransition',
            'App\Listeners\CapturaSubscriber@onBeforeTransition'
        );
    }
}
