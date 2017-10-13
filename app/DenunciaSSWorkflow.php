<?php

namespace App;

use App\DenunciaSS;
use App\Tools;
use App\Passport;
use Symfony\Component\Yaml\Yaml;

class DenunciaSSWorkflow
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
      $this->state = 'nueva';
      $this->tools = new Tools;
      $this->workflow_name = "denuncia_ss";
      $this->workflow_owners = Yaml::parse(file_get_contents(self::OWNERS_YAML))[$this->workflow_name];
      $this->workflow_notifications = Yaml::parse(file_get_contents(self::NOTIFICATIONS_YAML))[$this->workflow_name];
  }

  public function apply(DenunciaSS $denuncia_ss, $action, $user_email) {
    # set enabled transitions
    try {
      $arr = $this->tools->get_workflow_transitions($denuncia_ss, $action, $user_email);

      # set initial state if workflow_state is null
      if (is_null($denuncia_ss->workflow_state)) { $denuncia_ss->workflow_state = $this->state;}

      # apply workflow transition
      $res = $this->tools->workflow_apply($denuncia_ss, $action);
      if (!$res) { return false; }

      # update $denuncia_ss
      $denuncia_ss->save();
      return true;
    } catch (\Exception $e) {
      unset($denuncia_ss["enabled_transitions"]);
      unset($denuncia_ss["user_email"]);
      return $e;
    }
  }

  public function user_actions(DenunciaSS $denuncia_ss, $user_email) {
    # set enabled transitions
    $arr = $this->tools->allowed_actions($denuncia_ss, $this->workflow_name, $user_email);
    return $arr;
  }


  public function actions(DenunciaSS $denuncia_ss) {
    $arr = $this->tools->get_actions($denuncia_ss);
    return $arr;
  }

  public function delitos_asignados(DenunciaSS $denuncia_ss) {
    $d = $denuncia_ss::whereId($denuncia_ss->id)->with('institucion')->first();
    $id = $d->institucion->id; // capturing $denuncia id
    $delitos_count = $denuncia_ss::whereId($denuncia_ss->id)->whereHas('institucion.delitos', function($d) use($id) {$d->where('denuncia_id',$id);})->count();
    $this->log::alert('delitos count is '. $delitos_count);
    $result = false;
    if ($delitos_count > 0) { $result = true;}
    $this->log::alert('$result in delitos_asignados is '. var_export($result, true) );
    return (boolean)$result;
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
    //get emails from users for specific workflow_state
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

  public function fiscales_asignados(DenunciaSS $denuncia_ss) {
    #check fiscales asignados a todos los delitos del imputado en la denuncia
    $denuncia = $denuncia_ss->institucion()->first();
    $id = $denuncia->id;
    $count_delitos_atribuidos_denuncia = DelitoAtribuido::whereHas('sospechoso.denuncia', function($d) use($id) {$d->where('denuncia_id',$id);})->count();
    $delitos_atribuidos_denuncia = DelitoAtribuido::whereHas('sospechoso.denuncia', function($d) use($id) {$d->where('denuncia_id',$id);})->get();
    $count_fiscales_asignados = 0 ;
    foreach($delitos_atribuidos_denuncia as $dad) {
       $id = $dad->id;
       $count_fiscales_asignados += $dad::whereId($dad->id)->whereHas('fiscales_asignados', function($f) use($id) {$f->where('delito_atribuido_id',$id);})->count();
    }
    $this->log::alert('count_fiscales_asignados = ' . $count_fiscales_asignados . ' count_delitos_atribuidos_denuncia ' . $count_delitos_atribuidos_denuncia);
    $condition = ($count_fiscales_asignados >= $count_delitos_atribuidos_denuncia) and ($count_fiscales_asignados > 0);
    if ($condition) { return true;}
    return false;
  }

}
