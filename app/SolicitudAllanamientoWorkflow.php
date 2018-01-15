<?php

namespace App;

use App\SolicitudAllanamiento;
use App\Tools;
use App\Passport;
use Symfony\Component\Yaml\Yaml;

class SolicitudAllanamientoWorkflow
{

  private $state;
  private $tools;
  private $workflow_name;
  private $workflow_owners;
  private $workflow_notifications;
  private $log;

  const OWNERS_YAML = '../config/workflow_owners.yml';
  const NOTIFICATIONS_YAML = '../config/workflow_notifications.yml';

  public function __construct($remove_root=false)
  {
      $this->log = new \Log;
      $this->state = 'nuevo';
      $this->tools = new Tools;
      $this->workflow_name = "realizar_allanamiento";
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

  public function apply(DenunciaMP $denuncia_mp, $action, $user_email) {
    # set enabled transitions
    $result = new \stdClass;
    try {
      $arr = $this->tools->get_workflow_transitions($denuncia_mp, $action, $user_email);

      # set initial state if workflow_state is null
      if (is_null($denuncia_mp->workflow_state)) { $denuncia_mp->workflow_state = $this->state;}

      # apply workflow transition
      $res = $this->tools->workflow_apply($denuncia_mp, $action);
      if (!$res) { return false; }

      # update $denuncia_mp
      $denuncia_mp->save();
      $result->success = true;
      $result->message = $denuncia_mp;
      return $result;
    } catch (\Exception $e) {
      unset($denuncia_mp["enabled_transitions"]);
      unset($denuncia_mp["user_email"]);
      $result->success = false;
      $result->message = $e;
      $this->log::alert($e);
      return $result;
    }
  }

  public function user_actions(DenunciaMP $denuncia_mp, $user_email) {
    # set enabled transitions
    $result = new \stdClass;
    $result->success = true ;
    $arr = $this->tools->allowed_actions($denuncia_mp, $this->workflow_name, $user_email);
    $result->message = $arr;
    return $result;
  }

  public function fiscales_asignados(DenunciaMP $denuncia_mp) {
    #check fiscales asignados a todos los delitos del imputado en la denuncia
    $denuncia = $denuncia_mp->institucion()->first();
    $id = $denuncia->id;
    $count_delitos_atribuidos_denuncia = DelitoAtribuido::whereHas('imputado.denuncia', function($d) use($id) {$d->where('denuncia_id',$id);})->count();
    $delitos_atribuidos_denuncia = DelitoAtribuido::whereHas('imputado.denuncia', function($d) use($id) {$d->where('denuncia_id',$id);})->get();
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

  public function actions(DenunciaMP $denuncia_mp) {
    $result = new \stdClass;
    $result->success = true ;
    $arr = $this->tools->get_actions($denuncia_mp);
    $result->message = $arr;
    return $result;
  }

  public function delitos_asignados(DenunciaMP $denuncia_mp) {
    $d = $denuncia_mp::whereId($denuncia_mp->id)->with('institucion')->first();
    $id = $d->institucion->id; // capturing $denuncia id
    $delitos_count = $denuncia_mp::whereId($denuncia_mp->id)->whereHas('institucion.delitos', function($d) use($id) {$d->where('denuncia_id',$id);})->count();
    $this->log::alert('delitos count is '. $delitos_count);
    $result = false;
    if ($delitos_count > 0) { $result = true;}
    $this->log::alert('$result in delitos_asignados is '. var_export($result, true) );
    return (boolean)$result;
  }

  public function owner_users($workflow_transition, $dependencia_id) {
    $result = new \stdClass;
    $result->success = true ;
    $all_emails = $this->users($workflow_transition, $this->workflow_owners,$dependencia_id);
    $result->message = $all_emails;
    return $result;
  }

  public function dependencia(DenunciaMP $denuncia_mp) {
    $dependencia_id = NULL;
    $d_mp = DenunciaMP::whereId($denuncia_mp->id)->with('institucion.documento.dependencia')->first();
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
