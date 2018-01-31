<?php

namespace App;

use App\RegistroPersona;
use App\Tools;
use App\Passport;
use Symfony\Component\Yaml\Yaml;

class RegistroPersonaWorkflow implements iAction
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
    $this->workflow_name = "realizar_registro_personal";
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
    $registro_personal_id = $arr["object_id"];
    $action = $arr["action"];
    $user_email = $arr["user_email"];
    $registro_personal = AlbumFotografico::find($registro_personal_id);

    # set enabled transitions
    $result = new \stdClass;
    try {
      $arr = $this->tools->get_workflow_transitions($registro_personal, $action, $user_email);

      # set initial state if workflow_state is null
      if (is_null($registro_personal->workflow_state)) { $registro_personal->workflow_state = $this->state;}

      # apply workflow transition
      try {
          $res = $this->tools->workflow_apply($registro_personal, $action);
      } catch (\Exception $e) {
          return result;
      }

      $registro_personal->save();
      $result->success = true;
      $result->message = $registro_personal;
      return $result;
    } catch (\Exception $e) {
      unset($registro_personal["enabled_transitions"]);
      unset($registro_personal["user_email"]);
      $result->success = false;
      $result->message = $e;
      $this->log::alert($e);
      return $result;
    }
  }

  public function user_actions(Array $arr) {
    $registro_personal_id = $arr["object_id"];
    $user_email = $arr["user_email"];
    $registro_personal = AlbumFotografico::find($registro_personal_id);

    # set enabled transitions
    $result = new \stdClass;
    $result->success = true ;
    $arr = $this->tools->allowed_actions($registro_personal, $this->workflow_name, $user_email);
    $result->message = $arr;
    return $result;
  }

  public function actions(Array $arr) {

    $registro_personal_id = $arr["object_id"];
    $registro_personal = AlbumFotografico::find($registro_personal_id);

    $result = new \stdClass;
    $result->success = true ;
    $arr = $this->tools->get_actions($registro_personal);
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

  public function dependencia(AlbumFotografico $registro_personal) {
    $dependencia_id = NULL;
    $d_mp = AlbumFotografico::whereId($registro_personal->id)->with('institucion.documento.dependencia')->first();
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