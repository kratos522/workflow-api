<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonaNatural extends Model
{
  protected $table = "personas_naturales";
  protected $attributes = [
                            'apartado_postal_notificacion'=>null,
                            'apartados_postales'=>null,
                            'correo_notificacion'=>null,
                            'correos_electronicos'=> null,
                            'discapacidades'=>null,
                            'edad'=>null,
                            'escolaridad'=>null,
                            'estado_civil'=>null,
                            'etnias' =>null,
                            'fecha_nacimiento'=>null,
                            'genero'=>null,
                            'nacionalidad'=>null,
                            'nombres'=>null,
                            'ocupaciones' =>null,
                            'primer_apellido'=>null,
                            'profesiones'=>null,
                            'pueblo_indigena'=>null,
                            'segundo_apellido'=>null,
                            'sexo'=>null,
                            'tipo_documento_identidad'=>null,
                            'numero_documento_identidad'=>null,
                            'telefono_notificacion' => null,
                            'telefonos' => null
                          ];

  protected $casts = [
      'apartados_postales' => 'array',
      'correos_electronicos' => 'array',
      'escolaridad' => 'array',
      'discapacidades' => 'array',
      'pueblo_indigena' => 'array',
      'etnias' => 'array',
      'ocupaciones' => 'array',
      'profesiones' => 'array',
      'telefonos' => 'array',
      'alias' => 'array'
  ];

  public function persona(){
      return $this->morphOne('Persona', 'personable');
  }

  public function institucionable(){
      return $this->morphTo();
  }

  public function roles()
  {
      return $this->hasMany(Rol::class, 'persona_natural_id', 'id');
  }

  public function menor()
  {
      return $this->hasMany(PersonaMenor::class, 'persona_natural_id', 'id');
  }

  public function representante_menores()
  {
      return $this->hasMany(PersonaMenor::class, 'representante_legal_id', 'id');
  }


}
