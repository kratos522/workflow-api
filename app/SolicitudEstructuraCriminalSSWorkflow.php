<?php

namespace App;

use App\SolicitudEstructuraCriminalSS;
use App\Tools;
use App\Passport;
use Symfony\Component\Yaml\Yaml;

use Illuminate\Database\Eloquent\Model;

class SolicitudEstructuraCriminalSSWorkflow extends Model
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
      $this->workflow_name = "solicitud_estructura_criminal_ss";
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
      // $this->log::alert('denunciampworkflow...');
      // $this->log::alert($arr);
      $solicitud_estructura_criminal_ss_id = $arr["object_id"];
      $action = $arr["action"];
      $user_email = $arr["user_email"];
      $solicitud_estructura_criminal_ss = SolicitudEstructuraCriminalSS::find($solicitud_estructura_criminal_ss_id);
      # set enabled transitions
      $result = new \stdClass;
      try {
        $arr = $this->tools->get_workflow_transitions($solicitud_estructura_criminal_ss, $action, $user_email);
        # set initial state if workflow_state is null
        if (is_null($solicitud_estructura_criminal_ss->workflow_state)) { $solicitud_estructura_criminal_ss->workflow_state = $this->state;}
        # apply workflow transition
        $res = $this->tools->workflow_apply($solicitud_estructura_criminal_ss, $action);
        # update $denuncia_mp
        if (!$solicitud_estructura_criminal_ss->save()) {
           $this->log::alert('Workflow Transition Failed!');
           $result->success = false;
           $result->message = "acción/transición no permitida en el flujo";
           return $result;
        }
        $result->success = true;
        $result->message = $solicitud_estructura_criminal_ss;
        return $result;
      } catch (\Exception $e) {
        unset($solicitud_estructura_criminal_ss["enabled_transitions"]);
        unset($solicitud_estructura_criminal_ss["user_email"]);
        $result->success = false;
        $result->message = $e;
        $this->log::alert($e);
        return $result;
      }
    }


    public function user_actions(Array $arr) {
      $this->log::alert('SolicitudEstructuraCriminalSSWorkflow->user_actions');
      $this->log::alert(json_encode($arr));
      $solicitud_estructura_criminal_ss_id = $arr["object_id"];
      $user_email = $arr["user_email"];
      $solicitud_estructura_criminal_ss = SolicitudEstructuraCriminalSS::find($solicitud_estructura_criminal_ss_id);
      # set enabled transitions
      $result = new \stdClass;
      $result->success = true ;
      $arr = $this->tools->allowed_actions($solicitud_estructura_criminal_ss, $this->workflow_name, $user_email);
      $result->message = $arr;
      return $result;
    }


    public function actions(Array $arr) {
      $solicitud_estructura_criminal_ss_id = $arr["object_id"];
      $solicitud_estructura_criminal_ss = SolicitudEstructuraCriminalSS::find($solicitud_estructura_criminal_ss_id);
      $result = new \stdClass;
      $result->success = true ;
      $arr = $this->tools->get_actions($solicitud_estructura_criminal_ss);
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
}
