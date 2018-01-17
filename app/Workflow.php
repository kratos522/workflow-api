<?php

namespace App;

Class Workflow {

	public $arr;

    public function  __construct($arr) {
        $this->arr = $arr;
    }

	public function apply(iAction $workflow) {
		return $workflow->apply($this->arr);
	}

	public function user_actions(iAction $workflow) {
		return $workflow->user_actions($this->arr);
	}	

	public function actions(iAction $workflow) {
		return $workflow->actions($this->arr);
	}		

	public function owner_users(iAction $workflow) {
		return $workflow->owner_users($this->arr);
	}		
}