<?php

namespace App\Listeners;

use Gate;

use App\SolicitudEstructuraCriminalSS;
use App\SolicitudEstructuraCriminalSSWorkflow;
// use App\Mail\TaskB as NotifyTaskB;
use App\Mail\SolicitudEstructuraCriminalSSAfterTransition as NotifyTransition;

use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SolicitudEstructuraCriminalSSSubscriber
{
    // private $actionable_before_states;
    // private $actionable_functions;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        // $this->actionable_before_states = Array("delitos_asignados");
        // $this->actionable_functions = Array("\App\Listeners\DenunciaMPSubscriber::onBeforeTransitionDelitosAsignados");
    }

    public function handle($event)
    {
        // var_dump($event->task['title'].' was inside handle!');
    }

    // private static function onBeforeTransitionDelitosAsignados(DenunciaMP $denuncia_mp){
    //   $log = new \Log;
    //   $log::alert('onBeforeTransitionDelitosAsignados called');
    //   $denuncia_mp_workflow = new DenunciaMPWorkflow;
    //   $delitos_asignados = $denuncia_mp_workflow->delitos_asignados($denuncia_mp);
    //   if ($delitos_asignados) { return true; }
    //   return false;
    // }

    public function onBeforeTransition($event) {
        $this->logger->alert('[onBeforeTransition]');
    }

    public function onAfterTransition($event) {
        // dd($event);
        $solicitud_estructura_criminal_ss = SolicitudEstructuraCriminalSS::find($event->solicitud_estructura_criminal_ss->id);
        $this->logger->alert('[onAfterTransition] to '.$solicitud_estructura_criminal_ss->workflow_state);
        $solicitud_estructura_criminal_ss_workflow = new DenunciaMPWorkflow;
        $dependencia_id = $solicitud_estructura_criminal_ss_workflow->dependencia($solicitud_estructura_criminal_ss);
        if (!is_null($dependencia_id)) {
          $users = $solicitud_estructura_criminal_ss_workflow->notification_users($solicitud_estructura_criminal_ss->workflow_state, $dependencia_id);
          // var_dump($users);
          if (!is_null($users)) {
            foreach($users as $u) {
              foreach($u->emails as $email) {
                $user = new \stdClass;
                $user->email = $email;
                $rol = $u->rol;
                $this->logger->alert('[Notify] email: '.$email);
                \Mail::to($user)->send(new NotifyTransition($solicitud_estructura_criminal_ss, $rol, $user->email));
              }
            }
          }
        }
    }


    public function subscribe($events)
    {
        $events->listen(
            'App\Events\SolicitudEstructuraCriminalSSAfterTransition',
            'App\Listeners\SolicitudEstructuraCriminalSSSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\SolicitudEstructuraCriminalSSBeforeTransition',
            'App\Listeners\SolicitudEstructuraCriminalSSSubscriber@onBeforeTransition'
        );
    }
}
