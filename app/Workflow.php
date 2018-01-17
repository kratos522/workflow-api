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
}