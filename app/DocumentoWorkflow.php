<?php

namespace App;

use App\Documento;
use App\Tools;
use App\Passport;
use Symfony\Component\Yaml\Yaml;

class DocumentoWorkflow implements iAction
{

  private $state;
  private $tools;
  private $workflow_name;
  private $workflow_owners;
  private $workflow_notifications;
  private $log;
  private $response;  

  const OWNERS_YAML = '../config/workflow_owners.yml';
  const NOTIFICATIONS_YAML = '../config/workflow_notifications.yml';

  public function __construct($remove_root=false)
  {
      $this->response = new \stdClass;
      $this->response->code = 200;
      $this->response->message = "";    
      $this->log = new \Log;
      $this->state = 'nuevo';
      $this->tools = new Tools;
      $this->workflow_name = 'recepcion_documento';
      $owners_path = self::OWNERS_YAML;
      $notifications_path = self::NOTIFICATIONS_YAML;
      if ($remove_root) {
          $owners_path = str_replace('../','',$owners_path);
          $notifications_path = str_replace('../','',$notifications_path);
      }
      $this->log::alert("owners path is ".$owners_path);
      $this->log::alert('notifications path is '. $notifications_path);
      $this->workflow_owners = Yaml::parse(file_get_contents($owners_path))[$this->workflow_name];
      $this->workflow_notifications = Yaml::parse(file_get_contents($notifications_path))[$this->workflow_name];
  }

  public function apply_transition(Array $arr) {

       return $this->response;    
  }

  public function apply(Array $arr) {
    $documento_id = $arr["object_id"];
    $action = $arr["action"];
    $user_email = $arr["user_email"];
    $documento = Documento::find($documento_id);

    # set enabled transitions
    $result = new \stdClass;
    try {
      $arr = $this->tools->get_workflow_transitions($documento, $action, $user_email);

      # set initial state if workflow_state is null
      if (is_null($documento->workflow_state)) { $documento->workflow_state = $this->state;}

      # apply workflow transition
      $res = $this->tools->workflow_apply($documento, $action);
      if (!$res) { return false; }

      # update $documento
      $documento->save();
      $result->success = true;
      $result->message = $documento;
      return $result;
    } catch (\Exception $e) {
      unset($documento["enabled_transitions"]);
      unset($documento["user_email"]);
      $result->success = false;
      $result->message = $e;
      return $result;
    }
  }

  public function user_actions(Array $arr) {
    $documento_id = $arr["object_id"];
    $user_email = $arr["user_email"];
    $documento = Documento::find($documento_id);

    # set enabled transitions
    $result = new \stdClass;
    $result->success = true;
    $arr = $this->tools->allowed_actions($documento, $this->workflow_name, $user_email);
    $result->message = $arr;
    return $result;
  }

  public function dependencia(Documento $documento) {
    if (is_null($documento->dependencia_id)) { return false; }
    if (empty($documento->dependencia_id)) { return false; }
    return true;
  }

  public function actions(Array $arr) {
    $documento_id = $arr["object_id"];
    $documento = Documento::find($documento_id);

    $result = new \stdClass;
    $result->success = true;
    $arr = $this->tools->get_actions($documento);
    $result->message = $arr;
    return $result;
  }

  public function owner_users(Array $arr) {
    $dependencia_id = $arr["dependencia_id"];
    $workflow_transition = $arr["workflow_transition"];

    $result = new \stdClass;
    $result->success = true;
    $all_emails = $this->users($workflow_transition, $this->workflow_owners, $dependencia_id);
    $result->message = $all_emails;
    return $result;
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
