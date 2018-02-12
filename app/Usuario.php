<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Model
{
  use Notifiable;

  protected $attributes = ['nombre_usuario' =>null, 'correo_electronico'=>null];

  protected $fillable = [
      'nombre_usuario', 'correo_electronico', 'password',
  ];

  protected $hidden = [
      'password', 'remember_token',
  ];
  
  public function funcionario()
  {
      return $this->belongsTo(Funcionario::class);
  }
}
