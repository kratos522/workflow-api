<?php

namespace App;

use App\SolicitudAnalisis;
use App\Tools;
use App\Passport;
use Symfony\Component\Yaml\Yaml;

class SolicitudAnalisisWorkflow implements iAction
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
    $this->workflow_name = "solicitud_analisis";
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
    $solicitud_analisis_id = $arr["object_id"];
    $action = $arr["action"];
    $user_email = $arr["user_email"];
    $solicitud_analisis = SolicitudAnalisis::find($solicitud_analisis_id);

    # set enabled transitions
    $result = new \stdClass;
    try {
      $arr = $this->tools->get_workflow_transitions($solicitud_analisis, $action, $user_email);

      # set initial state if workflow_state is null
      if (is_null($solicitud_analisis->workflow_state)) { $solicitud_analisis->workflow_state = $this->state;}

      # apply workflow transition
      $res = $this->tools->workflow_apply($solicitud_analisis, $action);


      if (!$solicitud_analisis->save()) {
         $this->log::alert('Workflow Transition Failed!');
         $result->success = false;
         $result->message = "acción/transición no permitida en el flujo";
         return $result;
      }

      $result->success = true;
      $result->message = $solicitud_analisis;
      return $result;

    } catch (\Exception $e) {
      unset($solicitud_analisis["enabled_transitions"]);
      unset($solicitud_analisis["user_email"]);
      $result->success = false;
      $result->message = $e;
      $this->log::alert($e);
      return $result;
    }
  }

  public function user_actions(SolicitudAnalisis $solicitud_analisis, $user_email) {
    # set enabled transitions
    $result = new \stdClass;
    $result->success = true ;
    $arr = $this->tools->allowed_actions($solicitud_analisis, $this->workflow_name, $user_email);
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

  public function actions(SolicitudAnalisis $solicitud_analisis) {
    $result = new \stdClass;
    $result->success = true ;
    $arr = $this->tools->get_actions($solicitud_analisis);
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

  public function dependencia(SolicitudAnalisis $solicitud_analisis) {
    $dependencia_id = NULL;
    $d_mp = SolicitudAnalisis::whereId($solicitud_analisis->id)->with('institucion.documento.dependencia')->first();
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
