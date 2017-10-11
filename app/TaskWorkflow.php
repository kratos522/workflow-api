<?php

namespace App;

use App\Task;
use App\Tools;
use App\Passport;
use Symfony\Component\Yaml\Yaml;

class TaskWorkflow
{

  private $state;
  private $tools;
  private $workflow_name;
  private $workflow_owners;
  private $log;

  const OWNERS_YAML = 'config/workflow_owners.yml';

  public function __construct()
  {
      $this->log = new \Log;
      $this->state = 'a';
      $this->tools = new Tools;
      $this->workflow_name = "dummy_workflow";
      $this->workflow_owners = Yaml::parse(file_get_contents(self::OWNERS_YAML))[$this->workflow_name];
  }

  public function apply(Task $task, $action, $user_email) {
    # set enabled transitions
    try {
      $arr = $this->tools->get_workflow_transitions($task, $action, $user_email);

      # set initial state if workflow_state is null
      if (is_null($task->workflow_state)) { $task->workflow_state = $this->state;}

      # apply workflow transition
      $res = $this->tools->workflow_apply($task, $action);
      if (!$res) { return false; }

      # update task
      $task->save();
      return true;
    } catch (\Exception $e) {
      unset($task["enabled_transitions"]);
      unset($task["user_email"]);
      return $e;
    }
  }

  public function user_actions(Task $task, $user_email) {
    # set enabled transitions
    $arr = $this->tools->allowed_actions($task, $this->workflow_name, $user_email);
    return $arr;
  }

  public function actions(Task $task) {
    $arr = $this->tools->get_actions($task);
    return $arr;
  }

  public function users($workflow_state) {
    $arr = [];
    $exists = in_array($workflow_state,array_keys($this->workflow_owners));
    if (!($exists)) { return $arr; }

    $this->log::alert($this->workflow_owners);
    $arr = $this->workflow_owners[$workflow_state];

    $all_emails = [];
    $passport = new Passport;
    $params = new \stdClass;
    foreach($arr as $r) {
      $params->rol_name = $r;
      $res = $passport->emails(json_encode($params));
      if ($res->code == 200) {
        $contents = json_decode($res->contents);
        if (property_exists($contents, "success")) {
          $result = new \stdClass;
          $result->rol = $r;
          $result->emails = json_decode($res->contents)->success;
          $all_emails[] = $result;
        }

      }
    }

    return $all_emails;
    // $unique_emails = array_unique($all_emails);
    // $emails = array_values($unique_emails);
    //
    // return $emails;
  }

}
