<?php

namespace App\Mail;

use App\RegistroArma;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistroArmaAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $registro_arma;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RegistroArma $registro_arma, $rol, $user)
    {
        $this->registro_arma = $registro_arma;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->registro_arma->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.registro_arma_after_transition');
    }
}
