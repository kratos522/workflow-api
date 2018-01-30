<?php

namespace App\Mail;

use App\InvestigarDelito;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvestigarDelitoAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $investigar_delito;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(InvestigarDelito $investigar_delito, $rol, $user)
    {
        $this->investigar_delito = $investigar_delito;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->investigar_delito->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.investigar_delito_after_transition');
    }
}
