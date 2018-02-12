<?php

use Illuminate\Http\Request;

Route::post('apply_transition', 'API\WorkflowController@apply_transition');
Route::post('user_actions', 'API\WorkflowController@user_actions');
Route::post('workflow_actions', 'API\WorkflowController@workflow_actions');
Route::post('workflow_transition_owners', 'API\WorkflowController@workflow_transition_owners');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user(); 
});


//curl ... -d @params.json http://localhost:8100/api/apply_transition
