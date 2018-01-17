<?php

namespace App\Http\Controllers\API;

use App\Tools;
use Psr\Log\LoggerInterface;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DenunciaMP;
use App\DenunciaSS;
use App\Documento;
use App\DenunciaMPWorkflow;
use App\DenunciaSSWorkflow;
use App\DocumentoWorkflow;
use App\Workflow;
use App\DefaultWorkflow;
use App\PolyBaseFactory;
use Illuminate\Support\Facades\Auth;
use Validator;

class WorkflowController extends Controller
{

    public $successStatus = 200;
    private $root;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->log = new \Log;
        $this->tools = new Tools($this->logger);
        $this->root = false;
    }

    public function index(){
      // $this->authorize('can_do');
    }

    public function apply_transition(Request $request) {
      # parsing
      // $parsed_request = $this->tools->parse_request($request);
      // $arr = $parsed_request[1];
      $arr = $request->all();

       $validator = Validator::make($arr   , [
         "object_id" => "required|numeric|min:1",
         "action" => "required",
         "user_email" => "required",
         "workflow_type" => "required" 
       ]);

       // $this->log::alert(json_encode($arr));
       // $this->log::alert($arr["workflow_type"]);
       
       if ($validator->fails()) {
         return response()->json(['error'=>'No Content due to null or empty parameters'], 403);
       }

       $workflow = new Workflow($arr);
       try {
            $workflow_type = PolyBaseFactory::getWorkflow($arr["workflow_type"]);
       }
       catch (Exception $e) {
            $workflow_type = new DefaultWorkflow();
       }

       // #find denuncia
       // switch ($arr["workflow_type"]) {
       //         case 'mp':
       //             $subject = DenunciaMP::find($arr["subject_id"]);
       //             $subject_workflow = new DenunciaMPWorkflow($this->root);
       //             break;
       //         case 'ss':
       //             $subject = DenunciaSS::find($arr["subject_id"]);
       //             $subject_workflow = new DenunciaSSWorkflow($this->root);
       //             break;
       //         case 'doc':
       //             $subject = Documento::find($arr["subject_id"]);
       //             $subject_workflow = new DocumentoWorkflow($this->root);
       //             break;               
       // }


       // # chek for nulls
       // if (is_null($subject)) {
       //   return response()->json(['error'=>'Subject with ID '. $arr["subject_id"]. ' not found!'], 403);
       // }

       # apply workflow transition
       $res = $workflow->apply($workflow_type);

       //$res = $subject_workflow->apply($subject, $arr["action"], $arr["user_email"]);
       if (is_null($res)) {
         return response()->json(['error'=>'Could not apply workflow transition'], 403);
       }

       if (!$res->success) {
         return response()->json(['error'=>'Exception found '.$res->message], 403);
       }

       # return success response
       return response()->json(['success' => $res->success, 'message'=>$res->message], $this->successStatus);
    }

    public function user_actions(Request $request) {
      # parsing
      $parsed_request = $this->tools->parse_request($request);
      $arr = $parsed_request[1];

       $validator = Validator::make($arr   , [
         "subject_id" => "required|numeric|min:1",
         "user_email" => "required",
         "workflow_type" => "required|in:mp,ss,doc"
       ]);

       if ($validator->fails()) {
         return response()->json(['error'=>'No Content due to null or empty parameters'], 403);
       }

       #find denuncia
       switch ($arr["workflow_type"]) {
               case 'mp':
                   $subject = DenunciaMP::find($arr["subject_id"]);
                   $subject_workflow = new DenunciaMPWorkflow($this->root);
                   break;
               case 'ss':
                   $subject = DenunciaSS::find($arr["subject_id"]);
                   $subject_workflow = new DenunciaSSWorkflow($this->root);
                   break;
               case 'doc':
                   $subject = Documento::find($arr["subject_id"]);
                   $subject_workflow = new DocumentoWorkflow($this->root);
                   break;
       }

       # chek for nulls
       if (is_null($subject)) {
         return response()->json(['error'=>'Subject with ID '. $arr["subject_id"]. ' not found!'], 403);
       }

       # apply workflow transition
       $res = $subject_workflow->user_actions($subject, $arr["user_email"]);
       if (is_null($res)) {
         return response()->json(['error'=>'Could not get user actions'], 403);
       }

       if (!$res->success) {
         return response()->json(['error'=>'Exception found '.$res->message], 403);
       }

       # return success response
       return response()->json(['success' => $res->success, 'message'=>$res->message], $this->successStatus);
    }

    public function workflow_actions(Request $request) {
      # parsing
      $parsed_request = $this->tools->parse_request($request);
      $arr = $parsed_request[1];

       $validator = Validator::make($arr   , [
         "subject_id" => "required|numeric|min:1",
         "workflow_type" => "required|in:mp,ss,doc"
       ]);

       if ($validator->fails()) {
         return response()->json(['error'=>'No Content due to null or empty parameters'], 403);
       }

       #find denuncia
       switch ($arr["workflow_type"]) {
               case 'mp':
                   $subject = DenunciaMP::find($arr["subject_id"]);
                   $subject_workflow = new DenunciaMPWorkflow($this->root);
                   break;
               case 'ss':
                   $subject = DenunciaSS::find($arr["subject_id"]);
                   $subject_workflow = new DenunciaSSWorkflow($this->root);
                   break;
               case 'doc':
                   $subject = Documento::find($arr["subject_id"]);
                   $subject_workflow = new DocumentoWorkflow($this->root);
                   break;
       }

       # chek for nulls
       if (is_null($subject)) {
         return response()->json(['error'=>'Subject with ID '. $arr["subject_id"]. ' not found!'], 403);
       }

       # apply workflow transition
       $res = $subject_workflow->actions($subject);
       if (is_null($res)) {
         return response()->json(['error'=>'Could not get workflow actions'], 403);
       }

       if (!$res->success) {
         return response()->json(['error'=>'Exception found '.$res->message], 403);
       }

       # return success response
       return response()->json(['success' => $res->success, 'message'=>$res->message], $this->successStatus);
    }

    public function workflow_transition_owners(Request $request) {
      # parsing
      $parsed_request = $this->tools->parse_request($request);
      $arr = $parsed_request[1];

       $validator = Validator::make($arr   , [
         "dependencia_id" => "required",
         "action" => "required",
         "workflow_type" => "required|in:mp,ss,doc"
       ]);

       if ($validator->fails()) {
         return response()->json(['error'=>'No Content due to null or empty parameters'], 403);
       }

       #find denuncia
       switch ($arr["workflow_type"]) {
               case 'mp':
                   $subject_workflow = new DenunciaMPWorkflow($this->root);
                   break;
               case 'ss':
                   $subject_workflow = new DenunciaSSWorkflow($this->root);
                   break;
               case 'doc':
                   $subject_workflow = new DocumentoWorkflow($this->root);
                   break;
       }

       # apply workflow transition
       $res = $subject_workflow->owner_users($arr["action"], $arr["dependencia_id"]);
       if (is_null($res)) {
         return response()->json(['error'=>'Could not get workflow actions'], 403);
       }

       if (!$res->success) {
         return response()->json(['error'=>'Exception found '.$res->message], 403);
       }

       # return success response
       return response()->json(['success' => $res->success, 'message'=>$res->message], $this->successStatus);
    }

}
