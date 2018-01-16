<?php

namespace App\Mail;

use App\SolicitudAllanamiento;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SolicitudAllanamientoAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $solicitud_allanamiento;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SolicitudAllanamiento $solicitud_allanamiento, $rol, $user)
    {
        $this->solicitud_allanamiento = $solicitud_allanamiento;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->solicitud_allanamiento->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.solicitud_allanamiento_after_transition');
    }
}
