<?php

namespace App\Mail;

use App\RegistrarOrdenJudicial;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrarOrdenJudicialAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $registrar_orden_judicial;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RegistrarOrdenJudicial $registrar_orden_judicial, $rol, $user)
    {
        $this->registrar_orden_judicial = $registrar_orden_judicial;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->registrar_orden_judicial->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.registrar_orden_judicial_after_transition');
    }
}
