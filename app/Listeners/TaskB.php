<?php

namespace App\Listeners;

use Gate;
// use App\Mail\NuevoUsuario;
// use App\Mail\UsuarioModificado;
use App\Task;
use App\TaskWorkflow;
use App\Mail\TaskB as NotifyTaskB;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskB
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     //
    // }
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        // $this->user = $user;
    }


    public function handle($event)
    {
        // var_dump($event->task['title'].' was inside handle!');
    }

    public function onBeforeB($event) {
        $encoded_msg = json_encode($event, true);
        $event_msg = json_decode($encoded_msg);
        $this->logger->alert('[onBeforeB]');
    }

    public function onAfterB($event) {
        // dd($event);
        $task = Task::find($event->task->id);
        $this->logger->alert('[onAfterB]');
        $task_workflow = new TaskWorkflow;
        $users = $task_workflow->notification_users($task->workflow_state);
        foreach($users as $u) {
          foreach($u->emails as $email) {
            $user = new \stdClass;
            $user->email = $email;
            $rol = $u->rol;
            \Mail::to($user)->send(new NotifyTaskB($task, $rol, $user->email));
          }
        }

        // $this->logger->alert($event_msg);
        // decode user from event object
        // $encoded_msg = json_encode($event->user->attributes, true);
        // $event_user = json_decode($encoded_msg);
        // $user = User::find($event_user->id);
        // // var_dump($user->email);
        // \Mail::to($user)->send(new UsuarioModificado($user));
        // $this->logger->alert(sprintf(
        //     'New User with id: "%s", and Email ("%s") was created"',
        //     $user->id,
        //     $user->email
        // ));
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\taskBeforeB',
            'App\Listeners\TaskB@onBeforeB'
        );
        $events->listen(
            'App\Events\taskAfterB',
            'App\Listeners\TaskB@onAfterB'
        );
    }
}
