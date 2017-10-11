<?php

namespace App;

use App\DenunciaMP;
use App\Tools;
use App\Passport;
use Symfony\Component\Yaml\Yaml;

class DenunciaMPWorkflow
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
      $this->state = 'a';
      $this->tools = new Tools;
      $this->workflow_name = "denuncia_mp";
      $this->workflow_owners = Yaml::parse(file_get_contents(self::OWNERS_YAML))[$this->workflow_name];
      $this->workflow_notifications = Yaml::parse(file_get_contents(self::NOTIFICATIONS_YAML))[$this->workflow_name];
  }

  public function apply(DenunciaMP $denuncia_mp, $action, $user_email) {
    # set enabled transitions
    try {
      $arr = $this->tools->get_workflow_transitions($denuncia_mp, $action, $user_email);

      # set initial state if workflow_state is null
      if (is_null($denuncia_mp->workflow_state)) { $denuncia_mp->workflow_state = $this->state;}

      # apply workflow transition
      $res = $this->tools->workflow_apply($denuncia_mp, $action);
      if (!$res) { return false; }

      # update $denuncia_mp
      $denuncia_mp->save();
      return true;
    } catch (\Exception $e) {
      unset($denuncia_mp["enabled_transitions"]);
      unset($denuncia_mp["user_email"]);
      return $e;
    }
  }

  public function user_actions(DenunciaMP $denuncia_mp, $user_email) {
    # set enabled transitions
    $arr = $this->tools->allowed_actions($denuncia_mp, $this->workflow_name, $user_email);
    return $arr;
  }

  public function actions(DenunciaMP $denuncia_mp) {
    $arr = $this->tools->get_actions($denuncia_mp);
    return $arr;
  }

  public function owner_users($workflow_state) {
    $all_emails = $this->users($workflow_state, $this->workflow_owners);
    return $all_emails;
  }

  public function notification_users($workflow_state) {
    $all_emails = $this->users($workflow_state, $this->workflow_notifications);
    return $all_emails;
  }

  private function users($workflow_state, $workflow_users) {
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
