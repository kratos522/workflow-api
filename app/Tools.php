<?php

namespace App;

use App\Passport;
use App\DenunciaMP;
use App\DenunciaSS;
use App\DenunciaMPWorkflow;
use App\DenunciaSSWorkflow;

class Tools
{

  private $log;
  private $actionable_before_states;
  private $actionable_functions;

  public function __construct()
  {
      $this->log = new \Log;
      $this->actionable_before_states = Array("delitos_asignados",
                                              "fiscales_asignados",
                                              "delitos_tipificados",
                                              "pendiente_revision",
                                              "dependencia_asignada"
                                            );
      $this->actionable_functions = Array(
                                          "onBeforeTransitionDelitosAsignados",
                                          "onBeforeTransitionFiscalesAsignados",
                                          "onBeforeTransitionDelitosTipificados",
                                          "onBeforeTransitionPendienteRevision",
                                          "onBeforeTransitionDependenciaAsignada"
                                          );
  }

  private function onBeforeTransitionFiscalesAsignados(DenunciaMP $denuncia_mp){
    $log = new \Log;
    $log::alert('onBeforeTransitionFiscalesAsignados called');
    $denuncia_mp_workflow = new DenunciaMPWorkflow;
    $fiscales_asignados = $denuncia_mp_workflow->fiscales_asignados($denuncia_mp);
    $log::alert('$fiscales_asignados is '. var_export($fiscales_asignados,true));
    if ($fiscales_asignados) {
      return true;
    }
    $log::error('Hay delitos atribuídos al imputado sin fiscal asignado!');
    return false;
  }

  private function onBeforeTransitionDelitosAsignados(DenunciaMP $denuncia_mp){
    $log = new \Log;
    $log::alert('onBeforeTransitionDelitosAsignados called');
    $denuncia_mp_workflow = new DenunciaMPWorkflow;
    $delitos_asignados = $denuncia_mp_workflow->delitos_asignados($denuncia_mp);
    // $log::alert('$delitos_asignados is '. var_export($delitos_asignados,true));
    if ($delitos_asignados) {
      return true;
    }
    $log::error('A la denuncia le falta asignar los delitos !');
    return false;
  }

  private function onBeforeTransitionPendienteRevision(DenunciaSS $denuncia_ss){
    $log = new \Log;
    $log::alert('onBeforeTransitionPendienteRevision called');
    $denuncia_ss_workflow = new DenunciaSSWorkflow;
    $fiscales_asignados = $denuncia_ss_workflow->fiscales_asignados($denuncia_ss);
    $log::alert('$fiscales_asignados is '. var_export($fiscales_asignados,true));
    if ($fiscales_asignados) {
      return true;
    }
    $log::error('Hay delitos atribuídos al sospechoso sin fiscal asignado!');
    return false;
  }

  private function onBeforeTransitionDelitosTipificados(DenunciaSS $denuncia_ss){
    $log = new \Log;
    $log::alert('onBeforeTransitionDelitosTipificados called');
    $denuncia_ss_workflow = new DenunciaSSWorkflow;
    $delitos_tipificados = $denuncia_ss_workflow->delitos_asignados($denuncia_ss);
    if ($delitos_tipificados) {
      return true;
    }
    $log::error('A la denuncia le falta tipificar los delitos !');
    return false;
  }

  private function onBeforeTransitionDependenciaAsignada(Documento $documento){
    $log = new \Log;
    $log::alert('onBeforeTransitionDependenciaAsignada called');
    $documento_workflow = new DocumentoWorkflow;
    $dependencia_asignada = $documento_workflow->dependencia($documento);
    if ($dependencia_asignada) {
      return true;
    }
    $log::error('Al Documento le falta asignar una Dependencia de una Institución!');
    return false;
  }

  public function DenunciaMPonBeforeTransition($event) {
      //$this->log::alert('[Tools][DenunciaMPonBeforeTransition]');
      $res = true;
      $denuncia_mp = $event;
      //$this->log::alert('[Tools][DenunciaMPonBeforeTransition][Actionable State] '. $denuncia_mp->workflow_state);
      $workflow_state = $denuncia_mp->workflow_state;
      $condition = (in_array($workflow_state,$this->actionable_before_states));
      if ($condition) {
        $function_name = "onBeforeTransition" . ucfirst(implode("",explode("_",camel_case($workflow_state))));
        $condition = (in_array($function_name,$this->actionable_functions));
        if ($condition) {
          $res = (new \App\Tools)->$function_name($denuncia_mp);
          //$this->log::alert('$res is '. var_export($res, true) );
        }
      }
      return $res;
  }

  public function DenunciaSSonBeforeTransition($event) {
      //$this->log::alert('[Tools][DenunciaMPonBeforeTransition]');
      $res = true;
      $denuncia_ss = $event;
      //$this->log::alert('[Tools][DenunciaMPonBeforeTransition][Actionable State] '. $denuncia_mp->workflow_state);
      $workflow_state = $denuncia_ss->workflow_state;
      $condition = (in_array($workflow_state,$this->actionable_before_states));
      if ($condition) {
        $function_name = "onBeforeTransition" . ucfirst(implode("",explode("_",camel_case($workflow_state))));
        $condition = (in_array($function_name,$this->actionable_functions));
        if ($condition) {
          $res = (new \App\Tools)->$function_name($denuncia_ss);
          //$this->log::alert('$res is '. var_export($res, true) );
        }
      }
      return $res;
  }

  public function DocumentoonBeforeTransition($event) {
      //$this->log::alert('[Tools][DenunciaMPonBeforeTransition]');
      $res = true;
      $documento = $event;
      //$this->log::alert('[Tools][DenunciaMPonBeforeTransition][Actionable State] '. $denuncia_mp->workflow_state);
      $workflow_state = $documento->workflow_state;
      $condition = (in_array($workflow_state,$this->actionable_before_states));
      if ($condition) {
        $function_name = "onBeforeTransition" . ucfirst(implode("",explode("_",camel_case($workflow_state))));
        $condition = (in_array($function_name,$this->actionable_functions));
        if ($condition) {
          $res = (new \App\Tools)->$function_name($documento);
          //$this->log::alert('$res is '. var_export($res, true) );
        }
      }
      return $res;
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

    if (is_null($jres)) {return false;}

    if (!property_exists($jres, "success")){
      return false;
    }
    if (!($jres->success)) {
      return false;
    }
    return true;

  }

}
