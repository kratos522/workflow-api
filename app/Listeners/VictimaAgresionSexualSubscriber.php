<?php

namespace App\Listeners;

use Gate;
use App\VictimaAgresionSexual;
use App\VictimaAgresionSexualWorkflow;
use App\Mail\VictimaAgresionSexualAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VictimaAgresionSexualSubscriber
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
        $victima_agresion_sexual = VictimaAgresionSexual::find($event->victima_agresion_sexual->id);
        $this->logger->alert('[onAfterTransition] to '.$victima_agresion_sexual->workflow_state);
        $victima_agresion_sexual_workflow = new VictimaAgresionSexualWorkflow;
        $dependencia_id = $victima_agresion_sexual_workflow->dependencia($victima_agresion_sexual);
        if (!is_null($dependencia_id)) {
          $users = $victima_agresion_sexual_workflow->notification_users($victima_agresion_sexual->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($victima_agresion_sexual, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\AtenderLesionadoVictimaAgresionSexualAfterTransition',
            'App\Listeners\VictimaAgresionSexualSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\AtenderLesionadoVictimaAgresionSexualBeforeTransition',
            'App\Listeners\VictimaAgresionSexualSubscriber@onBeforeTransition'
        );
    }
}
