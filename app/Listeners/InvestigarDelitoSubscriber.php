<?php

namespace App\Listeners;

use Gate;
use App\InvestigarDelito;
use App\InvestigarDelitoWorkflow;
use App\Mail\InvestigarDelitoAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvestigarDelitoSubscriber
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
        $investigar_delito = InvestigarDelito::find($event->investigar_delito->id);
        $this->logger->alert('[onAfterTransition] to '.$investigar_delito->workflow_state);
        $investigar_delito_workflow = new InvestigarDelitoWorkflow;
        $dependencia_id = $investigar_delito_workflow->dependencia($investigar_delito);
        if (!is_null($dependencia_id)) {
          $users = $investigar_delito_workflow->notification_users($investigar_delito->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($investigar_delito, $rol, $user->email));
              }
            }
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\InvestigarDelitoAfterTransition',
            'App\Listeners\InvestigarDelitoSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\InvestigarDelitoBeforeTransition',
            'App\Listeners\InvestigarDelitoSubscriber@onBeforeTransition'
        );
    }
}
