<?php

namespace App\Listeners;

use Gate;
use App\DenunciaMP;
use App\DenunciaMPWorkflow;
// use App\Mail\TaskB as NotifyTaskB;
use App\Mail\DenunciaMPAfterTransition as NotifyTransition;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DenunciaMPSubscriber
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
        // $res = false;
        // $original = $event->denuncia_mp->getOriginal();
        // // dd($original);
        // // $this->logger->alert("intended workflow state is " . $event->denuncia_mp->workflow_state);
        // $workflow_state = $event->denuncia_mp->workflow_state;
        // $condition = (in_array($workflow_state,$this->actionable_before_states));
        // if ($condition) {
        //   $this->logger->alert('[onBeforeTransition]->[Actionable State] '. $original["workflow_state"]);
        //   $function_name = "\App\Listeners\DenunciaMPSubscriber::onBeforeTransition" . ucfirst(implode("",explode("_",camel_case($workflow_state))));
        //   $condition = (in_array($function_name,$this->actionable_functions));
        //   if ($condition) {
        //     $res = $function_name($event->denuncia_mp);
        //   }
        // }
        // return $res;
    }

    public function onAfterTransition($event) {
        // dd($event);
        $denuncia_mp = DenunciaMP::find($event->denuncia_mp->id);
        $this->logger->alert('[onAfterTransition] to '.$denuncia_mp->workflow_state);
        $denuncia_mp_workflow = new DenunciaMPWorkflow;
        $users = $denuncia_mp_workflow->notification_users($denuncia_mp->workflow_state);
        // var_dump($users);
        foreach($users as $u) {
          foreach($u->emails as $email) {
            $user = new \stdClass;
            $user->email = $email;
            $rol = $u->rol;
            $this->logger->alert('[Notify] email: '.$email);
            \Mail::to($user)->send(new NotifyTransition($denuncia_mp, $rol, $user->email));
          }
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\DenunciaMPAfterTransition',
            'App\Listeners\DenunciaMPSubscriber@onAfterTransition'
        );

        $events->listen(
            'App\Events\DenunciaMPBeforeTransition',
            'App\Listeners\DenunciaMPSubscriber@onBeforeTransition'
        );
    }
}
