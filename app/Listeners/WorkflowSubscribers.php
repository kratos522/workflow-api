<?php

namespace App\Listeners;

use Gate;
// use App\Task;
use Psr\Log\LoggerInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WorkflowSubscribers
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
    }


    public function handle($event)
    {
        // var_dump($event->task['title'].' was inside handle!');
    }

    public function onGuard($event) {
        $originalEvent = $event->getOriginalEvent();
        // $objeto = get_class($originalEvent->getSubject());

        $params = new \stdClass;
        $params->email = $originalEvent->getSubject()->getAttributes()["user_email"];
        $params->workflow_name = $originalEvent->getWorkflowName();
        $params->action = $originalEvent->getTransition()->getName();
        $params->enabled_transitions = $originalEvent->getSubject()->getAttributes()["enabled_transitions"];

        # check if user is authorized to perform workflow's action
        if (in_array($params->action,$params->enabled_transitions)) {
          $passport = new \App\Passport;
          $res = $passport->auth_workflow_action(json_encode($params));
          $jres = json_decode($res->contents);
          if (!property_exists($jres, "success")){
            $this->logger->alert("action is NOT allowed!");
            $originalEvent->setBlocked(true);
          }
          else {
            if (!($jres->success)){
              // $this->logger->alert("action is NOT allowed - II!");
              $originalEvent->setBlocked(true);
            }
          }
        }

    }

    public function onLeave($event) {
        /** Symfony\Component\Workflow\Event\GuardEvent */
        // $originalEvent = $event->getOriginalEvent();
        // $task = Task::find($originalEvent->getSubject()->getId());
        // var_dump($this->user->can('update', $task));
        // $this->logger->alert(sprintf(
        //     'Task (id: "%s"), Workflow ("%s") performed transaction "%s" from "%s" to "%s"',
        //     $originalEvent->getSubject()->getId(),
        //     $originalEvent->getWorkflowName(),
        //     $originalEvent->getTransition()->getName(),
        //     implode(', ', array_keys($originalEvent->getMarking()->getPlaces())),
        //     implode(', ', $originalEvent->getTransition()->getTos())
        // ));
        // $this->logger->alert(sprintf(
        //    'Workflow was: "%s"',
        //    $originalEvent->getWorkflowName()
        // ));
    }

    public function subscribe($events)
    {

        // $this->logger->alert(dd($events));

        $events->listen(
            'Brexis\LaravelWorkflow\Events\LeaveEvent',
            'App\Listeners\WorkflowSubscribers@onLeave'
        );

        $events->listen(
            'Brexis\LaravelWorkflow\Events\GuardEvent',
            'App\Listeners\WorkflowSubscribers@onGuard'
        );
    }
}
