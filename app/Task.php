<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Brexis\LaravelWorkflow\Traits\WorkflowTrait;

class Task extends Model
{
  use WorkflowTrait;

  protected $attributes = ['title'=>null, 'workflow_state'=>null];

}
