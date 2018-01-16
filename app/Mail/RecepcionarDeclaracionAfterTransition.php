<?php

namespace App\Mail;

use App\RecepcionarDeclaracion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecepcionarDeclaracionAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $recepcionar_declaraciones;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RecepcionarDeclaracion $recepcionar_declaraciones, $rol, $user)
    {
        $this->recepcionar_declaraciones = $recepcionar_declaraciones;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->recepcionar_declaraciones->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.recepcionar_declaraciones_after_transition');
    }
}
