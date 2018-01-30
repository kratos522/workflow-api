<?php

namespace App\Mail;

use App\InfiltrarOrganizacionCriminal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InfiltrarOrganizacionCriminalAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $infiltrar_organizacion_criminal;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(InfiltrarOrganizacionCriminal $infiltrar_organizacion_criminal, $rol, $user)
    {
        $this->infiltrar_organizacion_criminal = $infiltrar_organizacion_criminal;
        $this->rol = $rol;
        $this->user = $user;
    $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->infiltrar_organizacion_criminal->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.infiltrar_organizacion_criminal_after_transition');
    }
}
