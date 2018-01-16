<?php

namespace App\Mail;

use App\ReconocimientoRuedaPersona;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReconocimientoRuedaPersonaAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $reconocimiento_rueda_persona;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ReconocimientoRuedaPersona $reconocimiento_rueda_persona, $rol, $user)
    {
        $this->reconocimiento_rueda_persona = $reconocimiento_rueda_persona;
        $this->rol = $rol;
        $this->user = $user;
  $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->reconocimiento_rueda_persona->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reconocimiento_rueda_persona_after_transition');
    }
}
