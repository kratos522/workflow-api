<?php

namespace App\Mail;

use App\Flagrancia;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FlagranciaAfterTransition extends Mailable
{
    use Queueable, SerializesModels;

    public $flagrancia;
    public $rol;
    public $user;
    public $friendly_workflow_state;
    public $friendly_rol;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Flagrancia $flagrancia, $rol, $user)
    {
        $this->flagrancia = $flagrancia;
        $this->rol = $rol;
        $this->user = $user;
        $this->friendly_workflow_state = ucfirst(implode(" ",explode("_",$this->flagrancia->workflow_state)));
        $this->friendly_rol = ucfirst(implode(" ",explode("_",$this->rol)));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.flagrancia_after_transition');
    }
}
