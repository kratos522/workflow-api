<?php

namespace App\Mail;

use App\RetratoHablado;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RetratoHabladoAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $retrato_hablado;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RetratoHablado $retrato_hablado, $rol, $user)
    {
        $this->retrato_hablado = $retrato_hablado;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->retrato_hablado->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.retrato_hablado_after_transition');
    }
}
