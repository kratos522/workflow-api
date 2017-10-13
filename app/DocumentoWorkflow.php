<?php

namespace App;

use App\Documento;
use App\Tools;
use App\Passport;
use Symfony\Component\Yaml\Yaml;

class DocumentoWorkflow
{

  private $state;
  private $tools;
  private $workflow_name;
  private $workflow_owners;
  private $workflow_notifications;
  private $log;

  const OWNERS_YAML = 'config/workflow_owners.yml';
  const NOTIFICATIONS_YAML = 'config/workflow_notifications.yml';

  public function __construct()
  {
      $this->log = new \Log;
      $this->state = 'nuevo';
      $this->tools = new Tools;
      $this->workflow_name = 'recepcion_documento';
      $this->workflow_owners = Yaml::parse(file_get_contents(self::OWNERS_YAML))[$this->workflow_name];
      $this->workflow_notifications = Yaml::parse(file_get_contents(self::NOTIFICATIONS_YAML))[$this->workflow_name];
  }

  public function apply(Documento $documento, $action, $user_email) {
    # set enabled transitions
    try {
      $arr = $this->tools->get_workflow_transitions($documento, $action, $user_email);

      # set initial state if workflow_state is null
      if (is_null($documento->workflow_state)) { $documento->workflow_state = $this->state;}

      # apply workflow transition
      $res = $this->tools->workflow_apply($documento, $action);
      if (!$res) { return false; }

      # update $documento
      $documento->save();
      return true;
    } catch (\Exception $e) {
      unset($documento["enabled_transitions"]);
      unset($documento["user_email"]);
      return $e;
    }
  }

  public function user_actions(Documento $documento, $user_email) {
    # set enabled transitions
    $arr = $this->tools->allowed_actions($documento, $this->workflow_name, $user_email);
    return $arr;
  }

  public function dependencia(Documento $documento) {
    if (is_null($documento->dependencia_id)) { return false; }
    if (empty($documento->dependencia_id)) { return false; }
    return true;
  }

  public function actions(Documento $documento) {
    $arr = $this->tools->get_actions($documento);
    return $arr;
  }

  public function owner_users($workflow_state, $dependencia_id) {
    $all_emails = $this->users($workflow_state, $this->workflow_owners, $dependencia_id);
    return $all_emails;
  }

  public function notification_users($workflow_state, $dependencia_id) {
    $all_emails = $this->users($workflow_state, $this->workflow_notifications, $dependencia_id);
    return $all_emails;
  }

  private function users($workflow_state, $workflow_users,$dependencia_id) {
    //get emails from users for specific workflow_state
    $arr = [];
    $exists = in_array($workflow_state,array_keys($workflow_users));
    if (!($exists)) { return $arr; }

    $this->log::alert($workflow_users);
    $arr = $workflow_users[$workflow_state];

    $all_emails = [];
    $passport = new Passport;
    $params = new \stdClass;
    foreach($arr as $r) {
      $params->rol_name = $r;
      $params->dependencia_id = $dependencia_id;
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
  }


}
