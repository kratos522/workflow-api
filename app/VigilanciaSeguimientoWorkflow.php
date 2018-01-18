<?php

namespace App;

use App\VigilanciaSeguimiento;
use App\Tools;
use App\Passport;
use Symfony\Component\Yaml\Yaml;

class VigilanciaSeguimientoWorkflow implements iAction
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
    $this->state = 'nueva';
    $this->tools = new Tools;
    $this->workflow_name = "realizar_entrega_vigilada";
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
    $vigilancia_seguimiento_id = $arr["object_id"];
    $action = $arr["action"];
    $user_email = $arr["user_email"];
    $vigilancia_seguimiento = VigilanciaSeguimiento::find($vigilancia_seguimiento_id);

    # set enabled transitions
    $result = new \stdClass;
    try {
      $arr = $this->tools->get_workflow_transitions($vigilancia_seguimiento, $action, $user_email);

      # set initial state if workflow_state is null
      if (is_null($vigilancia_seguimiento->workflow_state)) { $vigilancia_seguimiento->workflow_state = $this->state;}

      # apply workflow transition
      try {
          $res = $this->tools->workflow_apply($vigilancia_seguimiento, $action);
      } catch (\Exception $e) {
          return result;
      }

      $vigilancia_seguimiento->save();
      $result->success = true;
      $result->message = $vigilancia_seguimiento;
      return $result;
    } catch (\Exception $e) {
      unset($vigilancia_seguimiento["enabled_transitions"]);
      unset($vigilancia_seguimiento["user_email"]);
      $result->success = false;
      $result->message = $e;
      $this->log::alert($e);
      return $result;
    }
  }

  public function user_actions(Array $arr) {
    $vigilancia_seguimiento_id = $arr["object_id"];
    $user_email = $arr["user_email"];
    $vigilancia_seguimiento = VigilanciaSeguimiento::find($vigilancia_seguimiento_id);

    # set enabled transitions
    $result = new \stdClass;
    $result->success = true ;
    $arr = $this->tools->allowed_actions($vigilancia_seguimiento, $this->workflow_name, $user_email);
    $result->message = $arr;
    return $result;
  }

  public function actions(Array $arr) {

    $vigilancia_seguimiento_id = $arr["object_id"];
    $vigilancia_seguimiento = VigilanciaSeguimiento::find($vigilancia_seguimiento_id);

    $result = new \stdClass;
    $result->success = true ;
    $arr = $this->tools->get_actions($vigilancia_seguimiento);
    $result->message = $arr;
    return $result;
  }

  public function owner_users(Array $arr) {
    $dependencia_id = $arr["dependencia_id"];
    $workflow_transition = $arr["workflow_transition"];

    $result = new \stdClass;
    $result->success = true ;
    $all_emails = $this->users($workflow_transition, $this->workflow_owners,$dependencia_id);
    $result->message = $all_emails;
    return $result;
  }

  public function dependencia(VigilanciaSeguimiento $vigilancia_seguimiento) {
    $dependencia_id = NULL;
    $d_mp = VigilanciaSeguimiento::whereId($vigilancia_seguimiento->id)->with('institucion.documento.dependencia')->first();
    if (is_null($d_mp)) { return $dependencia_id;}

    $doc = $d_mp->institucion()->first()->documento()->first();
    if (is_null($doc)) {return $dependencia_id;}

    $dependencia_id = $doc->dependencia_id;
    return $dependencia_id;
  }

  public function notification_users($workflow_state,$dependencia_id) {
    $all_emails = $this->users($workflow_state, $this->workflow_notifications,$dependencia_id);
    return $all_emails;
  }

  private function users($workflow_state, $workflow_users, $dependencia_id) {
    $arr = [];
    $exists = in_array($workflow_state,array_keys($workflow_users));
    if (!($exists)) { return $arr; }

    //$this->log::alert($workflow_users);
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
