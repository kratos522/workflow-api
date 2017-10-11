<?php

namespace App;

use App\Passport;

class Tools
{

  private $log;

  public function __construct()
  {
      $this->log = new \Log;
  }

  public function get_workflow_transitions($objeto, $action, $user_email) {
    $arr = [] ;
    $objeto->enabled_transitions = [];
    $objeto->user_email = "";

    try {
      foreach($objeto->workflow_transitions() as $t) {$arr[] = $t->getName(); }
    } catch (\Exception $e) {
      unset($objeto["enabled_transitions"]);
      unset($objeto["user_email"]);
    }

    if (empty($arr)) { return false; }

    # check $action is within enabled transitions
    if (!(in_array($action, $arr))) { return false; }

    # set enabled transitions
    $objeto->enabled_transitions = $arr;

    # set user_email
    $objeto->user_email = $user_email;

    return true;
  }

  public function workflow_apply($objeto, $action) {
    # workflow apply
    try {
      $res = $objeto->workflow_apply($action);
    } catch (\Exception $e) {
        $this->log::alert($e);
        $res = NULL;
    }

    # remove enabled transitions & user_email
    unset($objeto["user_email"]);
    unset($objeto["enabled_transitions"]);

    if (is_null($res)) {return false;}

    return true;
  }

  public function allowed_actions($objeto, $workflow_name, $user_email){
    $arr = $this->get_actions($objeto);
    $allowed = [];
    foreach($arr as $a) {
      $res = $this->check_allowed_actions($workflow_name, $user_email, $a);
      if ($res) {$allowed[] = $a;}
    }
    return $allowed;
  }

  public function get_actions($objeto) {
    $arr = [] ;
    $objeto->enabled_transitions = [];
    $objeto->user_email = "";

    try {
      foreach($objeto->workflow_transitions() as $t) {$arr[] = $t->getName(); }
    } catch (\Exception $e) {
      $arr = [];
    }

    unset($objeto["enabled_transitions"]); # this relevant to WorkflowSubscriber
    unset($objeto["user_email"]);  # this relevant to WorkflowSubscriber

    return $arr;
  }

  public function check_allowed_actions($workflow_name, $user_email, $action ) {
    $params = new \stdClass;
    $params->email = $user_email;
    $params->workflow_name = $workflow_name;
    $params->action = $action;

    # check if user is authorized to perform workflow's action
    $passport = new Passport;
    $res = $passport->auth_workflow_action(json_encode($params));
    $jres = json_decode($res->contents);

    if (!property_exists($jres, "success")){
      return false;
    }
    if (!($jres->success)) {
      return false;
    }
    return true;

  }

}
