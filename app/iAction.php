<?php

namespace App;

interface iAction {
	public function apply(Array $arr);
	public function user_actions(Array $arr);	
	public function actions(Array $arr);	
	public function owner_users(Array $arr);	
}