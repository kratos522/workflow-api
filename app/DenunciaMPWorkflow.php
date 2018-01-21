<?php

namespace App;

use App\DenunciaMP;
use App\Tools;
use App\Passport;
use Symfony\Component\Yaml\Yaml;

class DenunciaMPWorkflow implements iAction
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

  public function __construct($remove_root=false){

      $this->response = new \stdClass;
      $this->response->code = 200;
      $this->response->message = "";
      $this->log = new \Log;
      $this->state = 'nueva';
      $this->tools = new Tools;
      $this->workflow_name = "denuncia_mp";
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

  //public function apply(DenunciaMP $denuncia_mp, $action, $user_email) {
  public function apply(Array $arr) {    
    // $this->log::alert('denunciampworkflow...');
    // $this->log::alert($arr);

    $denuncia_mp_id = $arr["object_id"];
    $action = $arr["action"];
    $user_email = $arr["user_email"];
    $denuncia_mp = DenunciaMP::find($denuncia_mp_id);

    # set enabled transitions
    $result = new \stdClass;
    try {
      $arr = $this->tools->get_workflow_transitions($denuncia_mp, $action, $user_email);

      # set initial state if workflow_state is null
      if (is_null($denuncia_mp->workflow_state)) { $denuncia_mp->workflow_state = $this->state;}

      # apply workflow transition
      $res = $this->tools->workflow_apply($denuncia_mp, $action);

      # update $denuncia_mp
      if (!$denuncia_mp->save()) {
         $this->log::alert('Workflow Transition Failed!');
         $result->success = false;
         $result->message = "acción/transición no permitida en el flujo"; 
         return $result;
      }

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

  public function user_actions(Array $arr) {
    $denuncia_mp_id = $arr["object_id"];
    $user_email = $arr["user_email"];
    $denuncia_mp = DenunciaMP::find($denuncia_mp_id);

    # set enabled transitions
    $result = new \stdClass;
    $result->success = true ;
    $arr = $this->tools->allowed_actions($denuncia_mp, $this->workflow_name, $user_email);
    $result->message = $arr;
    return $result;
  }

  public function fiscales_asignados(DenunciaMP $denuncia_mp){
    $denuncia = $denuncia_mp->institucion()->first();
    $imputados = $denuncia->imputados()->get();
    $count_imputados = $denuncia->imputados()->count();
    $count_fiscales_imputado = 0;
    foreach($imputados as $i) {
      $count_fiscal_imputado = 0;
      $count_fiscal_imputado = FiscalAsignado::where('denuncia_id',$denuncia->id)->where('imputado_id',$i->id)->count();

      if ($count_fiscal_imputado >0) {
        $count_fiscales_imputado += 1;
      }
    }

    if ($count_imputados >= $count_fiscales_imputado) {
      return true;
    }
    return false;
  }

  public function actions(Array $arr) {
    $denuncia_mp_id = $arr["object_id"];
    $denuncia_mp = DenunciaMP::find($denuncia_mp_id);

    $result = new \stdClass;
    $result->success = true ;
    $arr = $this->tools->get_actions($denuncia_mp);
    $result->message = $arr;
    return $result;
  }

  public function delitos_asignados(DenunciaMP $denuncia_mp) {
    $this->log::alert(json_encode($denuncia_mp));
    
    try {
      $d = $denuncia_mp::whereId($denuncia_mp->id)->with('institucion.documento.institucion')->first();
    } catch (Exception $e) {
      return false;
    }

    try {
      $id = $d->institucion->documento->institucion->id; // capturing $denuncia id
    } catch (Exception $e) {
      return false;
    }

    // $this->log::alert('$id is ...');
    // $this->log::alert($id);
    // $this->log::alert('denuncia_mp_id is ...');
    // $this->log::alert($denuncia_mp->id);
    // $this->log::alert(json_encode($denuncia_mp));

    $denuncia = $denuncia_mp->institucion()->first();
    $d_id = $denuncia->id;

    $delitos_count = $denuncia_mp::whereId($denuncia_mp->id)->whereHas('institucion.delitos', function($d) use($d_id) {$d->where('denuncia_id',$d_id);})->count();

    $this->log::alert('delitos count is '. $delitos_count);
    $result = false;
    if ($delitos_count > 0) { $result = true;}
    $this->log::alert('$result in delitos_asignados is '. var_export($result, true) );
    return (boolean)$result;
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
