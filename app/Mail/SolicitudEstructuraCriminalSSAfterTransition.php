<?php

namespace App\Mail;

use App\SolicitudEstructuraCriminalSS;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SolicitudEstructuraCriminalSSAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $solicitud_estructura_criminal_ss;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SolicitudEstructuraCriminalSS $solicitud_estructura_criminal_ss, $rol, $user)
    {
        $this->$solicitud_estructura_criminal_ss = $solicitud_estructura_criminal_ss;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->$solicitud_estructura_criminal_ss->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.solicitud_estructura_criminal_ss_after_transition');
    }
}
