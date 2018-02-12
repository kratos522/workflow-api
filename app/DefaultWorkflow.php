<?php

namespace App;

use Validator;

Class DefaultWorkflow implements iAction {

    private $response;
    public function __construct()
    {
        $this->log = new \Log;
        $this->response = new \stdClass;
        $this->response->code = 200;
        $this->response->message = "";
    }

  public function apply(Array $arr) {
    # set enabled transitions
    return $this->response;
  }  

  public function user_actions(Array $arr) {
    # set enabled transitions
    return $this->response;
  }    

  public function actions(Array $arr) {
    # set enabled transitions
    return $this->response;
  }      

  public function owner_users(Array $arr) {
    # set enabled transitions
    return $this->response;
  }      
}