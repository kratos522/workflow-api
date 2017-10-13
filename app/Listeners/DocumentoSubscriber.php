<?php

namespace App\Listeners;

use Gate;
use App\Documento;
use App\DocumentoWorkflow;
// use App\Mail\TaskB as NotifyTaskB;
use App\Mail\DocumentoAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DocumentoSubscriber
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
        $documento = Documento::find($event->documento->id);
        $this->logger->alert('[onAfterTransition] to '.$documento->workflow_state);
        $documento_workflow = new DocumentoWorkflow;
        $dependencia_id = $documento->dependencia_id;
        if (!is_null($dependencia_id)) {
          $users = $documento_workflow->notification_users($documento->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($documento, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\DocumentoAfterTransition',
            'App\Listeners\DocumentoSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\DocumentoBeforeTransition',
            'App\Listeners\DocumentoSubscriber@onBeforeTransition'
        );
    }
}
