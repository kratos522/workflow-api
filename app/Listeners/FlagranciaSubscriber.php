<?php

namespace App\Listeners;

use Gate;
use App\Flagrancia;
use App\FlagranciaWorkflow;
use App\Mail\FlagranciaAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FlagranciaSubscriber
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
        $flagrancia = Flagrancia::find($event->flagrancia->id);
        $this->logger->alert('[onAfterTransition] to '.$flagrancia->workflow_state);
        $flagrancia_workflow = new FlagranciaWorkflow;
        $dependencia_id = $flagrancia_workflow->dependencia($flagrancia);
        if (!is_null($dependencia_id)) {
          $users = $flagrancia_workflow->notification_users($flagrancia->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($flagrancia, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\FlagranciaAfterTransition',
            'App\Listeners\FlagranciaSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\FlagranciaBeforeTransition',
            'App\Listeners\FlagranciaSubscriber@onBeforeTransition'
        );
    }
}
