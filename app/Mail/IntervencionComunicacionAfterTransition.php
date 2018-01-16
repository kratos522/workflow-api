<?php

namespace App\Mail;

use App\IntervencionComunicacion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class IntervencionComunicacionAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $intervencion_comunicacion;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(IntervencionComunicacion $intervencion_comunicacion, $rol, $user)
    {
        $this->intervencion_comunicacion = $intervencion_comunicacion;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->intervencion_comunicacion->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.intervencion_comunicacion_after_transition');
    }
}
