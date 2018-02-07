<?php

namespace App\Mail;

use App\SolicitudAnalisis;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SolicitudAnalisisAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $solicitud_analisis;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SolicitudAnalisis $solicitud_analisis, $rol, $user)
    {
        $this->solicitud_analisis = $solicitud_analisis;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->solicitud_analisis->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.solicitud_analisis_after_transition');
    }
}
