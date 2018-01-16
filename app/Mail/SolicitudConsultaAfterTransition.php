<?php

namespace App\Mail;

use App\SolicitudConsulta;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SolicitudConsultaAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $solicitud_consulta;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SolicitudConsulta $solicitud_consulta, $rol, $user)
    {
        $this->solicitud_consulta = $solicitud_consulta;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->solicitud_consulta->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.solicitud_consulta_after_transition');
    }
}
