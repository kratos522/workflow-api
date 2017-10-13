<?php

namespace App\Listeners;

use Gate;
use App\DenunciaSS;
use App\DenunciaSSWorkflow;
// use App\Mail\TaskB as NotifyTaskB;
use App\Mail\DenunciaSSAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DenunciaSSSubscriber
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
        $denuncia_ss = DenunciaSS::find($event->denuncia_ss->id);
        $this->logger->alert('[onAfterTransition] to '.$denuncia_ss->workflow_state);
        $denuncia_ss_workflow = new DenunciaSSWorkflow;
        $dependencia_id = $denuncia_ss_workflow->dependencia($denuncia_ss);
        if (!is_null($dependencia_id)) {
          $users = $denuncia_ss_workflow->notification_users($denuncia_ss->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($denuncia_ss, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\DenunciaSSAfterTransition',
            'App\Listeners\DenunciaSSSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\DenunciaSSBeforeTransition',
            'App\Listeners\DenunciaSSSubscriber@onBeforeTransition'
        );
    }
}
